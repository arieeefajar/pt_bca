<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DetailPenyimpanan;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardSurveyerController extends Controller
{
    public function index(Request $request)
    {
        $dataCustommer = User::getCustommer();
        $dataJumlah = [
            'surveyor' => User::where('role', 'user')->get()->count(),
            'executive' => User::where('role', 'executive')->get()->count(),
            'admin' => User::where('role', 'admin')->get()->count(),
            'targetToko' => Customer::all()->count(),
            'surveyToko' => Customer::join('penyimpanan', 'customer.id', '=', 'penyimpanan.customer_id')
                ->where('penyimpanan.status', 1)
                ->select('customer.nama')
                ->get()->count(),
        ];

        return view('surveyor.dashboard', compact('dataCustommer', 'dataJumlah'));
    }

    public function menu(Request $request)
    {
        $idPenyimpanan = DetailPenyimpanan::getIdPenyimpanan($request);
        $k_pelanggan = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'k_kepuasan');
        $k_analisis = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'k_analisis');
        $k_kekuatan_kelemahan = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'k_kekuatan_kelemahan');
        $form_lahan = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'form_lahan');
        $form_pesaing = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'form_pesaing');

        return view('surveyor.menu', compact('k_pelanggan', 'k_analisis', 'k_kekuatan_kelemahan', 'form_lahan', 'form_pesaing'));
    }

    public function setStore(Request $request)
    {
        $store = $request->input('store');
        return redirect()->route('menu.index')->withCookie(cookie('selectedTokoId', $store, 1440));
    }
}
