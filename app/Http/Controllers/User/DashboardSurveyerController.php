<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DetailPenyimpanan;
use App\Models\Customer;
use App\Models\Penyimpanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardSurveyerController extends Controller
{
    public function index(Request $request)
    {
        $selectedTokoId = request()->cookie('selectedTokoId');
        $kategoriToko = request()->cookie('kategoriToko');
        if (!is_null($selectedTokoId)) {
            alert()->warning('Peringatan', 'Anda belum menyelesaikan toko ini, jika ingin ganti toko klik pilih toko terlebih dahulu');

            $selectedTokoId = request()->cookie('selectedTokoId');
            $namaToko = Customer::getNamaToko($selectedTokoId);
            $idPenyimpanan = DetailPenyimpanan::getIdPenyimpanan($request);
            $k_pelanggan = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'k_kepuasan');
            $k_analisis = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'k_analisis');
            $k_kekuatan_kelemahan = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'k_kekuatan_kelemahan');
            $form_lahan = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'form_lahan');
            $form_pesaing = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'form_pesaing');
            $skala_pasar = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'skala_pasar');

            return view('surveyor.menu', compact('k_pelanggan', 'k_analisis', 'k_kekuatan_kelemahan', 'form_lahan', 'form_pesaing', 'skala_pasar', 'namaToko', 'kategoriToko'));
        }

        $dataCustommer = User::getCustommer();

        $dataJumlah = $this->dataForDashboard();

        return view('surveyor.dashboard', compact('dataCustommer', 'dataJumlah'));
    }

    public function menu(Request $request)
    {
        $selectedTokoId = request()->cookie('selectedTokoId');
        $kategoriToko = request()->cookie('kategoriToko');
        $namaToko = Customer::getNamaToko($selectedTokoId);
        $idPenyimpanan = DetailPenyimpanan::getIdPenyimpanan($request);
        $k_pelanggan = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'k_kepuasan');
        $k_analisis = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'k_analisis');
        $k_kekuatan_kelemahan = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'k_kekuatan_kelemahan');
        $form_lahan = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'form_lahan');
        $form_pesaing = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'form_pesaing');
        $skala_pasar = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'skala_pasar');
        // dd($k_analisis, $k_kekuatan_kelemahan, $form_lahan, $form_pesaing, $skala_pasar);

        return view('surveyor.menu', compact('k_pelanggan', 'k_analisis', 'k_kekuatan_kelemahan', 'form_lahan', 'form_pesaing', 'skala_pasar', 'namaToko', 'kategoriToko'));
    }

    public function setStore(Request $request)
    {
        $selectedTokoId = request()->cookie('selectedTokoId');
        if (!is_null($selectedTokoId)) {
            alert()->error('Gagal', 'Anda masih berada di toko ' . Customer::getNamaToko($selectedTokoId) . ', harap klik pilih toko terlebih dahulu, jika ingin mengganti toko');
            return redirect()->route('menu.index');
        }
        $store = $request->input('store');
        $kategori = Customer::where('id', $store)->value('jenis');
        return redirect()->route('menu.index')->withCookies([
            cookie('selectedTokoId', $store, 1440),
            cookie('kategoriToko', $kategori, 1440)
        ]);
    }

    // tampilkan semua status toko (belum di isi, belum selesai, selesai)
    public function listTargetToko()
    {
        // Mendapatkan tanggal awal bulan ini
        $startDate =  Carbon::now()->startOfMonth()->format('Y-m-d') . ' 00:00:00';
        // Mendapatkan tanggal akhir bulan ini
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d') . ' 23:59:59';

        $dataPerusahaan = Customer::with('kota', 'kota.provinsi', 'kota.wilayah_survey', 'kota.wilayah_survey.surveyor')
            ->whereHas('kota.wilayah_survey', function ($query) use ($startDate, $endDate) {
                $query->where('surveyor_id', Auth::user()->id);
            })->get();

        foreach ($dataPerusahaan as $key => $value) {
            $penyimpanan = Penyimpanan::with('surveyor')->whereBetween('created_at', [$startDate, $endDate])->where('surveyor_id', Auth::user()->id)->where('customer_id', $value->id)->first();
            $detailPenyimpanan = DetailPenyimpanan::where('penyimpanan_id', $penyimpanan ? $penyimpanan->id : 'error')->first();
            if ($detailPenyimpanan) {
                if ($penyimpanan->status != 2) {
                    $dataPerusahaan[$key]->status = 1;
                    $dataPerusahaan[$key]->surveyor = $penyimpanan->surveyor->name;
                } else {
                    $dataPerusahaan[$key]->status = 2;
                    $dataPerusahaan[$key]->surveyor = $penyimpanan->surveyor->name;
                }
            }else{
                $dataPerusahaan[$key]->status = 3;
                $dataPerusahaan[$key]->surveyor = '-';
            }
        }
        return view('surveyor.listTargetToko', compact('dataPerusahaan'));
    }

    // tampilkan toko yang belum selesai di isi
    public function listHasilSurvey()
    {
        // Mendapatkan tanggal awal bulan ini
        $startDate =  Carbon::now()->startOfMonth()->format('Y-m-d') . ' 00:00:00';
        // Mendapatkan tanggal akhir bulan ini
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d') . ' 23:59:59';

        $dataPerusahaan = Customer::with('kota', 'kota.provinsi', 'kota.wilayah_survey', 'kota.wilayah_survey.surveyor')
            ->whereHas('kota.wilayah_survey', function ($query) use ($startDate, $endDate) {
                $query->where('surveyor_id', Auth::user()->id);
            })->get();

        foreach ($dataPerusahaan as $key => $value) {
            $penyimpanan = Penyimpanan::with('surveyor')->whereBetween('created_at', [$startDate, $endDate])->where('surveyor_id', Auth::user()->id)->where('customer_id', $value->id)->first();
            $detailPenyimpanan = DetailPenyimpanan::where('penyimpanan_id', $penyimpanan ? $penyimpanan->id : 'error')->first();
            if ($detailPenyimpanan) {
                if ($penyimpanan->status != 2) {
                    $dataPerusahaan[$key]->status = 1;
                    $dataPerusahaan[$key]->surveyor = $penyimpanan->surveyor->name;
                } else {
                    $dataPerusahaan[$key]->status = 2;
                    $dataPerusahaan[$key]->surveyor = $penyimpanan->surveyor->name;
                }
            }else{
                $dataPerusahaan[$key]->status = 3;
                $dataPerusahaan[$key]->surveyor = '-';
            }
        }
        return view('surveyor.listHasilSurvey', compact('dataPerusahaan'));
    }

    public function profile()
    {
        return view('surveyor.profile');
    }

    function dataForDashboard(){
        // Mendapatkan tanggal awal bulan ini
        $startDate =  Carbon::now()->startOfMonth()->format('Y-m-d') . ' 00:00:00';
        // Mendapatkan tanggal akhir bulan ini
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d') . ' 23:59:59';

        $dataJumlah = [
            'targetTokoSelesai' => Customer::with('kota', 'kota.wilayah_survey', 'kota.wilayah_survey.surveyor', 'kota.provinsi', 'penyimpanan', 'penyimpanan.detail_penyimpanan')
                ->whereHas('penyimpanan', function ($query) use ($startDate, $endDate) {
                    $query->where('status', 1)->whereBetween('created_at', [$startDate, $endDate]);
                })->whereHas('kota.wilayah_survey', function ($query) use ($startDate, $endDate) {
                    $query->where('surveyor_id', Auth::user()->id);
                })->get()->count(),

            'targetToko' => Customer::with('kota', 'kota.wilayah_survey', 'kota.wilayah_survey.surveyor')
            ->whereHas('kota.wilayah_survey', function ($query) use ($startDate, $endDate) {
                $query->where('surveyor_id', Auth::user()->id);
            })->get()->count(),

            'targetTokoBlmSelesai' => Customer::with('kota', 'kota.wilayah_survey', 'kota.wilayah_survey.surveyor', 'kota.provinsi', 'penyimpanan', 'penyimpanan.detail_penyimpanan')
            ->whereHas('penyimpanan', function ($query) use ($startDate, $endDate) {
                $query->where('status', 2)->whereBetween('created_at', [$startDate, $endDate]);
            })->whereHas('kota.wilayah_survey', function ($query) use ($startDate, $endDate) {
                $query->where('surveyor_id', Auth::user()->id);
            })->has('penyimpanan.detail_penyimpanan')->get()->count(),
        ];

        return $dataJumlah;
    }
}
