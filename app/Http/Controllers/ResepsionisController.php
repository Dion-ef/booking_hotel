<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResepsionisController extends Controller
{
    public function index(){
        return view('resepsionis.dashboard');
    }
}
