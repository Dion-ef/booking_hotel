<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// login dan registrasi
Route::get('/login', [App\Http\Controllers\LoginController::class, 'login'])->middleware('guest')->name('login');
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout']);
Route::get('/register', [App\Http\Controllers\LoginController::class, 'register']);
Route::post('/register/store', [App\Http\Controllers\LoginController::class, 'registerStore']);
Route::post('/user/validasi', [App\Http\Controllers\LoginController::class, 'validasi']);

// halaman untuk user yang belum login
Route::get('/index', [App\Http\Controllers\UserController::class, 'indexGuest'])->middleware('guest');
Route::get('/room', [App\Http\Controllers\UserController::class, 'roomGuest'])->middleware('guest');
Route::get('/tentang', [App\Http\Controllers\UserController::class, 'tentangGuest'])->middleware('guest');
Route::get('/kontak', [App\Http\Controllers\UserController::class, 'kontakGuest'])->middleware('guest');
Route::get('/reservasi', [App\Http\Controllers\UserController::class, 'reservasiGuest'])->middleware('guest');

// login menggunakan google
Route::get('/auth/google', [App\Http\Controllers\LoginController::class, 'redirect'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\LoginController::class, 'callback'])->name('google.callback');

// rout untuk admin
Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('/dashboard/admin', [App\Http\Controllers\AdminController::class, 'dashboard']);
    Route::get('/kamar/admin', [App\Http\Controllers\AdminController::class, 'kamar']);
    Route::get('/kamar/get', [App\Http\Controllers\AdminController::class, 'getKamar'])->name('kamar.data');
    Route::post('/tambah/kamar', [App\Http\Controllers\AdminController::class, 'tambahKamar']);
    Route::get('kamar/{id}', [App\Http\Controllers\AdminController::class, 'showKamar'])->name('kamar.show');
    Route::post('/update/kamar', [App\Http\Controllers\AdminController::class, 'updateKamar'])->name('kamar.update');
    Route::get('/hapus/kamar/{id}', [App\Http\Controllers\AdminController::class, 'hapusKamar']);
    Route::get('/kategori/admin', [App\Http\Controllers\AdminController::class, 'kategori']);
    Route::get('/kategori/get', [App\Http\Controllers\AdminController::class, 'getKategori'])->name('admin.kategori.data');
    Route::post('/update/kategori', [App\Http\Controllers\AdminController::class, 'updateKategori']);
    Route::get('/hapus/kategori/{id}', [App\Http\Controllers\AdminController::class, 'hapusKategori']);
    Route::post('/tambah/kategori', [App\Http\Controllers\AdminController::class, 'tambahKategori']);
    Route::post('/kategori/{id}/tambah-gambar', [App\Http\Controllers\AdminController::class, 'tambahGambar'])->name('kategori.tambah.gambar');
    Route::get('/hapus/gambar/{id}', [App\Http\Controllers\AdminController::class, 'hapusGambar']);
    Route::post('/update/profil', [App\Http\Controllers\AdminController::class, 'profilUpdate']);
    Route::get('/booking/admin', [App\Http\Controllers\AdminController::class, 'booking']);
    Route::get('/booking/get', [App\Http\Controllers\AdminController::class, 'getBooking'])->name('admin.booking.data');
    Route::post('/update/booking', [App\Http\Controllers\AdminController::class, 'updateBooking']);
    Route::get('/hapus/booking/{id}', [App\Http\Controllers\AdminController::class, 'hapusBooking']);
    Route::get('/pencarian/kamar', [App\Http\Controllers\AdminController::class, 'pencarianKamar']);
    Route::get('/pencarian/booking', [App\Http\Controllers\AdminController::class, 'pencarianBooking']);
    Route::get('/pencarian/kategori', [App\Http\Controllers\AdminController::class, 'pencarianKategori']);
    Route::get('/pencarian/riwayat', [App\Http\Controllers\AdminController::class, 'pencarianRiwayat']);
    Route::get('/riwayat/admin', [App\Http\Controllers\AdminController::class, 'riwayat']);
    Route::get('/riwayat/get', [App\Http\Controllers\AdminController::class, 'getRiwayat'])->name('admin.riwayat.data');
    Route::get('/cetak/admin', [App\Http\Controllers\PdfController::class, 'cetakPdf']);
    Route::get('/pdf', [App\Http\Controllers\PdfController::class, 'pdf']);
    Route::get('/fasilitas/admin', [App\Http\Controllers\AdminController::class, 'fasilitas']);
    Route::get('/fasilitas/get', [App\Http\Controllers\AdminController::class, 'getFasilitas'])->name('admin.fasilitas.data');
    Route::post('/tambah/fasilitas', [App\Http\Controllers\AdminController::class, 'tambahFasilitas']);
    Route::post('/update/fasilitas', [App\Http\Controllers\AdminController::class, 'updateFasilitas']);
    Route::get('/hapus/fasilitas/{id}', [App\Http\Controllers\AdminController::class, 'hapusFasilitas']);






});

// rout untuk user yang sudah login
Route::group(['middleware' => ['auth:user']], function () {
    Route::get('/user/index', [App\Http\Controllers\UserController::class, 'index'])->middleware('auth');
    Route::get('/user/room', [App\Http\Controllers\UserController::class, 'room'])->middleware('auth');
    Route::get('/user/tentang', [App\Http\Controllers\UserController::class, 'tentang'])->middleware('auth');
    Route::get('/user/kontak', [App\Http\Controllers\UserController::class, 'kontak'])->middleware('auth');
    Route::get('/user/reservasi', [App\Http\Controllers\UserController::class, 'reservasi'])->middleware('auth');
    Route::get('/user/riwayat', [App\Http\Controllers\UserController::class, 'riwayat'])->middleware('auth');
    Route::get('/user/pemesanan/{id}', [App\Http\Controllers\UserController::class, 'pemesanan'])->middleware('auth')->name('user.pemesanan');
    Route::get('/user/pemesanan/kamar/{id}', [App\Http\Controllers\UserController::class, 'pemesananFromKamar'])->middleware('auth')->name('user.pemesananFromKamar');
    Route::post('/user/pesan/{id}', [App\Http\Controllers\PesananController::class, 'checkIn'])->middleware('auth');
    Route::get('/booking/konfirmasi/{id}', [App\Http\Controllers\PesananController::class, 'konfirmasi'])->middleware('auth')->name('booking.confirm');
    Route::get('/cek-ketersediaan', [UserController::class, 'cekKetersediaan'])->name('cek-ketersediaan');
});
