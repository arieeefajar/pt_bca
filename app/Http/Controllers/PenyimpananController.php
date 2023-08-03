<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenyimpananController extends Controller
{
    public function index()
    {
        return view('admin.penyimpanan');
    }
}
