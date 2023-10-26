<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\DetailPenyimpanan;
use App\Models\Penyimpanan;
use Illuminate\Http\Request;

class PenyimpananController extends Controller
{
    public function index()
    {
        $dataPenyimpananRaw = Penyimpanan::join('users', 'penyimpanan.surveyor_id', '=', 'users.id')
            ->join('customer', 'penyimpanan.customer_id', '=', 'customer.id')
            ->select('penyimpanan.id', 'penyimpanan.created_at', 'penyimpanan.status', 'users.name AS surveyor', 'customer.nama AS customer')
            ->orderBy('created_at', 'desc')
            ->get();

        $dataPenyimpanan = [];
        foreach ($dataPenyimpananRaw as $value) {
            $detailPenyimpanan = DetailPenyimpanan::where('penyimpanan_id', '=', $value->id)->first();
            if ($detailPenyimpanan) {
                array_push($dataPenyimpanan, $value);
            }
        }
        // dd($dataPenyimpananRaw);
        return view('admin.penyimpanan', compact('dataPenyimpanan'));
    }

    public function kepuasanPelanggan()
    {
        $dataPenyimpananRaw = Penyimpanan::join('users', 'penyimpanan.surveyor_id', '=', 'users.id')
            ->join('customer', 'penyimpanan.customer_id', '=', 'customer.id')
            ->select('penyimpanan.id', 'penyimpanan.created_at', 'penyimpanan.status', 'users.name AS surveyor', 'customer.nama AS customer')
            ->orderBy('created_at', 'desc')
            ->get();

        $dataPenyimpanan = [];
        foreach ($dataPenyimpananRaw as $value) {
            $detailPenyimpanan = DetailPenyimpanan::where('penyimpanan_id', '=', $value->id)->first();
            if ($detailPenyimpanan) {
                array_push($dataPenyimpanan, $value);
            }
        }
        return view('admin.penyimpanan.kepuasanPelanggan', compact('dataPenyimpanan'));
    }

    public function analisisPesaing()
    {
        $dataPenyimpananRaw = Penyimpanan::join('users', 'penyimpanan.surveyor_id', '=', 'users.id')
            ->join('customer', 'penyimpanan.customer_id', '=', 'customer.id')
            ->select('penyimpanan.id', 'penyimpanan.created_at', 'penyimpanan.status', 'users.name AS surveyor', 'customer.nama AS customer')
            ->orderBy('created_at', 'desc')
            ->get();

        $dataPenyimpanan = [];
        foreach ($dataPenyimpananRaw as $value) {
            $detailPenyimpanan = DetailPenyimpanan::where('penyimpanan_id', '=', $value->id)->first();
            if ($detailPenyimpanan) {
                array_push($dataPenyimpanan, $value);
            }
        }
        return view('admin.penyimpanan.analisisPesaing', compact('dataPenyimpanan'));
    }

    public function kekuatanKelemahan()
    {
        $dataPenyimpananRaw = Penyimpanan::join('users', 'penyimpanan.surveyor_id', '=', 'users.id')
            ->join('customer', 'penyimpanan.customer_id', '=', 'customer.id')
            ->select('penyimpanan.id', 'penyimpanan.created_at', 'penyimpanan.status', 'users.name AS surveyor', 'customer.nama AS customer')
            ->orderBy('created_at', 'desc')
            ->get();

        $dataPenyimpanan = [];
        foreach ($dataPenyimpananRaw as $value) {
            $detailPenyimpanan = DetailPenyimpanan::where('penyimpanan_id', '=', $value->id)->first();
            if ($detailPenyimpanan) {
                array_push($dataPenyimpanan, $value);
            }
        }
        return view('admin.penyimpanan.kekuatanKelemahan', compact('dataPenyimpanan'));
    }

    public function skalaPasarProduk()
    {
        $dataPenyimpananRaw = Penyimpanan::join('users', 'penyimpanan.surveyor_id', '=', 'users.id')
            ->join('customer', 'penyimpanan.customer_id', '=', 'customer.id')
            ->select('penyimpanan.id', 'penyimpanan.created_at', 'penyimpanan.status', 'users.name AS surveyor', 'customer.nama AS customer')
            ->orderBy('created_at', 'desc')
            ->get();

        $dataPenyimpanan = [];
        foreach ($dataPenyimpananRaw as $value) {
            $detailPenyimpanan = DetailPenyimpanan::where('penyimpanan_id', '=', $value->id)->first();
            if ($detailPenyimpanan) {
                array_push($dataPenyimpanan, $value);
            }
        }
        return view('admin.penyimpanan.skalaPasar', compact('dataPenyimpanan'));
    }

    public function potensiLahan()
    {
        $dataPenyimpananRaw = Penyimpanan::join('users', 'penyimpanan.surveyor_id', '=', 'users.id')
            ->join('customer', 'penyimpanan.customer_id', '=', 'customer.id')
            ->select('penyimpanan.id', 'penyimpanan.created_at', 'penyimpanan.status', 'users.name AS surveyor', 'customer.nama AS customer')
            ->orderBy('created_at', 'desc')
            ->get();

        $dataPenyimpanan = [];
        foreach ($dataPenyimpananRaw as $value) {
            $detailPenyimpanan = DetailPenyimpanan::where('penyimpanan_id', '=', $value->id)->first();
            if ($detailPenyimpanan) {
                array_push($dataPenyimpanan, $value);
            }
        }
        return view('admin.penyimpanan.potensiLahan', compact('dataPenyimpanan'));
    }

    public function surveyPesaing()
    {
        $dataPenyimpananRaw = Penyimpanan::join('users', 'penyimpanan.surveyor_id', '=', 'users.id')
            ->join('customer', 'penyimpanan.customer_id', '=', 'customer.id')
            ->select('penyimpanan.id', 'penyimpanan.created_at', 'penyimpanan.status', 'users.name AS surveyor', 'customer.nama AS customer')
            ->orderBy('created_at', 'desc')
            ->get();

        $dataPenyimpanan = [];
        foreach ($dataPenyimpananRaw as $value) {
            $detailPenyimpanan = DetailPenyimpanan::where('penyimpanan_id', '=', $value->id)->first();
            if ($detailPenyimpanan) {
                array_push($dataPenyimpanan, $value);
            }
        }
        return view('admin.penyimpanan.surveyPesaing', compact('dataPenyimpanan'));
    }
}
