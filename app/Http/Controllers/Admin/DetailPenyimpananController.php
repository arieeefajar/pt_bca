<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\DetailPenyimpanan;
use App\Models\Product;
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

    public function jawaban_kepuasanPelanggan(Request $request, $idDetail = null, $apiId = null)
    {
        // by toko
        $endPointApi = env('PYTHON_END_POINT') . 'customer/' . $apiId;

        // by kategory
        if (count($request->segments()) === 2) {
            $endPointApi = env('PYTHON_END_POINT') . 'customer/' . $request->segment(2);
            $idDetail = 'kategori';
        }

        try {
            $dataAnswer = [Http::get($endPointApi)->json()['data']];
            return view('admin.detailJawaban.k_kepuasan', compact('dataAnswer', 'idDetail'));
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi kesalahan server');
            return redirect()->back()->withInput();
        }
    }

    public function jawaban_kekuatanKelemahan(Request $request, $idDetail = null, $apiId = null)
    {
        // by toko
        $endPointApi = env('PYTHON_END_POINT') . 'competitor-identifier/' . $apiId;

        // by kategory
        if (count($request->segments()) === 2) {
            $endPointApi = env('PYTHON_END_POINT') . 'competitor-identifier/' . $request->segment(2);
            $idDetail = 'kategori';
        }
        try {
            $dataAnswer = [Http::get($endPointApi)->json()['data']];
            return view('admin.detailJawaban.k_kekuatanKelemahan', compact('dataAnswer', 'idDetail'));
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi kesalahan server');
            return redirect()->back()->withInput();
        }
    }

    public function jawaban_analisisPesaing(Request $request, $idDetail = null, $apiId = null)
    {
        // by toko
        $endPointApi = env('PYTHON_END_POINT') . 'competitor-analys/' . $apiId;

        // by kategory
        if (count($request->segments()) === 2) {
            $endPointApi = env('PYTHON_END_POINT') . 'competitor-analys/' . $request->segment(2);
            $idDetail = 'kategori';
        }
        try {
            $dataAnswer = [Http::get($endPointApi)->json()['data']];
            return view('admin.detailJawaban.k_analisisPesaing', compact('dataAnswer', 'idDetail'));
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi kesalahan server');
            return redirect()->back()->withInput();
        }
    }

    public function jawaban_skala_pasar(Request $request, $idDetail = null, $apiId = null)
    {
        // by toko
        $endPointApi = env('PYTHON_END_POINT') . 'competitor-questionnaire/' . $apiId;

        // by kategory
        if (count($request->segments()) === 2) {
            $endPointApi = env('PYTHON_END_POINT') . 'competitor-questionnaire/' . $request->segment(2);
            $idDetail = 'kategori';
        }
        try {
            $dataAnswer = [Http::get($endPointApi)->json()['data']];
            return view('admin.detailJawaban.k_skalaPasarProduk', compact('dataAnswer', 'idDetail'));
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi kesalahan server');
            return redirect()->back()->withInput();
        }
    }

    public function jawaban_potensiLahan(Request $request, $idDetail = null, $apiId = null)
    {
        // by toko
        $endPointApi = env('PYTHON_END_POINT') . 'potentional-area/' . $apiId;

        // by kategory
        if (count($request->segments()) === 2) {
            $endPointApi = env('PYTHON_END_POINT') . 'potentional-area/' . $request->segment(2);
            $idDetail = 'kategori';
        }
        try {
            $dataAnswer = [Http::get($endPointApi)->json()['data']];
            return view('admin.detailJawaban.f_potensiLahan', compact('dataAnswer', 'idDetail'));
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi kesalahan server');
            return redirect()->back()->withInput();
        }
    }

    public function jawaban_form_analisisPesaing(Request $request, $idDetail = null, $apiId = null)
    {
        // by toko
        $endPointApi = env('PYTHON_END_POINT') . 'retail/' . $apiId;

        // by kategory
        if (count($request->segments()) === 2) {
            $endPointApi = env('PYTHON_END_POINT') . 'retail/' . $request->segment(2);
            $idDetail = 'kategori';
        }
        try {
            $dataAnswer = [Http::get($endPointApi)->json()['data']];
            $ourProduct = Product::where('id', $dataAnswer[0]['our_product'])->get()[0]->nama_produk;
            return view('admin.detailJawaban.f_surveyPesaing', compact('dataAnswer', 'idDetail', 'ourProduct'));
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi kesalahan server');
            return redirect()->back()->withInput();
        }
    }
}
