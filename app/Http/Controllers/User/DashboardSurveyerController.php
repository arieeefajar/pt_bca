<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DetailPenyimpanan;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardSurveyerController extends Controller
{
    public function index(Request $request)
    {
        $selectedTokoId = request()->cookie('selectedTokoId');
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

            return view('surveyor.menu', compact('k_pelanggan', 'k_analisis', 'k_kekuatan_kelemahan', 'form_lahan', 'form_pesaing', 'skala_pasar', 'namaToko'));
        }
        $dataCustommer = User::getCustommer();

        // Mendapatkan tanggal awal bulan ini
        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d').' 00:00:00';

        // Mendapatkan tanggal akhir bulan ini
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d').' 23:59:59';
        $dataJumlah = [
            'surveyor' => User::where('role', 'user')->get()->count(),
            'executive' => User::where('role', 'executive')->get()->count(),
            'admin' => User::where('role', 'admin')->get()->count(),
            'targetToko' => Customer::all()->count(),
            'surveyToko' => Customer::join('penyimpanan', 'customer.id', '=', 'penyimpanan.customer_id')
                ->where('penyimpanan.status', 1)
                ->where('penyimpanan.surveyor_id', Auth::user()->id)
                ->whereBetween('penyimpanan.created_at', [$startDate, $endDate])
                ->select('customer.nama')
                ->get()->count(),
        ];

        return view('surveyor.dashboard', compact('dataCustommer', 'dataJumlah'));
    }

    public function menu(Request $request)
    {
        $selectedTokoId = request()->cookie('selectedTokoId');
        $namaToko = Customer::getNamaToko($selectedTokoId);
        $idPenyimpanan = DetailPenyimpanan::getIdPenyimpanan($request);
        $k_pelanggan = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'k_kepuasan');
        $k_analisis = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'k_analisis');
        $k_kekuatan_kelemahan = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'k_kekuatan_kelemahan');
        $form_lahan = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'form_lahan');
        $form_pesaing = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'form_pesaing');
        $skala_pasar = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'skala_pasar');

        return view('surveyor.menu', compact('k_pelanggan', 'k_analisis', 'k_kekuatan_kelemahan', 'form_lahan', 'form_pesaing', 'skala_pasar', 'namaToko'));
    }

    public function setStore(Request $request)
    {
        $selectedTokoId = request()->cookie('selectedTokoId');
        if (!is_null($selectedTokoId)) {
            alert()->error('Gagal', 'Anda masih berada di toko ' . Customer::getNamaToko($selectedTokoId) . ', harap klik pilih toko terlebih dahulu, jika ingin mengganti toko');
            return redirect()->route('menu.index');
        }
        $store = $request->input('store');
        return redirect()->route('menu.index')->withCookie(cookie('selectedTokoId', $store, 1440));
    }

    public function profile()
    {
        return view('surveyor.profile');
    }
}
