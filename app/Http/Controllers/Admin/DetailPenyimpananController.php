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
        $idDetail = $id;
        return view('admin.detail', compact('dataDetail', 'idDetail'));
    }

    public function jawaban_kepuasanPelanggan($idDetail, $apiId)
    {
        $endPointApi = 'http://103.175.216.72/api/simi/customer/' . $apiId;
        $dataAnswer = [Http::get($endPointApi)->json()['data']];
        return view('admin.detailJawaban.k_kepuasan', compact('dataAnswer', 'idDetail'));
    }

    public function jawaban_kekuatanKelemahan($idDetail, $apiId)
    {
        $endPointApi = 'http://103.175.216.72/api/simi/competitor-identifier/' . $apiId;
        $dataAnswer = [Http::get($endPointApi)->json()['data']];
        return view('admin.detailJawaban.k_kekuatanKelemahan', compact('dataAnswer', 'idDetail'));
    }

    public function jawaban_analisisPesaing($idDetail, $apiId)
    {
        $endPointApi = 'http://103.175.216.72/api/simi/competitor-analys/' . $apiId;
        $dataAnswer = [Http::get($endPointApi)->json()['data']];
        return view('admin.detailJawaban.k_analisisPesaing', compact('dataAnswer', 'idDetail'));
    }

    public function jawaban_potensiLahan($idDetail, $apiId)
    {
        $endPointApi = 'http://103.175.216.72/api/simi/potentional-area/' . $apiId;
        $dataAnswer = [Http::get($endPointApi)->json()['data']];
        return view('admin.detailJawaban.f_potensiLahan', compact('dataAnswer', 'idDetail'));
    }

    public function jawaban_form_analisisPesaing($idDetail, $apiId)
    {
        $endPointApi = 'http://103.175.216.72/api/simi/retail/' . $apiId;
        $dataAnswer = [Http::get($endPointApi)->json()['data']];
        return view('admin.detailJawaban.f_surveyPesaing', compact('dataAnswer', 'idDetail'));
    }
}
