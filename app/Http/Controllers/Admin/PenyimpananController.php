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
            ->join('kota', 'customer.kota_id', '=', 'kota.id')
            ->join('provinsi', 'kota.provinsi_id', '=', 'provinsi.id')
            ->select('penyimpanan.id', 'penyimpanan.created_at', 'penyimpanan.status', 'users.name AS surveyor', 'customer.nama AS customer', 'customer.jenis', 'penyimpanan.updated_at', 'kota.nama as kota', 'provinsi.nama as provinsi')
            ->orderBy('updated_at', 'desc')
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
        $dataPenyimpanan = DetailPenyimpanan::with('penyimpanan', 'penyimpanan.customer', 'penyimpanan.customer.kota', 'penyimpanan.customer.kota.provinsi')
                    ->where('pertanyaan', 'k_kepuasan')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('admin.penyimpanan.kepuasanPelanggan', compact('dataPenyimpanan'));
    }

    public function analisisPesaing()
    {
        $dataPenyimpanan = DetailPenyimpanan::with('penyimpanan', 'penyimpanan.customer', 'penyimpanan.customer.kota', 'penyimpanan.customer.kota.provinsi')
                    ->where('pertanyaan', 'k_analisis')
                    ->orderBy('created_at', 'desc')
                    ->get();
                    
        return view('admin.penyimpanan.analisisPesaing', compact('dataPenyimpanan'));
    }

    public function kekuatanKelemahan()
    {
        $dataPenyimpanan = DetailPenyimpanan::with('penyimpanan', 'penyimpanan.customer', 'penyimpanan.customer.kota', 'penyimpanan.customer.kota.provinsi')
                    ->where('pertanyaan', 'k_kekuatan_kelemahan')
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('admin.penyimpanan.kekuatanKelemahan', compact('dataPenyimpanan'));
    }

    public function skalaPasarProduk()
    {
        $dataPenyimpanan = DetailPenyimpanan::with('penyimpanan', 'penyimpanan.customer', 'penyimpanan.customer.kota', 'penyimpanan.customer.kota.provinsi')
                    ->where('pertanyaan', 'skala_pasar')
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('admin.penyimpanan.skalaPasar', compact('dataPenyimpanan'));
    }

    public function potensiLahan()
    {
        $dataPenyimpanan = DetailPenyimpanan::with('penyimpanan', 'penyimpanan.customer', 'penyimpanan.customer.kota', 'penyimpanan.customer.kota.provinsi')
                    ->where('pertanyaan', 'form_lahan')
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('admin.penyimpanan.potensiLahan', compact('dataPenyimpanan'));
    }

    public function surveyPesaing()
    {
        $dataPenyimpanan = DetailPenyimpanan::with('penyimpanan', 'penyimpanan.customer', 'penyimpanan.customer.kota', 'penyimpanan.customer.kota.provinsi')
                    ->where('pertanyaan', 'form_pesaing')
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('admin.penyimpanan.surveyPesaing', compact('dataPenyimpanan'));
    }
}
