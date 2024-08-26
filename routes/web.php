<?php

use App\Events\NotifikasiBooking;
use App\Events\NotifikasiPesan;
use App\Http\Controllers\UserController;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Support\Facades\Log;
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

// login menggunakan google
Route::get('/auth/google', [App\Http\Controllers\LoginController::class, 'redirect'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\LoginController::class, 'callback'])->name('google.callback');

Route::middleware('guest')->group(function () {
    // halaman untuk user yang belum login
    Route::get('/index', [App\Http\Controllers\UserController::class, 'indexGuest']);
    Route::get('/room', [App\Http\Controllers\UserController::class, 'roomGuest']);
    Route::get('/tentang', [App\Http\Controllers\UserController::class, 'tentangGuest']);
    Route::get('/kontak', [App\Http\Controllers\UserController::class, 'kontakGuest']);
    Route::get('/user/detail', [App\Http\Controllers\UserController::class, 'detail']);
    Route::get('/user/guest/detail/{id}', [App\Http\Controllers\UserController::class, 'detailGuest']);
    Route::get('/user/cek-ketersediaan', [UserController::class, 'cekKetersediaanGuest'])->name('cek-ketersediaan-guest');
    Route::post('/pesan/guest', [App\Http\Controllers\UserController::class, 'pesanGuest']);
});


// rout untuk admin
Route::group(['middleware' => ['auth:admin', 'check.role:admin']], function () {
    Route::get('/dashboard/admin', [App\Http\Controllers\AdminController::class, 'dashboard']);
    Route::get('/kamar/admin', [App\Http\Controllers\AdminController::class, 'kamar']);
    Route::get('/kamar/get', [App\Http\Controllers\AdminController::class, 'getKamar'])->name('kamar.data');
    Route::post('/tambah/kamar', [App\Http\Controllers\AdminController::class, 'tambahKamar']);
    Route::get('kamar/{id}', [App\Http\Controllers\AdminController::class, 'showKamar'])->name('kamar.show');
    Route::post('/update/kamar', [App\Http\Controllers\AdminController::class, 'updateKamar'])->name('kamar.update');
    Route::get('/hapus/kamar/{id}', [App\Http\Controllers\AdminController::class, 'hapusKamar'])->name('hapusKamar');
    Route::get('/kategori/admin', [App\Http\Controllers\AdminController::class, 'kategori']);
    Route::get('/kategori/get', [App\Http\Controllers\AdminController::class, 'getKategori'])->name('admin.kategori.data');
    Route::post('/update/kategori', [App\Http\Controllers\AdminController::class, 'updateKategori']);
    Route::get('/hapus/kategori/{id}', [App\Http\Controllers\AdminController::class, 'hapusKategori'])->name('hapusKategori');
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
    Route::get('/fasilitas/admin', [App\Http\Controllers\AdminController::class, 'fasilitas']);
    Route::get('/fasilitas/get', [App\Http\Controllers\AdminController::class, 'getFasilitas'])->name('admin.fasilitas.data');
    Route::post('/tambah/fasilitas', [App\Http\Controllers\AdminController::class, 'tambahFasilitas']);
    Route::post('/update/fasilitas', [App\Http\Controllers\AdminController::class, 'updateFasilitas']);
    Route::get('/hapus/fasilitas/{id}', [App\Http\Controllers\AdminController::class, 'hapusFasilitas']);
    Route::get('/kelola/asset/admin', [App\Http\Controllers\AdminController::class, 'kelolaAsset'])->name('asset.admin');
    Route::post('/tambah/asset', [App\Http\Controllers\AdminController::class, 'tambahAsset']);
    Route::get('/asset/get', [App\Http\Controllers\AdminController::class, 'getAsset'])->name('admin.asset.data');
    Route::post('/update/asset', [App\Http\Controllers\AdminController::class, 'updateAsset']);
    Route::get('/kelola/leadership/admin', [App\Http\Controllers\AdminController::class, 'leadership']);
    Route::post('/tambah/leadership', [App\Http\Controllers\AdminController::class, 'tambahLeadership']);
    Route::get('/leadership/get', [App\Http\Controllers\AdminController::class, 'getLeadership'])->name('admin.leadership.data');
    Route::post('/update/leadership', [App\Http\Controllers\AdminController::class, 'updateLeadership']);
    Route::get('/hapus/leadership/{id}', [App\Http\Controllers\AdminController::class, 'hapusLeadership']);
    Route::get('/hapus/notifikasi/{id}', [App\Http\Controllers\AdminController::class, 'hapusNotifAdmin']);
});


