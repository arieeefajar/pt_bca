<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DetailPenyimpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class FormPotensiLahanController extends Controller
{
    public function index()
    {
        return view('surveyor.potensiLahan');
    }

    public function store(Request $request)
    {

        // dd($request->all());

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

        $idPenyimpanan = DetailPenyimpanan::getIdPenyimpanan();
        DetailPenyimpanan::create([
            'penyimpanan_id' => $idPenyimpanan,
            'pertanyaan' => 'form_lahan',
            'api_id' => $responJson['id']
        ]);

        return redirect()->route('menu.index')->with('success', 'Data kuisioner berhasil di simpan');
    }
}
