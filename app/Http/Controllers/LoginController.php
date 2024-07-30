<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function register(){
        return view('register');
    }

    // login with google
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }
    public function callback(){
        $socialUser = Socialite::driver('google')->user();
        $findUser = User::where("google_id", $socialUser->id)->first();

        if(!$findUser){
            $user = User::updateOrCreate([
                'google_id' => $socialUser->id,
            ],[
                'name' =>$socialUser->name,
                'email' =>$socialUser->email,
                // 'password' =>bcrypt('1234'),
                //untuk password acak
                'password' => Hash::make(Str::random(10)),
                'google_token' =>$socialUser->token,
                'google_refresh_token' =>$socialUser->refreshToken,
                
            ]);
            Auth::guard('user')->login($user);
            return redirect('/user/index');
        }
        Auth::guard('user')->login($findUser);
        return redirect('/user/index');
    }

    function validasi(Request $request){
        Session::flash('email',$request->email);
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'Email wajib diisi', //jika email tidak diisi maka akan tampil pesan tersebut
            'password.required'=>'Password wajib diisi',
        ]);

        $infologin = [ //variabel untuk menampung data email dan password yang diambil dari variabel request
            'email'=>$request->email,
            'password'=>$request->password,
        ];
            // if(Auth::guard('admin')->attempt($infologin)){
            //     return redirect('/dashboard/admin');
            // }elseif(Auth::guard('user')->attempt($infologin)){
            //     return redirect('/user/index');
            // }

            if(Auth::guard('admin')->attempt($infologin)){
                $user = Auth::guard('admin')->user();
                
                if ($user->role === 'admin') {
                    return redirect('/dashboard/admin');
                } elseif ($user->role === 'resepsionis') {
                    return redirect('/dashboard/resepsionis');
                }
                
            }elseif(Auth::guard('user')->attempt($infologin)){
                return redirect('/user/index');
            }
        
            return redirect('/login')->withErrors('Email atau Password salah ')->withInput();
        
    }
    public function registerStore(Request $request){
        //dengan query builder
        DB::table('users')->insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        return redirect('/login')->with('toast_success', 'Berhasil Membuat Akun');
    }

}
