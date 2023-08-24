<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailPenyimpanan;
use Illuminate\Http\Request;

class DetailPenyimpananController extends Controller
{
    public function index(Request $request, $id)
    {

        $dataDetail = DetailPenyimpanan::where('penyimpanan_id', $id)->get();
        // dd($dataDetail);

        return view('admin.detail', compact('dataDetail'));
    }
}
