<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\DetailPenyimpanan;
use App\Models\Penyimpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class KuisionerSkalaPasarProduk extends Controller
{
    public function index(Request $request, $api_id = null)
    {
        $idPenyimpanan = DetailPenyimpanan::getIdPenyimpanan($request);
        $k_skala_pasar = DetailPenyimpanan::hasDetailPenyimpanan(
            $idPenyimpanan,
            'skala_pasar'
        );

        $dataAnswer = null;

        // kika jawaban sudah ada dan ada api id
        if ($k_skala_pasar && $api_id) {
            $endPointApi = env('PYTHON_END_POINT') . 'competitor-questionnaire/' . $api_id;
            try {
                $dataAnswer = (object) [Http::get($endPointApi)->json()['data']][0];
                return view('surveyor.skalaPasarProduk', compact('dataAnswer'));
            } catch (\Throwable $th) {
                alert()->error('Gagal', 'Sesalahan server, gagal menampilkan jawaban');
                return redirect()->route('menu.index');
            }
        }
        // ketika jawaban sudah ada dan user memaksa masuk lewat url
        elseif ($k_skala_pasar) {
            toast('Form survey sudah diisikan', 'error')
                ->position('top')
                ->autoClose(3000);
            return redirect()->route('menu.index');
        } else {
            return view('surveyor.skalaPasarProduk', compact('dataAnswer'));
        }
    }

    public function store(Request $request)
    {
        $customMessages = [
            'required' => 'Harap lengkapi kuisiner',
            'numeric' => 'Kolom :attribute tidak valid',
            'string' => 'Kolom :attribute harus berupa text',
        ];

        $validator = Validator::make(
            $request->all(),
            [
                'sales_system' => 'required|string',
                'how_many_brands' => 'required|string',
                'quantity_of_product' => 'required|string',
                'supply_period' => 'required|string',
                'producer_locaitons' => 'required|string',
                'weight_product' => 'required|string',
                'lowest_price' => 'required|string',
                'know_distributor' => 'required|string',
                'rewards_or_discount' => 'required|string',
                'sales_system_application' => 'required|string',
                'matrix_volume' => 'required|string',
                'suply_term' => 'required|string',
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
            'skala_pasar'
        );

        // cek apakah sudah ada detail penyimpanan dengan jenis pertanyaan yang sama
        if ($cekDetailPenyimpanan) {
            alert()->warning('Gagal', 'Data form sudah ada');
            return redirect()->route('menu.index');
        }

        $endPointApi = env('PYTHON_END_POINT') . 'competitor-questionnaire';

        // latitude & longitude
        $koordinat = Customer::select('koordinat')
            ->where('id', $request->cookie('selectedTokoId'))
            ->first()->koordinat;
        $koordinat = explode(', ', $koordinat);

        // data send
        $sales_system = $request->sales_system;
        $how_many_brands = $request->how_many_brands;
        $quantity_of_product = $request->quantity_of_product;
        $supply_period = $request->supply_period;
        $producer_locaitons = $request->producer_locaitons;
        $weight_product = $request->weight_product;
        $lowest_price = $request->lowest_price;
        $know_distributor = $request->know_distributor;
        $rewards_or_discount = $request->rewards_or_discount;
        $sales_system_application = $request->sales_system_application;
        $matrix_volume = $request->matrix_volume;
        $suply_term = $request->suply_term;
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
                'sales_system' => $sales_system,
                'how_many_brands' => $how_many_brands,
                'quantity_of_product' => $quantity_of_product,
                'supply_period' => $supply_period,
                'producer_locaitons' => $producer_locaitons,
                'weight_product' => $weight_product,
                'lowest_price' => $lowest_price,
                'know_distributor' => $know_distributor,
                'rewards_or_discount' => $rewards_or_discount,
                'sales_system_application' => $sales_system_application,
                'matrix_volume' => $matrix_volume,
                'suply_term' => $suply_term,
            ]);

            $responJson = $response->json();
            // dd($responJson);

            DetailPenyimpanan::create([
                'penyimpanan_id' => $idPenyimpanan,
                'pertanyaan' => 'skala_pasar',
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
