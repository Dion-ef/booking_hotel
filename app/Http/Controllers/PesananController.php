<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Kategori;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PesananController extends Controller
{
    public function checkIn(Request $request, $id)
    {
        $data = Kategori::where('id', $id)->first();
        if (!$data) {
            return back()->withErrors('Kategori tidak ditemukan');
        }
    
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
            'kamar_id' => 'required|exists:kamar,id', // Pastikan kamar_id ada di tabel kamar
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
            return back()->withErrors(['jumlah_orang' => 'Jumlah orang maksimal pada kamar ini adalah '. $kamar->kapasitas])->withInput();
        }
    
        // Menyimpan data pemesanan
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
    
        return redirect()->route('booking.confirm', ['id' => $pemesanan->id]);   
    }

    public function konfirmasi($id){
        $pemesanan = Pemesanan::findOrFail($id);
        return view('user.konfirmasi', compact('pemesanan'));
    }
}
