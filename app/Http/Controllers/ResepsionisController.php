<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Gambar;
use App\Models\Kamar;
use App\Models\Kategori;
use App\Models\Pemesanan;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class ResepsionisController extends Controller
{
    public function index()
    {
        $user = auth()->id();
        $data = Admin::where('id', $user)->get();
        return view('resepsionis.dashboard', compact('data'));
    }
    public function profilUpdateResepsionis(Request $request)
    {
        $user = $request->user();

    // Periksa jika pengguna tidak ada
    if (!$user) {
        return back()->withErrors(['error' => 'Pengguna tidak terautentikasi.']);
    }

    // Validasi data request jika diperlukan
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed', // Validasi password jika ada
    ]);

    // Data yang akan diperbarui
    $updateData = [
        'name' => $request->name,
        'email' => $request->email,
    ];

    // Jika ada password baru yang diberikan, hash dan tambahkan ke data update
    if ($request->filled('password')) {
        $updateData['password'] = bcrypt($request->password);
    }

    // Perbarui data pengguna
    $user->update($updateData);

    // Redirect kembali dengan pesan sukses
    return back()->with('toast_success', 'Profil Berhasil diubah!');
    }


    // Kamar
    public function kamarResepsionis()
    {
        $user = auth()->id();
        $data = Admin::where('id', $user)->first();
        $kategori = Kategori::all();
        $kamar = Kamar::all();
        $gambar = [];
        foreach ($kategori as $kat) {
            $gambar[$kat->id] = Gambar::where('kategori_id', $kat->id)->get();
        }
        return view('resepsionis.kamar', compact('data', 'kategori', 'kamar', 'gambar'));
    }
    public function getKamarResepsionis(Request $request)
    {
        if ($request->ajax()) {
            $data = Kamar::with('kategori')->select(['*']); // Ambil data kamar beserta kategori
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $detailButton = '<a class="btn btn-primary btn-sm btn-action" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#detailKamar' . $row->id . '">Detail</a>';
                    return $detailButton;
                })
                ->rawColumns(['actions'])
                ->toJson();
        }
    }

    // Booking
    public function bookingResepsionis()
    {
        $user = auth()->id();
        $data = Admin::where('id', $user)->first();
        $kamar = Kamar::all();
        $kategori = Kategori::all();
        $pemesanan = Pemesanan::with('kategori')->with('kamar')->orderBy('out', 'asc')->paginate(10);
        return view('resepsionis.booking', compact('data', 'pemesanan', 'kamar', 'kategori'));
    }
    public function getBookingResepsionis()
    {
        $bookings = Pemesanan::with('kamar')->select(['id', 'kode', 'kamar_id', 'nama', 'in', 'out', 'jumlah_orang', 'total', 'status']); //select digunakan untuk mengambil beberapa seperti disamping contohnya jika tidak diberi select maka akan diambil semua

        return DataTables::of($bookings)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                <a class="btn btn-primary btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#detail' . $row->id . '">Detail</a>
                <br>
                <a href="/checkout/booking/' . $row->id . '" class="btn btn-danger btn-sm btn-action mt-1"><i class="fa-solid fa-xmark" aria-hidden="true"></i> Check Out</a>
            ';
            })
            ->rawColumns(['action'])
            ->make(true);
        // i class="fa-solid fa-eye"></i> <i class="fa-solid fa-xmark"></i>
    }
    public function checkoutBookingResepsionis($id)
    {
        // DB::table('pemesanan')->where('id', $id)->delete();
        $pemesanan = Pemesanan::with('kamar', 'kategori')->where('id', $id)->first();


        if (!$pemesanan) {
            return redirect('/booking/admin')->with('error', 'Pemesanan tidak ditemukan!');
        }

        // Simpan data pemesanan ke dalam tabel riwayat dengan query builder
        DB::table('riwayat_pemesanan')->insert([
            'nama_kamar' => $pemesanan->kamar->nama,
            'kode' => $pemesanan->kode,
            'jenis_kamar' => $pemesanan->kategori->nama,
            'tanggal_pemesanan' => $pemesanan->tgl_pemesanan,
            'tanggal_checkin' => $pemesanan->in,
            'tanggal_checkout' => $pemesanan->out,
            'nama' => $pemesanan->nama,
            'email' => $pemesanan->email,
            'phone' => $pemesanan->phone,
            'jumlah_orang' => $pemesanan->jumlah_orang,
            'status' => 'selesai',
            'total' => $pemesanan->total,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Hapus pemesanan dari tabel pemesanan
        DB::table('pemesanan')->where('id', $id)->delete();

        // Update status kamar menjadi kosong
        DB::table('kamar')
            ->where('id', $pemesanan->kamar_id)
            ->update(['status' => 'kosong']);
        return redirect('/resepsionis/booking')->with('info', 'Berhasil CheckOut!');
    }

    // Riwayat  
    public function riwayatResepsionis(){
        $user = auth()->id();
        $data = Admin::where('id', $user)->first();
        $riwayat = Riwayat::paginate(10);
        return view('resepsionis.riwayat', compact('data', 'riwayat'));
    }
    public function getRiwayatResepsionis()
    {
        $riwayat = Riwayat::all(); //select digunakan untuk mengambil beberapa seperti disamping contohnya jika tidak diberi select maka akan diambil semua

        return DataTables::of($riwayat)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                <a class="btn btn-warning btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#detail' . $row->id . '"> Detail</a>

            ';
            })
            ->rawColumns(['action'])
            ->make(true);
            // <i class="fa-solid fa-pen-to-square"></i>
    }
}
