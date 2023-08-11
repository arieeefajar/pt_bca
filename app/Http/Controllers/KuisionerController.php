<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KuisionerController extends Controller
{
    public function index()
    {
        return view('admin.kuisioner');
    }

    public function kepuasanPelanggan()
    {
        return view('surveyor.kepuasanPelanggan');
    }

    public function analisisKompetitor()
    {
        return view('surveyor.analisisKompetitor');
    }

    public function kekuatanKelemahanPesaing()
    {
        return view('surveyor.kekuatanKelemahanPesaing');
    }
}