// rout untuk user yang sudah login
Route::group(['middleware' => ['auth:user']], function () {
    Route::get('/user/index', [App\Http\Controllers\UserController::class, 'index'])->middleware('auth');
    Route::get('/user/room', [App\Http\Controllers\UserController::class, 'room'])->middleware('auth');
    Route::get('/user/tentang', [App\Http\Controllers\UserController::class, 'tentang'])->middleware('auth');
    Route::get('/user/kontak', [App\Http\Controllers\UserController::class, 'kontak'])->middleware('auth');
    Route::get('/user/riwayat', [App\Http\Controllers\UserController::class, 'riwayat'])->middleware('auth');
    Route::get('/user/pemesanan/{id}', [App\Http\Controllers\UserController::class, 'pemesanan'])->middleware('auth')->name('user.pemesanan');
    Route::get('/user/pemesanan/kamar/{id}', [App\Http\Controllers\UserController::class, 'pemesananFromKamar'])->middleware('auth')->name('user.pemesananFromKamar');
    Route::post('/user/pesan/{id}', [App\Http\Controllers\PesananController::class, 'checkIn'])->middleware('auth');
    Route::get('/booking/konfirmasi/{id}', [App\Http\Controllers\PesananController::class, 'konfirmasi'])->middleware('auth')->name('booking.confirm');
    Route::get('/cek-ketersediaan', [UserController::class, 'cekKetersediaan'])->name('cek-ketersediaan');
    Route::get('/user/detail/{id}', [App\Http\Controllers\UserController::class, 'detail'])->middleware('auth');
    Route::post('/pesan', [App\Http\Controllers\UserController::class, 'pesan'])->middleware('auth');
    Route::post('/user/review', [App\Http\Controllers\UserController::class, 'reviewStore'])->middleware('auth')->name('review.store');
    Route::post('/payment', [App\Http\Controllers\PaymentController::class, 'createPayment'])->middleware('auth');
    Route::get('/payment/success', [App\Http\Controllers\PaymentController::class, 'redirectSuccess']);
});

// Resepsionis
Route::group(['middleware' => ['auth.admin', 'check.role:resepsionis']], function () {
    Route::get('/dashboard/resepsionis', [App\Http\Controllers\ResepsionisController::class, 'index']);
    Route::post('/update/profil/resepsionis', [App\Http\Controllers\ResepsionisController::class, 'profilUpdateResepsionis']);
    Route::get('/resepsionis/kamar', [App\Http\Controllers\ResepsionisController::class, 'kamarResepsionis']);
    Route::get('/resepsionis/get/kamar', [App\Http\Controllers\ResepsionisController::class, 'getKamarResepsionis'])->name('resepsionis.kamar');
    Route::get('/resepsionis/booking', [App\Http\Controllers\ResepsionisController::class, 'bookingResepsionis']);
    Route::get('/hapus/booking/resepsionis/{id}', [App\Http\Controllers\ResepsionisController::class, 'hapusBookingResepsionis']);
    Route::get('/booking/resepsionis/get', [App\Http\Controllers\ResepsionisController::class, 'getBookingResepsionis'])->name('resepsionis.booking.data');
    Route::get('/checkout/booking/{id}', [App\Http\Controllers\ResepsionisController::class, 'checkoutBookingResepsionis']);
    Route::get('/resepsionis/riwayat', [App\Http\Controllers\ResepsionisController::class, 'riwayatResepsionis']);
    Route::get('/resepsionis/riwayat/get', [App\Http\Controllers\ResepsionisController::class, 'getRiwayatResepsionis'])->name('resepsionis.riwayat.data');
    Route::get('/hapus/notifikasi/resepsionis/{id}', [App\Http\Controllers\ResepsionisController::class, 'hapusNotifResepsionis']);
});

// callback paymnet xendit
Route::post('/payment/webhook', [App\Http\Controllers\PaymentController::class, 'webhookCallback']);
// chart
Route::get('/chart/kamar', [App\Http\Controllers\ChartController::class, 'kamarFavorit']);
Route::get('/chart/booking', [App\Http\Controllers\ChartController::class, 'totalBooking']);

// get notif
Route::get('/get/notifikasi', [App\Http\Controllers\PesananController::class, 'getNotifikasi']);
