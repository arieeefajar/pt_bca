<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PosisiController extends Controller
{
    public function index()
    {
        return view('admin.posisi');
    }
}
