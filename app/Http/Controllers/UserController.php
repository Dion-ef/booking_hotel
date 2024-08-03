<?php

namespace App\Http\Controllers;

use App\Models\Asset;
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
        $asset = Asset::all();
        $gambar = [];
        foreach ($kategori as $kat) {
            $gambar[$kat->id] = Gambar::where('kategori_id', $kat->id)->get();
        }
        return view('user.index', compact('login', 'kategori', 'gambar', 'getgambar','asset'));
    }

    public function room()
    {
        $user = auth()->id();
        $login = User::where('id', $user)->get();
        $kategori = Kategori::all();
        $asset = Asset::all();
        $kamars = [];
        $gambar = [];
        foreach ($kategori as $kat) {
            $gambar[$kat->id] = Gambar::where('kategori_id', $kat->id)->get();
            $kamars[$kat->id] = Kamar::where('kategori_id', $kat->id)->where('status', 'kosong')->get();
        }
        return view('user.room', compact('login', 'kategori', 'gambar', 'kamars','asset'));
    }
    public function tentang()
    {
        $getgambar = DB::table('gambar')->limit(7)->get();
        $asset = Asset::all();
        return view('user.tentang' , compact('getgambar','asset'));
    }
    public function kontak()
    {
        $asset = Asset::all();
        return view('user.kontak',compact('asset'));
    }
    public function riwayat()
    {
        $data = Pemesanan::with('kategori')->with('kamar')->where('user_id', Auth::user()->id)->paginate(10);
        $asset = Asset::all();
        return view('user.riwayat', compact('data','asset'));
    }
    public function pemesanan($id)
    {
        $data = Kategori::where('id', $id)->first();
        $kamar = Kamar::where('kategori_id', $data->id)->where('status', 'kosong')->get();
        $kategori = Kategori::all();
        $fasilitas = Kategori::with('fasilitas')->get();
        $users = auth()->id();
        $asset = Asset::all();
        $user = User::where('id', $users)->get();
        $gambar = [];
        foreach ($kategori as $kat) {
            $gambar[$kat->id] = Gambar::where('kategori_id', $kat->id)->get();
        }
        return view('user.pemesanan',  compact('user', 'data', 'kamar', 'kategori', 'gambar','fasilitas','asset'));
    }
    public function pemesananFromKamar($id)
    {
        $kamar = Kamar::where('id', $id)->get(); 
        $data = $kamar->first()->kategori;
        $kategori = Kategori::all();
        $users = auth()->id();
        $asset = Asset::all();
        $user = User::where('id', $users)->get();
        $gambar = [];
        foreach ($kategori as $kat) {
            $gambar[$kat->id] = Gambar::where('kategori_id', $kat->id)->get();
        }

        return view('user.pemesanan', compact('data', 'kamar', 'user', 'gambar','asset'));
    }

    public function cekKetersediaan(Request $request)
    {


        $asset = Asset::all();
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
        return view('user.ketersediaan', compact('kamarTersedia', 'checkinDate', 'checkoutDate', 'jumlahOrang','asset'));
    }

    public function detail($id){
        $data = Kategori::where('id', $id)->first();
        $kamar = Kamar::where('kategori_id', $data->id)->where('status', 'kosong')->get();
        $kategori = Kategori::all();
        $fasilitas = Kategori::with('fasilitas')->get();
        $users = auth()->id();
        $asset = Asset::all();
        $user = User::where('id', $users)->get();
        $gambar = [];
        $kamars = [];
        foreach ($kategori as $kat) {
            $gambar[$kat->id] = Gambar::where('kategori_id', $kat->id)->get();
            $kamars[$kat->id] = Kamar::where('kategori_id', $kat->id)->where('status', 'kosong')->get();
        }
        return view('user.detail',compact('user', 'data', 'kamar', 'kategori', 'gambar','fasilitas','kamars','asset'));
    }






    public function indexGuest()
    {
        $kategori = Kategori::all();
        $getgambar = DB::table('gambar')->limit(7)->get();
        $asset = Asset::all();
        $gambar = [];
        foreach ($kategori as $kat) {
            $gambar[$kat->id] = Gambar::where('kategori_id', $kat->id)->get();
        }
        return view('user.index', compact('kategori', 'gambar', 'getgambar','asset'));
    }
    public function roomGuest()
    {
        $kategori = Kategori::all();
        $asset = Asset::all();
        $gambar = [];
        foreach ($kategori as $kat) {
            $gambar[$kat->id] = Gambar::where('kategori_id', $kat->id)->get();
        }
        return view('user.room', compact('kategori', 'gambar','asset'));
    }
    public function tentangGuest()
    {
        $asset = Asset::all();
        $getgambar = DB::table('gambar')->limit(7)->get();
        return view('user.tentang', compact('getgambar','asset'));
    }
    public function kontakGuest()
    {
        $asset = Asset::all();
        return view('user.kontak', compact('asset'));
    }
}
