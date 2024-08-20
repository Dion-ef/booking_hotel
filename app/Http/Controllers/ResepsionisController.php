<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Asset;
use App\Models\Gambar;
use App\Models\Kamar;
use App\Models\Kategori;
use App\Models\Notifikasi;
use App\Models\Pemesanan;
use App\Models\PesanUser;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class ResepsionisController extends Controller
{
    public function index()
    {
        $user = auth()->id();
        $data = Admin::where('id', $user)->first();
        $totalKamarKosong = Kamar::where('status','kosong')->count();
        $totalKamarTerpakai = Kamar::where('status','dipakai')->count();
        $totalBooking = Pemesanan::count();
        $notifikasi = Notifikasi::where('status','belum dibaca')->orderBy('created_at', 'desc')->get();
        $checkInHariIni = Pemesanan::whereDate('in', Carbon::today())->count();
        $pesanUser = PesanUser::limit(3)->get();
        $asset = Asset::all();
        return view('resepsionis.dashboard', compact('data', 'totalKamarKosong', 'asset','totalBooking','totalKamarTerpakai','pesanUser','checkInHariIni','notifikasi'));
    }

   


    // Kamar
    public function kamarResepsionis()
    {
        $user = auth()->id();
        $data = Admin::where('id', $user)->first();
        $kategori = Kategori::all();
        $asset = Asset::all();
        $notifikasi = Notifikasi::where('status','belum dibaca')->orderBy('created_at', 'desc')->get();
        $pesanUser = PesanUser::limit(3)->get();
        $kamar = Kamar::all();
        $gambar = [];
        foreach ($kategori as $kat) {
            $gambar[$kat->id] = Gambar::where('kategori_id', $kat->id)->get();
        }
        return view('resepsionis.kamar', compact('data', 'kategori', 'kamar', 'gambar','asset','pesanUser','notifikasi'));
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
        $pesanUser = PesanUser::limit(3)->get();
        $asset = Asset::all();
        $kategori = Kategori::all();
        $notifikasi = Notifikasi::where('status','belum dibaca')->orderBy('created_at', 'desc')->get();
        $pemesanan = Pemesanan::with('kategori')->with('kamar')->orderBy('out', 'asc')->paginate(10);
        return view('resepsionis.booking', compact('data', 'pemesanan', 'kamar', 'kategori','asset','pesanUser','notifikasi'));
    }
    public function getBookingResepsionis()
    {
        $bookings = Pemesanan::with('kamar')->whereIn('status',['paid', 'unpaid'])->select(['id', 'kode', 'kamar_id', 'nama', 'in', 'out', 'jumlah_orang', 'total', 'status']); //select digunakan untuk mengambil beberapa seperti disamping contohnya jika tidak diberi select maka akan diambil semua

        return DataTables::of($bookings)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                <a class="btn btn-primary btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#detail' . $row->id . '">Detail</a>
                <br>
                <a href="/hapus/booking/' . $row->id . '" class="btn btn-danger btn-sm delete-button mt-1"><i class="fa-solid fa-xmark" aria-hidden="true" data-id="' . $row->id . '"></i> Check Out</a>
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
        DB::table('pemesanan')->update([
            'status' => 'selesai',
        ]);

        // Update status kamar menjadi kosong
        DB::table('kamar')
            ->where('id', $pemesanan->kamar_id)
            ->update(['status' => 'kosong']);

        Alert::success('Checkout', 'Berhasil Checkout');

        return redirect('/resepsionis/booking');
    }

    // Riwayat  
    public function riwayatResepsionis(){
        $user = auth()->id();
        $data = Admin::where('id', $user)->first();
        $pemesanan = Pemesanan::with('kategori')->with('kamar')->orderBy('out', 'asc')->paginate(10);
        $asset = Asset::all();
        $notifikasi = Notifikasi::where('status','belum dibaca')->orderBy('created_at', 'desc')->get();
        $pesanUser = PesanUser::limit(3)->get();
        return view('resepsionis.riwayat', compact('data', 'pemesanan','asset','pesanUser','notifikasi'));
    }
    public function getRiwayatResepsionis()
    {
        $bookings = Pemesanan::with('kamar')->where('status','selesai')->select(['id', 'kode', 'kamar_id', 'nama', 'in', 'out', 'jumlah_orang', 'total', 'status']);

        return DataTables::of($bookings)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                <a class="btn btn-warning btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#detail' . $row->id . '">Detail</a>
            ';
            })
            ->rawColumns(['action'])
            ->make(true);
            // <i class="fa-solid fa-pen-to-square"></i>
    }
    public function hapusNotifResepsionis($id)
    {
        DB::table('notif_booking')->where('id', $id)->update([
            'status' => 'dibaca',
        ]); 

        return redirect('/resepsionis/booking');
    }
}
