<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailPenyimpananController extends Controller
{
    public function index()
    {
        return view('admin.detail');
    }
}
