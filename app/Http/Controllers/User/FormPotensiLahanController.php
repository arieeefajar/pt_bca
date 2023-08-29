<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DetailPenyimpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class FormPotensiLahanController extends Controller
{
    public function index()
    {
        return view('surveyor.potensiLahan');
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $customMessages = [
            'required' => ':attribute harus diisi.',
        ];

        $validator = Validator::make($request->all(), [
            'keunggulan_umum' => 'required',
            'keunggulan_produk' => 'required',
            'keunggulan_kompetitor' => 'required',
            'iklim' => 'required',
            'evet' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $idPenyimpanan = DetailPenyimpanan::getIdPenyimpanan($request);
        $cekDetailPenyimpanan = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'form_lahan');

        // cek apakah sudah ada detail penyimpanan dengan jenis pertanyaan yang sama
        if ($cekDetailPenyimpanan) {
            return redirect()->route('menu.index')->with('error', 'Data Form sudah ada');
        }

        $endPointApi = 'http://103.175.216.72/api/simi/potentional-area';

        $keunggulan_umum = $request->keunggulan_umum;
        $keunggulan_produk = $request->keunggulan_produk;
        $keunggulan_kompetitor = $request->keunggulan_kompetitor;
        $iklim = $request->iklim;
        $event = $request->event;
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $response = Http::post($endPointApi, [
            "surveyor" => Auth::user()->id,
            "location" => [
                "latitude" => $latitude,
                "longtitude" => $longitude
            ],
            "answer" => [
                $keunggulan_umum,
                $keunggulan_produk,
                $keunggulan_kompetitor,
                $iklim,
                $event
            ]
        ]);

        $responJson = $response->json();

        DetailPenyimpanan::create([
            'penyimpanan_id' => $idPenyimpanan,
            'pertanyaan' => 'form_lahan',
            'api_id' => $responJson['id']
        ]);

        return redirect()->route('menu.index')->with('success', 'Data kuisioner berhasil di simpan');
    }
}
