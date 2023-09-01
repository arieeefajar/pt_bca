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
        return view('admin.detail', compact('dataDetail'));
    }

    public function jawaban_kepuasanPelanggan($apiId)
    {
        $endPointApi = 'http://103.175.216.72/api/simi/customer/' . $apiId;
        $dataAnswer = Http::get($endPointApi)->json()['data'];
        return view('admin.detailjawaban.k_kepuasan', compact('dataAnswer'));
    }

    public function jawaban_kekuatanKelemahan($apiId)
    {
        $endPointApi = 'http://103.175.216.72/api/simi/competitor-identifier/' . $apiId;
        $dataAnswer = Http::get($endPointApi)->json()['data'];
        return view('admin.detailjawaban.k_kekuatanKelemahan', compact('dataAnswer'));
    }

    public function jawaban_analisisPesaing($apiId)
    {
        $endPointApi = 'http://103.175.216.72/api/simi/competitor-analys/' . $apiId;
        $dataAnswer = Http::get($endPointApi)->json()['data'];
        return view('admin.detailjawaban.k_analisisPesaing', compact('dataAnswer'));
    }

    public function jawaban_potensiLahan($apiId)
    {
        $endPointApi = 'http://103.175.216.72/api/simi/potentional-area/' . $apiId;
        $dataAnswer = Http::get($endPointApi)->json()['data'];
        return view('admin.detailjawaban.f_potensiLahan', compact('dataAnswer'));
    }
}
