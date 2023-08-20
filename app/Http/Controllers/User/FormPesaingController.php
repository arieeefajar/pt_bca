<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DetailPenyimpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class FormPesaingController extends Controller
{
    public function index()
    {
        return view('surveyor.pesaing');
    }

    public function store(Request $request)
    {

        $idPenyimpanan = DetailPenyimpanan::getIdPenyimpanan($request);
        $cekDetailPenyimpanan = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'form_pesaing');

        // cek apakah sudah ada detail penyimpanan dengan jenis pertanyaan yang sama
        if ($cekDetailPenyimpanan) {
            return redirect()->route('menu.index')->with('error', 'Data Form sudah ada');
        }

        $endPointApi = 'http://103.175.216.72/api/simi/retail';

        // data send
        $produk_kita = $request->produk_kita . ", " . $request->deskripsi_produk;
        $produk_pesaing = $request->produk_pesaing . ", " . $request->deskripsi_produk_pesaing;

        $keunggulan_pesaing = $request->keunggulan_pesaing;
        $pemasaran_pesaing = $request->pemasaran_pesaing;
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $response = Http::post($endPointApi, [
            "surveyor" => Auth::user()->id,
            "location" => [
                "latitude" => $latitude,
                "longtitude" => $longitude
            ],
            "answer" => [
                $produk_kita,
                $produk_pesaing,
                $keunggulan_pesaing,
                $pemasaran_pesaing
            ]
        ]);

        $responJson = $response->json();

        DetailPenyimpanan::create([
            'penyimpanan_id' => $idPenyimpanan,
            'pertanyaan' => 'form_pesaing',
            'api_id' => $responJson['id']
        ]);

        return redirect()->route('menu.index')->with('success', 'Data kuisioner berhasil di simpan');

    }
}
