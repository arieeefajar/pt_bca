<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Penyimpanan;
use Illuminate\Http\Request;

class PenyimpananController extends Controller
{
    public function index()
    {
        $dataPenyimpanan = Penyimpanan::with('customer', 'surveyor')
            ->where('status', '1')
            ->get();
        return view('admin.penyimpanan', compact('dataPenyimpanan'));
    }

    public function jawaban_kepuasanPelanggan()
    {
        return view('admin.detailjawaban.k_kepuasan');
    }

    public function jawaban_kekuatanKelemahan()
    {
        return view('admin.detailjawaban.k_kekuatanKelemahan');
    }

    public function jawaban_analisisPesaing()
    {
        return view('admin.detailjawaban.k_analisisPesaing');
    }

    public function jawaban_potensiLahan()
    {
        return view('admin.detailjawaban.f_potensiLahan');
    }

    public function jawaban_surveyPesaing()
    {
        return view('admin.detailjawaban.f_surveyPesaing');
    }
}
