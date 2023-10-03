<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KuisionerSkalaPasarProduk extends Controller
{
    public function index(Request $request)
    {
        return view('surveyor.skalaPasarProduk');
    }
}
