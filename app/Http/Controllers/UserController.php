<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Gambar;
use App\Models\Kamar;
use App\Models\Kategori;
use App\Models\Pemesanan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->id();
        $login = User::where('id', $user)->get();
        $kategori = Kategori::all();
        $getgambar = DB::table('gambar')->limit(7)->get();
        $gambar = [];
        foreach ($kategori as $kat) {
            $gambar[$kat->id] = Gambar::where('kategori_id', $kat->id)->get();
        }
        return view('user.index', compact('login', 'kategori', 'gambar', 'getgambar'));
    }

    public function room()
    {
        $user = auth()->id();
        $login = User::where('id', $user)->get();
        $kategori = Kategori::all();
        $kamars = [];
        $gambar = [];
        foreach ($kategori as $kat) {
            $gambar[$kat->id] = Gambar::where('kategori_id', $kat->id)->get();
            $kamars[$kat->id] = Kamar::where('kategori_id', $kat->id)->where('status', 'kosong')->get();
        }
        return view('user.room', compact('login', 'kategori', 'gambar', 'kamars'));
    }
    public function tentang()
    {
        $getgambar = DB::table('gambar')->limit(7)->get();
        return view('user.tentang' , compact('getgambar'));
    }
    public function kontak()
    {
        return view('user.kontak');
    }
    public function reservasi()
    {
        return view('user.reservasi');
    }
    public function riwayat()
    {
        $data = Pemesanan::with('kategori')->with('kamar')->where('user_id', Auth::user()->id)->paginate(10);
        return view('user.riwayat', compact('data'));
    }
    public function pemesanan($id)
    {
        $data = Kategori::where('id', $id)->first();
        $kamar = Kamar::where('kategori_id', $data->id)->where('status', 'kosong')->get();
        $kategori = Kategori::all();
        $fasilitas = Kategori::with('fasilitas')->get();
        $users = auth()->id();
        $user = User::where('id', $users)->get();
        $gambar = [];
        foreach ($kategori as $kat) {
            $gambar[$kat->id] = Gambar::where('kategori_id', $kat->id)->get();
        }
        return view('user.pemesanan',  compact('user', 'data', 'kamar', 'kategori', 'gambar','fasilitas'));
    }
    public function pemesananFromKamar($id)
    {
        $kamar = Kamar::where('id', $id)->get(); 
        $data = $kamar->first()->kategori;
        $kategori = Kategori::all();
        $users = auth()->id();
        $user = User::where('id', $users)->get();
        $gambar = [];
        foreach ($kategori as $kat) {
            $gambar[$kat->id] = Gambar::where('kategori_id', $kat->id)->get();
        }

        return view('user.pemesanan', compact('data', 'kamar', 'user', 'gambar'));
    }

    public function cekKetersediaan(Request $request)
    {


        $checkinDate = Carbon::parse($request->checkin_date);
        $checkoutDate = Carbon::parse($request->checkout_date);
        $jumlahOrang = $request->jumlah_orang;


        // Logika untuk mengecek ketersediaan kamar
        $kamarTersedia = Kamar::where('status', 'kosong')
            ->where('kapasitas', '>=', $jumlahOrang)
            ->whereNotIn('id', function ($query) use ($checkinDate, $checkoutDate) {
                $query->select('kamar_id')
                    ->from('pemesanan')
                    ->where(function ($query) use ($checkinDate, $checkoutDate) {
                        $query->whereBetween('in', [$checkinDate, $checkoutDate])
                            ->orWhereBetween('out', [$checkinDate, $checkoutDate])
                            ->orWhere(function ($query) use ($checkinDate, $checkoutDate) {
                                $query->where('in', '<=', $checkinDate)
                                    ->where('out', '>=', $checkoutDate);
                            });
                    });
            })
            ->get();

        // Mengembalikan hasil ke view
        return view('user.ketersediaan', compact('kamarTersedia', 'checkinDate', 'checkoutDate', 'jumlahOrang'));
    }







    public function indexGuest()
    {
        $kategori = Kategori::all();
        $getgambar = DB::table('gambar')->limit(7)->get();
        $gambar = [];
        foreach ($kategori as $kat) {
            $gambar[$kat->id] = Gambar::where('kategori_id', $kat->id)->get();
        }
        return view('user.index', compact('kategori', 'gambar', 'getgambar'));
    }
    public function roomGuest()
    {
        $kategori = Kategori::all();
        $gambar = [];
        foreach ($kategori as $kat) {
            $gambar[$kat->id] = Gambar::where('kategori_id', $kat->id)->get();
        }
        return view('user.room', compact('kategori', 'gambar'));
    }
    public function tentangGuest()
    {
        $getgambar = DB::table('gambar')->limit(7)->get();
        return view('user.tentang', compact('getgambar'));
    }
    public function kontakGuest()
    {
        return view('user.kontak');
    }
    public function reservasiGuest()
    {
        return view('user.reservasi');
    }
}
