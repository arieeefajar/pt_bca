<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Penyimpanan;
use Illuminate\Http\Request;

class PenyimpananController extends Controller
{
    public function index()
    {
        $dataPenyimpanan = Penyimpanan::with('customer', 'surveyor')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.penyimpanan', compact('dataPenyimpanan'));
    }
}
