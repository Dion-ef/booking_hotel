<?php

namespace App\Http\Controllers;

use App\Events\NotifikasiPesan;
use App\Models\Asset;
use App\Models\Fasilitas;
use App\Models\Gambar;
use App\Models\Kamar;
use App\Models\Kategori;
use App\Models\Leadership;
use App\Models\Pemesanan;
use App\Models\PesanUser;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        return view('user.index', compact('login', 'kategori', 'gambar', 'getgambar', 'asset'));
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
        return view('user.room', compact('login', 'kategori', 'gambar', 'kamars', 'asset'));
    }
    public function tentang()
    {
        $leadership = Leadership::all();

        $getgambar = DB::table('gambar')->limit(7)->get();
        $asset = Asset::all();
        return view('user.tentang', compact('getgambar', 'asset', 'leadership'));
    }
    public function kontak()
    {
        $asset = Asset::all();
        return view('user.kontak', compact('asset'));
    }
    public function riwayat()
    {
        $data = Pemesanan::with('kategori')->with('kamar')->where('user_id', Auth::user()->id)->paginate(10);
        foreach ($data as $item) {
            $item->selisih_hari = \Carbon\Carbon::parse($item->out)->diffInDays(\Carbon\Carbon::parse($item->in));
        }
        $asset = Asset::all();
        $gambar = [];
        foreach ($data as $kat) {
            $gambar[$kat->id] = Gambar::where('kategori_id', $kat->kategori->id)->get();
        }
        return view('user.riwayat', compact('data', 'asset', 'gambar'));
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
        return view('user.pemesanan',  compact('user', 'data', 'kamar', 'kategori', 'gambar', 'fasilitas', 'asset'));
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

        return view('user.pemesanan', compact('data', 'kamar', 'user', 'gambar', 'asset'));
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
        return view('user.ketersediaan', compact('kamarTersedia', 'checkinDate', 'checkoutDate', 'jumlahOrang', 'asset'));
    }

    public function detail($id)
    {
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
        return view('user.detail', compact('user', 'data', 'kamar', 'kategori', 'gambar', 'fasilitas', 'kamars', 'asset'));
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
        return view('user.index', compact('kategori', 'gambar', 'getgambar', 'asset'));
    }
    public function roomGuest()
    {
        $kategori = Kategori::all();
        $asset = Asset::all();
        $kamars = [];
        $gambar = [];
        foreach ($kategori as $kat) {
            $gambar[$kat->id] = Gambar::where('kategori_id', $kat->id)->get();
            $kamars[$kat->id] = Kamar::where('kategori_id', $kat->id)->where('status', 'kosong')->get();
        }
        return view('user.room', compact('kategori', 'gambar', 'asset', 'kamars'));
    }
    public function tentangGuest()
    {
        $leadership = Leadership::all();
        $asset = Asset::all();
        $getgambar = DB::table('gambar')->limit(7)->get();
        return view('user.tentang', compact('getgambar', 'asset', 'leadership'));
    }
    public function kontakGuest()
    {
        $asset = Asset::all();
        return view('user.kontak', compact('asset'));
    }

    public function detailGuest($id)
    {
        $data = Kategori::where('id', $id)->first();
        $kamar = Kamar::where('kategori_id', $data->id)->where('status', 'kosong')->get();
        $kategori = Kategori::all();
        $fasilitas = Kategori::with('fasilitas')->get();
        $asset = Asset::all();
        $gambar = [];
        $kamars = [];
        foreach ($kategori as $kat) {
            $gambar[$kat->id] = Gambar::where('kategori_id', $kat->id)->get();
            $kamars[$kat->id] = Kamar::where('kategori_id', $kat->id)->where('status', 'kosong')->get();
        }
        return view('user.detail', compact('data', 'kamar', 'kategori', 'gambar', 'fasilitas', 'kamars', 'asset'));
    }

    public function cekKetersediaanGuest(Request $request)
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
        return view('user.ketersediaan', compact('kamarTersedia', 'checkinDate', 'checkoutDate', 'jumlahOrang', 'asset'));
    }

    public function pesan(Request $request)
    {
        $pesan = new PesanUser();
        $pesan->nama = $request->input('nama');
        $pesan->phone = $request->input('phone');
        $pesan->email = $request->input('email');
        $pesan->pesan = $request->input('pesan');
        $pesan->save();

        $notifPesan = [
            'nama' => $request->nama,
            'pesan' => $request->pesan,
        ];

        // Log data sebelum emit event    
        event(new NotifikasiPesan($notifPesan));

        return redirect()->back();
    }
    public function pesanGuest(Request $request)
    {

        $pesan = new PesanUser();
        $pesan->nama = $request->input('nama');
        $pesan->phone = $request->input('phone');
        $pesan->email = $request->input('email');
        $pesan->pesan = $request->input('pesan');
        $pesan->save();

        $notifPesan = [
            'nama' => $request->nama,
            'pesan' => $request->pesan,
        ];

        // Log data sebelum emit event    
        event(new NotifikasiPesan($notifPesan));

        return redirect()->back();
    }

    public function reviewStore(Request $request)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamar,id',
            'review' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = new Review();
        $review->users_id = auth()->id();
        $review->kamar_id = $request->kamar_id;
        $review->review = $request->input('review');
        $review->rating = $request->input('rating');
        $review->save();

        return redirect()->back();
    }
}
