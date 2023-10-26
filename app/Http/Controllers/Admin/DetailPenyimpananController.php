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
        $endPointApi = env('PYTHON_END_POINT').'customer/' . $apiId;
        try {
            $dataAnswer = [Http::get($endPointApi)->json()['data']];
            return view('admin.detailJawaban.k_kepuasan', compact('dataAnswer', 'idDetail'));
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi kesalahan server');
            return redirect()->back()->withInput();
        }
    }

    public function jawaban_kekuatanKelemahan($idDetail, $apiId)
    {
        $endPointApi = env('PYTHON_END_POINT').'competitor-identifier/' . $apiId;
        try {
            $dataAnswer = [Http::get($endPointApi)->json()['data']];
            return view('admin.detailJawaban.k_kekuatanKelemahan', compact('dataAnswer', 'idDetail'));
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi kesalahan server');
            return redirect()->back()->withInput();
        }
    }

    public function jawaban_analisisPesaing($idDetail, $apiId)
    {
        $endPointApi = env('PYTHON_END_POINT').'competitor-analys/' . $apiId;
        try {
            $dataAnswer = [Http::get($endPointApi)->json()['data']];
            return view('admin.detailJawaban.k_analisisPesaing', compact('dataAnswer', 'idDetail'));
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi kesalahan server');
            return redirect()->back()->withInput();
        }
    }

    public function jawaban_potensiLahan($idDetail, $apiId)
    {
        $endPointApi = env('PYTHON_END_POINT').'potentional-area/' . $apiId;
        try {
            $dataAnswer = [Http::get($endPointApi)->json()['data']];
            return view('admin.detailJawaban.f_potensiLahan', compact('dataAnswer', 'idDetail'));
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi kesalahan server');
            return redirect()->back()->withInput();
        }
    }

    public function jawaban_form_analisisPesaing($idDetail, $apiId)
    {
        $endPointApi = env('PYTHON_END_POINT').'retail/' . $apiId;
        try {
            $dataAnswer = [Http::get($endPointApi)->json()['data']];
            return view('admin.detailJawaban.f_surveyPesaing', compact('dataAnswer', 'idDetail'));
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi kesalahan server');
            return redirect()->back()->withInput();
        }
    }

    public function jawaban_skala_pasar($idDetail, $apiId)
    {
        $endPointApi = env('PYTHON_END_POINT').'competitor-questionnaire/' . $apiId;
        try {
            $dataAnswer = [Http::get($endPointApi)->json()['data']];
            return view('admin.detailJawaban.k_skalaPasarProduk', compact('dataAnswer', 'idDetail'));
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi kesalahan server');
            return redirect()->back()->withInput();
        }
    }
}
