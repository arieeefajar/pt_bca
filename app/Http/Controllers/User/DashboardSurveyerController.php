<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DetailPenyimpanan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardSurveyerController extends Controller
{
    public function index(Request $request)
    {
        $dataCustommer = User::getCustommer();

        return view('surveyor.dashboard', compact('dataCustommer'));
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
