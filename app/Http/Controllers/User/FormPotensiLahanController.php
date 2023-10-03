<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DetailPenyimpanan;
use App\Models\Penyimpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class FormPotensiLahanController extends Controller
{
    public function index(Request $request)
    {
        $idPenyimpanan = DetailPenyimpanan::getIdPenyimpanan($request);
        $form_lahan = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'form_lahan');

        if ($form_lahan) {
            toast('Form survey sudah diisikan', 'error')->position('top')->autoClose(3000);
            return back()->withInput();
        } else {
            return view('surveyor.potensiLahan');
        }
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
            'event' => 'required',
            // 'latitude' => 'required',
            // 'longitude' => 'required',
        ], $customMessages);

        if ($validator->fails()) {
            alert()->error('Gagal', $validator->messages()->all()[0]);
            return redirect()->back()->withInput();
        }

        $idPenyimpanan = DetailPenyimpanan::getIdPenyimpanan($request);
        $cekDetailPenyimpanan = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'form_lahan');

        // cek apakah sudah ada detail penyimpanan dengan jenis pertanyaan yang sama
        if ($cekDetailPenyimpanan) {
            alert()->warning('Gagal', 'Data form sudah ada');
            return redirect()->route('menu.index');
        }

        $endPointApi = 'http://192.168.1.45:8000/potentional-area';

        $keunggulan_umum = $request->keunggulan_umum;
        $keunggulan_produk = $request->keunggulan_produk;
        $keunggulan_kompetitor = $request->keunggulan_kompetitor;
        $iklim = $request->iklim;
        $event = $request->event;
        // $latitude = $request->latitude;
        // $longitude = $request->longitude;

        $latitude = 1234;
        $longitude = -34567;

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

        if (Penyimpanan::hasDonePenyimpanan($request)) {
            $penyimpanan = Penyimpanan::findOrFail($idPenyimpanan);
            $penyimpanan->status = '1';
            $penyimpanan->save();
        }

        alert()->success('Berhasil', 'Berhasil menambahkan form kuisioner');
        return redirect()->route('menu.index');
    }
}
