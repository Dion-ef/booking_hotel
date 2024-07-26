<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Fasilitas;
use App\Models\Gambar;
use App\Models\Kamar;
use App\Models\Kategori;
use App\Models\Pemesanan;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = auth()->id();
        $data = Admin::where('id', $user)->first();
        $totalKamar = Kamar::count();
        return view('admin.dashboard', compact('data', 'totalKamar'));
    }
    // update Profil
    public function profilUpdate(Request $request)
    {
        $request->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            //    'password'=>bcrypt($request->password),
        ]);
        return back()->with('toast_success', 'Profil Berhasil diubah!');
    }


    // Kamar
    public function kamar()
    {
        $user = auth()->id();
        $data = Admin::where('id', $user)->first();
        $kategori = Kategori::all();
        return view('admin.kamar', compact('data', 'kategori'));
    }
    public function getKamar(Request $request)
    {
        if ($request->ajax()) {
            $data = Kamar::with('kategori')->select(['*']); // Ambil data kamar beserta kategori
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $editButton = '<a class="btn btn-warning btn-sm btn-action" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editKamar' . $row->id . '">Edit</a>';
                    $deleteButton = '<a href="/hapus/kamar/' . $row->id . '" class="btn btn-danger btn-sm btn-action"> Hapus</a>';
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
        // $request->validate([
        //     'fasilitas'=> 'required|string',
        // ]);
        // $emailArray = explode(',', $request->fasilitas);
        // foreach ($emailArray as $email) {
        //     Kamar::create([
        //         'fasilitas' => trim($email),
        //         'nama'=>$request->nama,
        //         'kategori_id'=>$request->kategori_id,
        //         'status'=>$request->status,
        //         'kapasitas'=>$request->kapasitas,
        //          // Hapus spasi ekstra di awal dan akhir
        //     ]);
        // }
        // Alert::success('Success Title', 'Success Message');
        return redirect('/kamar/admin')->with('toast_success', 'Barang Berhasil ditambahkan!');
    }
    public function hapusKamar($id)
    {
        DB::table('kamar')->where('id', $id)->delete();
        return redirect('/kamar/admin')->with('info', 'Data Berhasil Dihapus!');
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
        $fasilitas = Fasilitas::all();
        $gambar = [];
        foreach ($kategori as $kat) {
            $gambar[$kat->id] = Gambar::where('kategori_id', $kat->id)->get();
        }
        return view('admin.kategori', compact('data', 'kategori', 'gambar', 'getgambar', 'fasilitas'));
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
                    $deleteButton = '<a href="/hapus/kategori/' . $row->id . '" class="btn btn-danger btn-sm btn-action"> Hapus</a>';
                    $gambarButton = '<a class="btn btn-primary btn-sm btn-action mt-2" data-bs-toggle="modal" data-bs-target="#gambarKategori' . $row->id . '"> Tambah Gambar</a>';
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
            'fasilitas' => 'required|array'
        ]);

        // Membuat kategori
        $kategori = Kategori::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
        ]);

        // Menyimpan relasi fasilitas dengan kategori
        $kategori->fasilitas()->attach($request->fasilitas);
        return redirect('/kategori/admin')->with('toast_success', 'Barang Berhasil ditambahkan!');
    }

    public function hapusKategori($id)
    {
        DB::table('kategori')->where('id', $id)->delete();
        return redirect('/kategori/admin')->with('info', 'Data Berhasil Dihapus!');
    }
    public function updateKategori(Request $request)
    {

        $kategori = Kategori::find($request->id);
        $kategori->nama = $request->nama;
        $kategori->harga = $request->harga;
        $kategori->save();

        // Sinkronisasi fasilitas
        $kategori->fasilitas()->sync($request->fasilitas);
        return redirect('/kategori/admin')->with('toast_success', 'Barang Berhasil diubah!');
    }
    public function tambahGambar(Request $request, int $id)
    {
        // Validasi input
        $request->validate([
            'gambar.*' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048', // Pastikan gambar dengan ukuran maksimal 2MB
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
        return redirect('/kategori/admin')->with('info', 'Gambar Berhasil Dihapus!');
    }




    // booking
    public function booking()
    {
        $user = auth()->id();
        $data = Admin::where('id', $user)->first();
        $kamar = Kamar::all();
        $kategori = Kategori::all();
        $pemesanan = Pemesanan::with('kategori')->with('kamar')->orderBy('out', 'asc')->paginate(10);
        return view('admin.booking', compact('data', 'pemesanan', 'kamar', 'kategori'));
    }
    public function getBooking()
    {
        $bookings = Pemesanan::with('kamar')->select(['id', 'kode', 'kamar_id', 'nama', 'in', 'out', 'jumlah_orang', 'total', 'status']); //select digunakan untuk mengambil beberapa seperti disamping contohnya jika tidak diberi select maka akan diambil semua

        return DataTables::of($bookings)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                <a class="btn btn-primary btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#detail' . $row->id . '">Detail</a>
                <a class="btn btn-warning btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#edit' . $row->id . '"> Edit</a>
                <br>
                <a href="/hapus/booking/' . $row->id . '" class="btn btn-danger btn-sm btn-action mt-1"><i class="fa-solid fa-xmark" aria-hidden="true"></i> Check Out</a>
            ';
            })
            ->rawColumns(['action'])
            ->make(true);
            // i class="fa-solid fa-eye"></i> <i class="fa-solid fa-xmark"></i>
    }
    public function updateBooking(Request $request)
    {
        DB::table('pemesanan')->where('id', $request->id)->update([
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
    }
    public function hapusBooking($id)
    {
        // DB::table('pemesanan')->where('id', $id)->delete();
        $pemesanan = Pemesanan::with('kamar', 'kategori')->where('id', $id)->first();

        // Pastikan pemesanan ditemukan
        if (!$pemesanan) {
            return redirect('/booking/admin')->with('error', 'Pemesanan tidak ditemukan!');
        }

        // Simpan data pemesanan ke dalam tabel riwayat
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
            // tambahkan kolom lain yang relevan
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Hapus pemesanan dari tabel pemesanan
        DB::table('pemesanan')->where('id', $id)->delete();

        // Update status kamar menjadi kosong
        DB::table('kamar')
            ->where('id', $pemesanan->kamar_id)
            ->update(['status' => 'kosong']);
        return redirect('/booking/admin')->with('info', 'Berhasil CheckOut!');
    }

    // Riwayat
    public function riwayat()
    {
        $user = auth()->id();
        $data = Admin::where('id', $user)->first();
        $riwayat = Riwayat::paginate(10);
        return view('admin.riwayat', compact('data', 'riwayat'));
    }
    public function getRiwayat()
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



    // fasilitas
    public function fasilitas()
    {
        $user = auth()->id();
        $data = Admin::where('id', $user)->first();
        $fasilitas = Fasilitas::all();
        return view('admin.fasilitas', compact('data', 'fasilitas'));
    }
    public function getFasilitas(Request $request)
    {
        if ($request->ajax()) {
            $data = Fasilitas::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-warning btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#editFasilitas' . $row->id . '"> Edit</a>';;
                    $btn .= ' <a href="/hapus/fasilitas/' . $row->id . '" class="btn btn-danger btn-sm btn-action mt-1"> Hapus</a>';
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

        return redirect('/fasilitas/admin')->with('toast_success', 'Barang Berhasil ditambahkan!');
    }
    public function updateFasilitas(Request $request)
    {
        $fasilitas = Fasilitas::find($request->id);
        $fasilitas->nama = $request->nama;
        $fasilitas->save();

        // Sinkronisasi fasilitas
        return redirect('/fasilitas/admin')->with('toast_success', 'Barang Berhasil diubah!');
    }
    public function hapusFasilitas($id)
    {
        DB::table('fasilitas')->where('id', $id)->delete();
        return redirect('/fasilitas/admin')->with('info', 'Data Berhasil Dihapus!');
    }



    // // pencarian
    // public function pencarianKamar(Request $request)
    // {
    //     $user = auth()->id();
    //     $data = Admin::where('id', $user)->get();
    //     $kategori = Kategori::all();
    //     if ($request->has('search')) {
    //         $kamar = Kamar::with('kategori')->where('nama', 'LIKE', '%' . $request->search . '%')->paginate(10);
    //         $kamar->appends(['search' => $request->search]);
    //     } else {
    //         $kamar = Kamar::with('kategori')->paginate(10);
    //     }
    //     return view('admin.kamar', compact('data', 'kategori', 'kamar'));
    // }
    // public function pencarianBooking(Request $request)
    // {
    //     $user = auth()->id();
    //     $data = Admin::where('id', $user)->get();
    //     if ($request->has('search')) {

    //         $pemesanan = Pemesanan::with('kategori')->with('kamar')->where('nama', 'LIKE', '%' . $request->search . '%')->paginate(10);
    //         $pemesanan->appends(['search' => $request->search]);
    //     } else {
    //         $pemesanan = Pemesanan::with('kategori')->with('kamar')->paginate(10);
    //     }
    //     return view('admin.booking', compact('data', 'pemesanan'));
    // }
    // public function pencarianKategori(Request $request)
    // {
    //     if ($request->has('search')) {
    //         $user = auth()->id();
    //         $data = Admin::where('id', $user)->get();
    //         $kategori = Kategori::where('nama', 'LIKE', '%' . $request->search . '%')->paginate(10);
    //         $gambar = [];
    //         foreach ($kategori as $kat) {
    //             $gambar[$kat->id] = Gambar::where('kategori_id', $kat->id)->get();
    //         }
    //     } else {
    //         $kategori = Kategori::paginate(10);
    //     }
    //     return view('admin.kategori', compact('data', 'kategori'));
    // }
    // public function pencarianRiwayat(Request $request)
    // {
    //     $user = auth()->id();
    //     $data = Admin::where('id', $user)->get();
    //     if ($request->has('search')) {
    //         $riwayat = Riwayat::where('nama', 'LIKE', '%' . $request->search . '%')->paginate(10);
    //         $riwayat->appends(['search' => $request->search]);
    //     } else {
    //         $riwayat = Riwayat::paginate(10);
    //     }
    //     return view('admin.riwayat', compact('data', 'riwayat'));
    // }


}
