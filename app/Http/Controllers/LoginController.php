<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Kamar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use illuminate\Support\Str;

class LoginController extends Controller
{
    public function login()
    {
        $asset = Asset::all();

        // Cek apakah asset kosong
        if ($asset->isEmpty()) {
            return redirect()->back()->with('error', 'Asset tidak ditemukan');
        }

        return view('login', compact('asset'));
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function register()
    {
        $asset = Asset::all();
        if ($asset->isEmpty()) {
            return redirect()->back()->with('error', 'Asset tidak ditemukan');
        }
        return view('register', compact('asset'));
    }

    // login dgn google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback()
    {
        try {
            $socialUser = Socialite::driver('google')->user();

            $findUser = User::where("google_id", $socialUser->id)->first();

            if (!$findUser) {
                $user = User::updateOrCreate([
                    'google_id' => $socialUser->id,
                ], [
                    'name' => $socialUser->name,
                    'email' => $socialUser->email,
                    'password' => Hash::make(Str::random(10)), // Password acak
                    'google_token' => $socialUser->token,
                    'google_refresh_token' => $socialUser->refreshToken,
                ]);
                Auth::guard('user')->login($user);
                return redirect('/user/index')->with('success', 'Login berhasil!');
            }

            Auth::guard('user')->login($findUser);
            return redirect('/user/index')->with('success', 'Login berhasil!');
        } catch (\Exception $e) {
            Log::error('Error during Google login: ' . $e->getMessage());

            // Redirect kembali ke halaman login dengan pesan error
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google. Silakan coba lagi.');
        }
    }

    function validasi(Request $request)
    {
        Session::flash('email', $request->email);
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi', // jika email tidak diisi maka akan tampil pesan tersebut
            'password.required' => 'Password wajib diisi',
            'email.email' => 'Format email tidak valid.',
        ]);

        $infologin = [ // variabel untuk menampung data email dan password yang diambil dari variabel request
            'email' => $request->email,
            'password' => $request->password,
        ];


        if (Auth::guard('admin')->attempt($infologin)) {

            $user = Auth::guard('admin')->user();

            if ($user->role === 'admin') {
                return redirect('/dashboard/admin');
            } elseif ($user->role === 'resepsionis') {
                return redirect('/dashboard/resepsionis');
            }
        } elseif (Auth::guard('user')->attempt($infologin)) {
            return redirect('/user/index');
        }
        return redirect('/login')->withErrors('Email atau Password salah ')->withInput();
    }
    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        try {
            //insert ke tabel users dengan query builder
            DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
    
            // Jika insert berhasil,di redirect ke halaman login
            return redirect('/login')->with('toast_success', 'Berhasil Membuat Akun');
        } catch (\Exception ) {    
            // Mengembalikan ke halaman sebelumnya dengan pesan error
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan saat membuat akun, silakan coba lagi.');
        }
    }
}
