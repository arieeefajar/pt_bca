<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DetailPenyimpanan;
use App\Models\Penyimpanan;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class FormPesaingController extends Controller
{
    public function index(Request $request)
    {
        $dataProduk = Product::getProductCustomer($request);
        return view('surveyor.pesaing', compact('dataProduk'));
    }

    public function store(Request $request)
    {

        $customMessages = [
            'required' => 'Kolom :attribute harus diisi.',
        ];

        $validator = Validator::make($request->all(), [
            'produk_kita' => 'required',
            'deskripsi_produk' => 'required',
            'produk_pesaing' => 'required',
            'deskripsi_produk_pesaing' => 'required',
            'keunggulan_pesaing' => 'required',
            'pemasaran_pesaing' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


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

        if (Penyimpanan::hasDonePenyimpanan($request)) {
            $penyimpanan = Penyimpanan::findOrFail($idPenyimpanan);
            $penyimpanan->status = '1';
            $penyimpanan->save();
        }

        alert()->success('Berhasil', 'Berhasil menambahkan form kuisioner');
        return redirect()->route('menu.index');
    }
}
