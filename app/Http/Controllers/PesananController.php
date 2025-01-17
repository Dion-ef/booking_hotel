<?php

namespace App\Http\Controllers;

use App\Events\NotifikasiBooking;
use App\Models\Asset;
use App\Models\Kamar;
use App\Models\Kategori;
use App\Models\Notifikasi;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PesananController extends Controller
{
    public function checkIn(Request $request, $id)
    {
        //dd($request->all());
        // $data = Kategori::where('id', $id)->first();
        // if (!$data) {
        //     return back()->withErrors(['kategori' => 'Kategori tidak ditemukan']);
        // }
        // Mendapatkan tanggal saat ini
        $date = Carbon::now();

        // Validasi data input
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'Checkin' => 'required',
            'Checkout' => 'required',
            'jumlah_orang' => 'required|integer|min:1',
            'kamar_id' => 'required|exists:kamar,id',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'email' => 'Format email tidak valid.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'min' => 'Minimal :attribute adalah :min.',
            'exists' => 'Kamar tidak ditemukan.',
        ]);

        // Jika validasi gagal, kembalikan response dengan error
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Mengecek kapasitas kamar
        $kamar = Kamar::find($request->kamar_id);
        if ($request->jumlah_orang > $kamar->kapasitas) {
            return back()->withErrors(['jumlah_orang' => 'Jumlah orang maksimal pada kamar ini adalah ' . $kamar->kapasitas])->withInput();
        }

        $data = Kategori::where('id', $kamar->kategori_id)->first();


        // Menyimpan data pemesanan dengan eloquent
        $pemesanan = new Pemesanan();
        $pemesanan->kategori_id = $data->id;
        $pemesanan->kamar_id = $request->kamar_id;
        $pemesanan->user_id = Auth::user()->id;
        $pemesanan->kode = Pemesanan::generateKodePemesanan();
        $pemesanan->nama = $request->nama;
        $pemesanan->email = $request->email;
        $pemesanan->phone = $request->phone;
        $pemesanan->in = $request->Checkin;
        $pemesanan->out = $request->Checkout;
        $pemesanan->jumlah_orang = $request->jumlah_orang;
        $pemesanan->harga = $data->harga;
        $pemesanan->tgl_pemesanan = $date;
        $pemesanan->status = 'unpaid';

        // Menghitung total biaya pemesanan
        $tanggal_in = Carbon::parse($request->Checkin);
        $tanggal_out = Carbon::parse($request->Checkout);
        $selisih_hari = $tanggal_out->diffInDays($tanggal_in);
        $pemesanan->total = $data->harga * $selisih_hari;
        $pemesanan->save();

        // Mengubah status kamar menjadi 'dipakai'
        $kamar = Kamar::where('id', $request->kamar_id)->first();
        if ($kamar) {
            $kamar->status = 'dipakai';
            $kamar->save();
        } else {
            return back()->withErrors('Kamar tidak ditemukan');
        }
        
        Notifikasi::create([
            'nama' => $request->nama,
            'kamar' => $kamar->nama,
            'checkin' => $request->Checkin,
            'checkout' => $request->Checkout,
            'status' => 'belum dibaca',
        ]);
        $notifikasis = Notifikasi::where('status', 'belum dibaca')->orderBy('created_at', 'desc')->get();

        foreach ($notifikasis as $notifikasi) {
            broadcast(new NotifikasiBooking([
                'id' => $notifikasi->id,
                'nama' => $notifikasi->nama,
                'kamar' => $notifikasi->kamar,
                'checkin' => $notifikasi->checkin,
                'checkout' => $notifikasi->checkout,
            ]));
        }
    

        return redirect()->route('booking.confirm', ['id' => $pemesanan->id]);
    }

    public function konfirmasi($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $asset = Asset::all();

        return view('user.konfirmasi', compact('pemesanan', 'asset'));
    }
    public function getNotifikasi()
    {
        $notifikasi = Notifikasi::where('status', 'belum dibaca')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['notifikasi' => $notifikasi]);
    }

    
}
