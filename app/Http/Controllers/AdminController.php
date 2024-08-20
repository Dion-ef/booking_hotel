<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Asset;
use App\Models\Fasilitas;
use App\Models\Gambar;
use App\Models\Kamar;
use App\Models\Kategori;
use App\Models\Leadership;
use App\Models\Notifikasi;
use App\Models\Pemesanan;
use App\Models\PesanUser;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = auth()->id();
        $data = Admin::where('id', $user)->first();
        $totalKamarKosong = Kamar::where('status', 'kosong')->count();
        $totalKamarTerpakai = Kamar::where('status', 'dipakai')->count();
        $totalBooking = Pemesanan::count();
        $pesanUser = PesanUser::limit(3)->get();
        $checkInHariIni = Pemesanan::whereDate('in', Carbon::today())->count();
        $asset = Asset::all();
        return view('admin.dashboard', compact('data', 'totalKamarKosong', 'asset', 'totalBooking', 'totalKamarTerpakai', 'pesanUser', 'checkInHariIni'));
    }

    // update Profil
    public function profilUpdate(Request $request)
    {
        $request->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            //    'password'=>bcrypt($request->password),
        ]);
        return back()->with('success', 'Profil Berhasil diubah!');
    }


    // Kamar
    public function kamar()
    {
        $user = auth()->id();
        $data = Admin::where('id', $user)->first();
        $kategori = Kategori::all();
        $asset = Asset::all();
        $pesanUser = PesanUser::limit('3');
        return view('admin.kamar', compact('data', 'kategori', 'asset', 'pesanUser'));
    }
    public function getKamar(Request $request)
    {
        if ($request->ajax()) {
            $data = Kamar::with('kategori')->select(['*']); // Ambil data kamar beserta kategori, seslect * maka diambil semua
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $editButton = '<a class="btn btn-warning btn-sm btn-action" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editKamar' . $row->id . '">Edit</a>';
                    $deleteButton = '<a href="/hapus/kamar/' . $row->id . '" class="btn btn-danger btn-sm delete-button" data-id="' . $row->id . '"> Hapus</a>';
                    return $editButton . ' ' . $deleteButton;
                })
                ->rawColumns(['actions'])
                ->toJson();
        }
    }
    public function showKamar($id)
    {
        $kamar = Kamar::findOrFail($id);
        return response()->json($kamar);
    }
    public function tambahKamar(Request $request)
    {
        DB::table('kamar')->insert([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'status' => $request->status,
            'kapasitas' => $request->kapasitas,
        ]);
        return redirect('/kamar/admin')->with('success', 'kamar Berhasil ditambahkan!');
    }
    public function hapusKamar($id)
    {
        DB::table('kamar')->where('id', $id)->delete();
        Alert::success('Dihapus', 'Kamar Berhasil Dihapus!');
        return redirect('/kamar/admin');
    }
    public function updateKamar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:kamar,id',
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|integer|exists:kategori,id',
            'kapasitas' => 'required|integer',
            'status' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kamar = Kamar::find($request->id);
        $kamar->nama = $request->input('nama');
        $kamar->kategori_id = $request->input('kategori_id');
        $kamar->kapasitas = $request->input('kapasitas');
        $kamar->status = $request->input('status');
        $kamar->save();


        return redirect()->back()->with('success', 'Kamar berhasil diupdate');
    }



    // Kategori
    public function kategori()
    {
        $user = auth()->id();
        $data = Admin::where('id', $user)->first();
        $kategori = Kategori::paginate(3);
        $getgambar = Gambar::all();
        $asset = Asset::all();
        $fasilitas = Fasilitas::all();
        $gambar = [];
        foreach ($kategori as $kat) {
            $gambar[$kat->id] = Gambar::where('kategori_id', $kat->id)->get();
        }
        return view('admin.kategori', compact('data', 'kategori', 'gambar', 'getgambar', 'fasilitas', 'asset'));
    }
    public function getKategori(Request $request)
    {
        if ($request->ajax()) {
            $kategori = Kategori::with(['gambar', 'fasilitas']); // Sesuaikan relasi jika ada
            return DataTables::eloquent($kategori)
                ->addIndexColumn()
                ->addColumn('fasilitas', function ($row) {
                    $tags = $row->fasilitas->pluck('nama')->toArray();
                    $html = '<ul class="text-start">';
                    foreach ($tags as $tag) {
                        $html .= '<li class="fasilitas">' . $tag . '</li>';
                    }
                    $html .= '</ul>';
                    return $html;
                })
                ->addColumn('gambar', function ($row) {
                    $html = '<div class="image-container">';
                    if ($row->gambar) {
                        foreach ($row->gambar as $img) {
                            $html .= '<a data-bs-toggle="modal" data-bs-target="#gambar' . $img->id . '"><img src="' . asset('storage/' . $img->gambar) . '" class="custom-img" style="height: 100px; width: 100px; border-radius: 0 !important; object-fit: contain; margin: 5px;" alt="Gambar Kategori"></a>';
                        }
                    }
                    $html .= '</div>';
                    return $html;
                })
                ->addColumn('action', function ($row) {
                    $editButton = '<a class="btn btn-warning btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#editKategori' . $row->id . '"> Edit</a>';
                    $deleteButton = '<a href="/hapus/kategori/' . $row->id . '" class="btn btn-danger btn-sm delete-button-kategori" data-id="' . $row->id . '"> Hapus</a>';
                    $gambarButton = '<a class="btn btn-primary btn-sm btn-action mt-2" data-bs-toggle="modal" data-bs-target="#gambarKategori' . $row->id . '" > Tambah Gambar</a>';
                    return $editButton . ' ' . $deleteButton . '<br>' . $gambarButton;
                })
                ->rawColumns(['fasilitas', 'gambar', 'action'])
                ->make(true);
        }
        // <i class="fa-solid fa-pen-to-square"> <i class="fa-solid fa-trash-can" aria-hidden="true"></i> <i class="fa-solid fa-image"></i>
    }
    public function tambahKategori(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'fasilitas' => 'required|array',
            'deskripsi' => 'required',

        ]);


        $kategori = Kategori::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi

        ]);

        // Menyimpan relasi fasilitas dengan kategori
        $kategori->fasilitas()->attach($request->fasilitas);
        return redirect('/kategori/admin')->with('success', 'Kategori Berhasil ditambahkan!');
    }

    public function hapusKategori($id)
    {
        DB::table('kategori')->where('id', $id)->delete();
        Alert::success('Dihapus', 'Kategori Berhasil Dihapus!');

        return redirect('/kategori/admin');
    }
    public function updateKategori(Request $request)
    {

        $kategori = Kategori::find($request->id);
        $kategori->nama = $request->nama;
        $kategori->harga = $request->harga;
        $kategori->deskripsi = $request->deskripsi;
        $kategori->save();


        $kategori->fasilitas()->sync($request->fasilitas);
        return redirect('/kategori/admin')->with('success', 'Kategori Berhasil diubah!');
    }
    public function tambahGambar(Request $request, int $id)
    {
        // Validasi input
        $request->validate([
            'gambar.*' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048', //  ukuran maksimal 2MB
        ]);
        $kategori = Kategori::findOrFail($id);

        $imageData = [];

        // Proses pengunggahan gambar
        if ($request->hasFile('gambar')) {
            $files = $request->file('gambar');
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = "uploads/";
                $path = $file->store('uploads', 'public', $filename);

                $imageData[] = [
                    'kategori_id' => $kategori->id,
                    'gambar' => $path
                ];
            }
        }
        Gambar::insert($imageData);

        return redirect()->back()->with('succes', 'Berhasill');
    }
    public function hapusGambar($id)
    {
        DB::table('gambar')->where('id', $id)->delete();
        Alert::success('Dihapus', 'Gambar Berhasil Dihapus!');
        return redirect('/kategori/admin');
    }




    // booking
    public function booking()
    {
        $user = auth()->id();
        $data = Admin::where('id', $user)->first();
        $kamar = Kamar::all();
        $asset = Asset::all();
        $kategori = Kategori::all();
        $pemesanan = Pemesanan::with('kategori')->with('kamar')->orderBy('out', 'asc')->paginate(10);
        return view('admin.booking', compact('data', 'pemesanan', 'kamar', 'kategori', 'asset'));
    }
    public function getBooking()
    {
        $bookings = Pemesanan::with('kamar')->whereIn('status', ['paid', 'unpaid'])->select(['id', 'kode', 'kamar_id', 'nama', 'in', 'out', 'jumlah_orang', 'total', 'status']); //select digunakan untuk mengambil beberapa seperti disamping contohnya jika tidak diberi select maka akan diambil semua

        return DataTables::of($bookings)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                <a class="btn btn-primary btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#detail' . $row->id . '">Detail</a>
                <a class="btn btn-warning btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#edit' . $row->id . '"> Edit</a>
                <br>
                <a href="/hapus/booking/' . $row->id . '" class="btn btn-danger btn-sm delete-button mt-1" data-id="' . $row->id . '"><i class="fa-solid fa-xmark" aria-hidden="true"></i> Check Out</a>
            ';
            })
            ->rawColumns(['action'])
            ->make(true);
        // i class="fa-solid fa-eye"></i> <i class="fa-solid fa-xmark"></i>
    }
    public function updateBooking(Request $request)
    {
        $pemesanan = Pemesanan::find($request->id);

        if ($pemesanan) {
            $pemesanan->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'phone' => $request->phone,
                'jumlah_orang' => $request->jumlah_orang,
                'in' => $request->Checkin,
                'out' => $request->Checkout,
                'tgl_pemesanan' => $request->tgl_pemesanan,
                'harga' => $request->harga,
                'total' => $request->total,
                'kamar_id' => $request->kamar_id,
                'status' => $request->status,
            ]);

            return redirect('/booking/admin')->with('toast_success', 'Berhasil Update!');
        } else {
            return redirect('/booking/admin')->with('toast_error', 'Pemesanan tidak ditemukan!');
        }
    }
    public function hapusBooking($id)
    {
        // DB::table('pemesanan')->where('id', $id)->delete();
        $pemesanan = Pemesanan::with('kamar', 'kategori')->where('id', $id)->first();


        if (!$pemesanan) {
            return redirect('/booking/admin')->with('error', 'Pemesanan tidak ditemukan!');
        }

        // Simpan data pemesanan ke dalam tabel riwayat dengan query builder
        DB::table('pemesanan')->where('id', $id)->update([
            'status' => 'selesai',
        ]);

        // Update status kamar menjadi kosong
        DB::table('kamar')
            ->where('id', $pemesanan->kamar_id)
            ->update(['status' => 'kosong']);

        Alert::success('Checkout', 'Berhasil Checkout');

        return redirect('/booking/admin');
    }



    // Riwayat
    public function riwayat()
    {
        $user = auth()->id();
        $data = Admin::where('id', $user)->first();
        $kamar = Kamar::all();
        $asset = Asset::all();
        $kategori = Kategori::all();
        $pemesanan = Pemesanan::with('kategori')->with('kamar')->orderBy('out', 'asc')->paginate(10);
        return view('admin.riwayat', compact('data', 'pemesanan', 'kamar', 'kategori', 'asset'));
    }
    public function getRiwayat()
    {
        $bookings = Pemesanan::with('kamar')->with('kategori')->where('status', 'selesai')->select(['id', 'kode', 'kamar_id', 'nama', 'in', 'out', 'jumlah_orang', 'total', 'status']);

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



    // fasilitas
    public function fasilitas()
    {
        $user = auth()->id();
        $data = Admin::where('id', $user)->first();
        $fasilitas = Fasilitas::all();
        $asset = Asset::all();
        return view('admin.fasilitas', compact('data', 'fasilitas', 'asset'));
    }
    public function getFasilitas(Request $request)
    {
        if ($request->ajax()) {
            $data = Fasilitas::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-warning btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#editFasilitas' . $row->id . '"> Edit</a>';;
                    $btn .= ' <a href="/hapus/fasilitas/' . $row->id . '" class="btn btn-danger btn-sm delete-button mt-1" data-id="' . $row->id . '"> Hapus</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function tambahFasilitas(Request $request)
    {
        DB::table('fasilitas')->insert([
            'nama' => $request->nama,
        ]);

        return redirect('/fasilitas/admin')->with('success', 'Fasilitas Berhasil ditambahkan!');
    }
    public function updateFasilitas(Request $request)
    {
        $fasilitas = Fasilitas::find($request->id);
        $fasilitas->nama = $request->nama;
        $fasilitas->save();

        // Sinkronisasi fasilitas
        return redirect('/fasilitas/admin')->with('success', 'Fasilitas Berhasil diubah!');
    }
    public function hapusFasilitas($id)
    {
        DB::table('fasilitas')->where('id', $id)->delete();
        Alert::success('Dihapus', 'Fasilitas Berhasil Dihapus!');

        return redirect('/fasilitas/admin');
    }




    // Asset
    public function kelolaAsset()
    {
        $user = auth()->id();
        $data = Admin::where('id', $user)->first();
        $kategori = Kategori::all();
        $asset = Asset::all();
        return view('admin.kelola', compact('data', 'kategori', 'asset'));
    }

    public function tambahAsset(Request $request)
    {

        $request->validate([
            'nama_hotel' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'alamat' => 'required|string',
            'headline' => 'required|string',
            'deskripsi' => 'nullable|string',
            'background_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'welcome_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // simpan dengan eloquent
        $asset = new Asset();
        $asset->nama_hotel = $request->input('nama_hotel');
        $asset->email = $request->input('email');
        $asset->phone = $request->input('phone');
        $asset->alamat = $request->input('alamat');
        $asset->headline = $request->input('headline');
        $asset->deskripsi = $request->input('deskripsi');

        if ($request->hasFile('background_img')) {
            $backgroundImg = $request->file('background_img');
            $backgroundPath = $backgroundImg->store('public/asset_image/background');
            $asset->background_img = str_replace('public/', '', $backgroundPath);
        }
        if ($request->hasFile('welcome_img')) {
            $welcomeImg = $request->file('welcome_img');
            $welcomePath = $welcomeImg->store('public/asset_image/welcome_img');
            $asset->welcome_img = str_replace('public/', '', $welcomePath);
        }
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->store('public/asset_image/background');
            $asset->logo = str_replace('public/', '', $logoPath);
        }
        $asset->save();

        return redirect()->back()->with('success', 'Asset berhasil ditambahkan!');
    }

    public function getAsset(Request $request)
    {
        if ($request->ajax()) {
            $data = Asset::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('background_img', function ($row) {
                    return '<img src="' . asset('storage/' . $row->background_img) . '"  class="custom-img" style="height: 100px; width: 100px; border-radius: 0 !important; object-fit: contain; margin: 5px;">';
                })
                ->addColumn('logo', function ($row) {
                    return '<img src="' . asset('storage/' . $row->logo) . '" class="custom-img" style="height: 100px; width: 100px; border-radius: 0 !important; object-fit: contain; margin: 5px;">';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-warning btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#editAsset' . $row->id . '"> Edit</a>';
                    $btn .= ' <a  class="btn btn-primary btn-sm btn-action mt-1" data-bs-toggle="modal" data-bs-target="#detailAsset' . $row->id . '"> Detail</a>';
                    return $btn;
                })
                ->rawColumns(['background_img', 'logo', 'action'])
                ->make(true);
        }
    }

    public function updateAsset(Request $request)
    {
        $asset = Asset::find($request->id);
        $asset->nama_hotel = $request->nama_hotel;
        $asset->email = $request->email;
        $asset->phone = $request->phone;
        $asset->alamat = $request->alamat;
        $asset->headline = $request->input('headline');
        $asset->deskripsi = $request->input('deskripsi');

        if ($request->hasFile('background_img')) {
            if ($asset->background_img) {
                Storage::disk('public')->delete($asset->background_img);
            }
            $backgroundImg = $request->file('background_img');
            $backgroundPath = $backgroundImg->store('public/asset_image/background');
            $asset->background_img = str_replace('public/', '', $backgroundPath);
        }
        if ($request->hasFile('welcome_img')) {
            if ($asset->welcome_img) {
                Storage::disk('public')->delete($asset->welcome_img);
            }
            $welcomeImg = $request->file('welcome_img');
            $welcomePath = $welcomeImg->store('public/asset_image/welcome_img');
            $asset->welcome_img = str_replace('public/', '', $welcomePath);
        }
        if ($request->hasFile('logo')) {
            if ($asset->logo) {
                Storage::disk('public')->delete($asset->logo);
            }
            $logo = $request->file('logo');
            $logoPath = $logo->store('public/asset_image/welcome_img');
            $asset->logo = str_replace('public/', '', $logoPath);
        }

        $asset->save();


        return redirect()->back()->with('success', 'Asset berhasil diupdate');
    }

    // Leadership
    public function leadership()
    {
        $leadership = Leadership::all();
        $asset = Asset::all();
        return view('admin.leadership', compact('leadership', 'asset'));
    }
    public function tambahLeadership(Request $request)
    {

        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'motivasi' => 'nullable|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // simpan dengan eloquent
        $leadership = new Leadership();
        $leadership->nama = $request->input('nama');
        $leadership->jabatan = $request->input('jabatan');
        $leadership->motivasi = $request->input('motivasi');

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarPath = $gambar->store('public/asset_image/leadership');
            $leadership->gambar = str_replace('public/', '', $gambarPath);
        }
        $leadership->save();

        return redirect()->back()->with('success', 'Leadership berhasil ditambahkan!');
    }
    public function getLeadership(Request $request)
    {
        if ($request->ajax()) {
            $data = Leadership::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('gambar', function ($row) {
                    return '<img src="' . asset('storage/' . $row->gambar) . '"  class="custom-img" style="height: 100px; width: 100px; border-radius: 0 !important; object-fit: contain; margin: 5px;">';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-warning btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#editLeadership' . $row->id . '"> Edit</a>';
                    $btn .= ' <a  class="btn btn-primary btn-sm btn-action mt-1" data-bs-toggle="modal" data-bs-target="#detailLeadership' . $row->id . '"> Detail</a>';
                    $btn .= ' <a href="/hapus/leadership/' . $row->id . '" class="btn btn-danger btn-sm delete-button mt-1" data-id="' . $row->id . '"> Hapus</a>';
                    return $btn;
                })
                ->rawColumns(['gambar', 'action'])
                ->make(true);
        }
    }
    public function updateLeadership(Request $request)
    {
        $leadership = leadership::find($request->id);
        $leadership->nama = $request->nama;
        $leadership->jabatan = $request->jabatan;
        $leadership->motivasi = $request->motivasi;
        if ($request->hasFile('gambar')) {
            if ($leadership->gambar) {
                Storage::disk('public')->delete($leadership->gambar);
            }
            $gambar = $request->file('gambar');
            $gambarPath = $gambar->store('public/asset_image/leadership');
            $leadership->gambar = str_replace('public/', '', $gambarPath);
        }

        $leadership->save();


        return redirect()->back()->with('success', 'Leadership berhasil diupdate');
    }
    public function hapusLeadership($id)
    {
        DB::table('leadership')->where('id', $id)->delete();
        Alert::success('Dihapus', 'leadership Berhasil Dihapus!');

        return redirect()->back();
    }


    // hapus notif
    public function hapusNotifAdmin($id)
    {
        DB::table('notif_booking')->where('id', $id)->update([
            'status' => 'dibaca',
        ]);


        return redirect('/booking/admin');

        // DB::table('notif_booking')->where('id', $id)->update(['status' => 'dibaca']);

        // return response()->json(['success' => true]);
    }

}
