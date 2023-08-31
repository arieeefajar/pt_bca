<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailPenyimpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DetailPenyimpananController extends Controller
{
    public function index(Request $request, $id)
    {

        $dataDetail = DetailPenyimpanan::where('penyimpanan_id', $id)->get();
        // dd($dataDetail);
        $apiId = '64ef510d5f34884e0e7b8dd1';
        $endPointApi = 'http://103.175.216.72/api/simi/customer/' . $apiId;

        $dataAnswerCustomer = Http::get($endPointApi)->json()['data'];
        dd($dataAnswerCustomer);
        return view('admin.detail', compact('dataDetail'));
    }
}
