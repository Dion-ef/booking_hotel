<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Payment;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\Invoice\CustomerObject;

class PaymentController extends Controller
{
    protected $apiInstance;

    public function __construct()
    {
        Configuration::setXenditKey(env('XENDIT_API_KEY'));
        $this->apiInstance = new InvoiceApi();
    }

    public function createPayment(Request $request)
    {
        $request->validate([
            'pemesanan_id' => 'required|exists:pemesanan,id',
        ]);

        $pemesanan = Pemesanan::findOrFail($request->pemesanan_id);

        $create_invoice_request = new CreateInvoiceRequest([
            'external_id' => 'BKG' . $pemesanan->id,
            'description' => 'Pembayaran untuk Booking Kamar ' . $pemesanan->kamar->nama,
            'amount' => $pemesanan->total,
            'currency' => 'IDR',
            'invoice_duration' => 172800,
            'payer_email'=>$pemesanan->email,
            'success_redirect_url' => url('/payment/success'),
        ]);
        try {
            // buat invoice
            $result = $this->apiInstance->createInvoice($create_invoice_request);

            // simpan
            $payment = new Payment();
            $payment->pemesanan_id = $pemesanan->id;
            $payment->status = 'pending';
            $payment->checkout_link = $result['invoice_url'];
            $payment->external_id = $create_invoice_request['external_id'];
            $payment->save();

            return redirect($result['invoice_url']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal membuat invoice pembayaran: ' . $e->getMessage()], 500);
        }
    }

    public function webhookCallback(Request $request)
    {
        $getToken = $request->headers->get('x-callback-token');
        $callbackToken = env('XENDIT_CALLBACK_TOKEN');

        try {
            if (!$callbackToken) {
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Callback token tidak benar',
                ], Response::HTTP_NOT_FOUND);
            }

            if ($getToken !== $callbackToken) {
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Token callback invalid',
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            $payment = Payment::where('external_id', $request->external_id)->first();
            if (!$payment) {
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Payment not found',
                ], Response::HTTP_NOT_FOUND);
            }

            // Update payment status
            if ($request->status == 'PAID') {
                $payment->status = 'paid';
            } else {
                $payment->status = 'failed'; // Changed 'gagal' to 'failed'
            }
            $payment->save();

            $booking = Pemesanan::where('id', $payment->pemesanan_id)->first();
            if ($booking) {
                $booking->update([
                    'status' => 'paid'
                ]);
            } 
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Callback send',
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function redirectSuccess(){
        // $asset = Asset::all();
        return view('user.success');
    }
}
