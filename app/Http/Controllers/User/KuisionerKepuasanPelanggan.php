<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KuisionerKepuasanPelanggan extends Controller
{
    public function index(){
        return view('surveyor.kepuasanPelanggan');
    }
}
