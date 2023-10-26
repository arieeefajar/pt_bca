<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\DetailPenyimpanan;
use App\Models\Penyimpanan;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class FormPotensiLahanController extends Controller
{
    public function index(Request $request, $api_id = null)
    {
        $idPenyimpanan = DetailPenyimpanan::getIdPenyimpanan($request);
        $form_lahan = DetailPenyimpanan::hasDetailPenyimpanan(
            $idPenyimpanan,
            'form_lahan'
        );
        $dataAnswer = null;

        // kika jawaban sudah ada dan ada api id
        if ($form_lahan && $api_id) {
            $endPointApi = env('PYTHON_END_POINT') . 'potentional-area/' . $api_id;
            try {
                $dataAnswer = (object) [Http::get($endPointApi)->json()['data']][0];
                return view('surveyor.potensiLahan', compact('dataAnswer'));
            } catch (\Throwable $th) {
                alert()->error('Gagal', 'Sesalahan server, gagal menampilkan jawaban');
                return redirect()->route('menu.index');
            }
        }
        // ketika jawaban sudah ada dan user memaksa masuk lewat url
        elseif ($form_lahan) {
            toast('Form survey sudah diisikan', 'error')
                ->position('top')
                ->autoClose(3000);
            return redirect()->route('menu.index');
        } else {
            return view('surveyor.potensiLahan', compact('dataAnswer'));
        }
    }

    public function store(Request $request)
    {
        $customMessages = [
            'required' => ':attribute harus diisi.',
        ];

        $validator = Validator::make(
            $request->all(),
            [
                'keunggulan_umum' => 'required',
                'keunggulan_produk' => 'required',
                'keunggulan_kompetitor' => 'required',
                'iklim' => 'required',
                'event' => 'required',
                // 'latitude' => 'required',
                // 'longitude' => 'required',
            ],
            $customMessages
        );

        if ($validator->fails()) {
            alert()->error('Gagal', $validator->messages()->all()[0]);
            return redirect()
                ->back()
                ->withInput();
        }

        $idPenyimpanan = DetailPenyimpanan::getIdPenyimpanan($request);
        $cekDetailPenyimpanan = DetailPenyimpanan::hasDetailPenyimpanan(
            $idPenyimpanan,
            'form_lahan'
        );

        // cek apakah sudah ada detail penyimpanan dengan jenis pertanyaan yang sama
        if ($cekDetailPenyimpanan) {
            alert()->warning('Gagal', 'Data form sudah ada');
            return redirect()->route('menu.index');
        }

        $endPointApi = env('PYTHON_END_POINT') . 'potentional-area';

        // latitude & longitude
        $koordinat = Customer::select('koordinat')
            ->where('id', $request->cookie('selectedTokoId'))
            ->first()->koordinat;
        $koordinat = explode(', ', $koordinat);

        $keunggulan_umum = $request->keunggulan_umum;
        $keunggulan_produk = $request->keunggulan_produk;
        $keunggulan_kompetitor = $request->keunggulan_kompetitor;
        $iklim = $request->iklim;
        $event = $request->event;
        // $latitude = floatval($request->latitude);
        // $longitude = floatval($request->longitude);
        $latitude = floatval($koordinat[0]);
        $longitude = floatval($koordinat[1]);

        try {
            $response = Http::post($endPointApi, [
                'surveyor' => Auth::user()->id,
                'location' => [
                    'latitude' => $latitude,
                    'longtitude' => $longitude,
                ],
                'answer' => [
                    $keunggulan_umum,
                    $keunggulan_produk,
                    $keunggulan_kompetitor,
                    $iklim,
                    $event,
                ],
            ]);

            $responJson = $response->json();

            DetailPenyimpanan::create([
                'penyimpanan_id' => $idPenyimpanan,
                'pertanyaan' => 'form_lahan',
                'api_id' => $responJson['id'],
            ]);

            if (Penyimpanan::hasDonePenyimpanan($request)) {
                $penyimpanan = Penyimpanan::findOrFail($idPenyimpanan);
                $penyimpanan->status = '1';
                $penyimpanan->save();
            }

            alert()->success('Berhasil', 'Berhasil menambahkan form kuisioner');
            return redirect()->route('menu.index');
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Sesalahan server, gagal menambahkan kuisioner');
            return redirect()->back()->withInput();
        }
    }
}
