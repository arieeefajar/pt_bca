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
        $idPenyimpanan = DetailPenyimpanan::getIdPenyimpanan($request);
        $form_pesaing = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'form_pesaing');

        if ($form_pesaing) {
            toast('Form survey sudah diisikan', 'error')->position('top')->autoClose(3000);
            return back()->withInput();
        } else {
            $dataProduk = Product::all();
            return view('surveyor.pesaing', compact('dataProduk'));
        }
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
            // 'latitude' => 'required',
            // 'longitude' => 'required',
        ], $customMessages);

        if ($validator->fails()) {
            alert()->error('Gagal', $validator->messages()->all()[0]);
            return redirect()->back()->withInput();
        }

        // todo $produk_pesaing = explode(", ", $request->produk_pesaing);

        $idPenyimpanan = DetailPenyimpanan::getIdPenyimpanan($request);
        $cekDetailPenyimpanan = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'form_pesaing');

        // cek apakah sudah ada detail penyimpanan dengan jenis pertanyaan yang sama
        if ($cekDetailPenyimpanan) {
            alert()->warning('Gagal', 'Data form sudah ada');
            return redirect()->route('menu.index');
        }

        $endPointApi = env('PYTHON_END_POINT').'retail';

        // data send
        $produk_kita = $request->produk_kita;
        $produk_pesaing = explode(", ", $request->produk_pesaing);

        $deskripsi_produk = $request->deskripsi_produk;
        $deskripsi_produk_pesaing = $request->deskripsi_produk_pesaing;
        $keunggulan_pesaing = $request->keunggulan_pesaing;
        $pemasaran_pesaing = $request->pemasaran_pesaing;
        // $latitude = $request->latitude;
        // $longitude = $request->longitude;

        $latitude = 123456;
        $longitude = -2143567;

        $response = Http::post($endPointApi, [
            "surveyor" => Auth::user()->id,
            "location" => [
                "latitude" => $latitude,
                "longtitude" => $longitude
            ],
            "our_product" => $produk_kita,
            "competitor_product" => $produk_pesaing,
            "answer" => [
                $deskripsi_produk,
                $deskripsi_produk_pesaing,
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
