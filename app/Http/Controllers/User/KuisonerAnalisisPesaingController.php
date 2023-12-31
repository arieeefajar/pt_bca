<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\DetailKuisioner;
use App\Models\DetailPenyimpanan;
use App\Models\Penyimpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class KuisonerAnalisisPesaingController extends Controller
{
    public function index(Request $request, $api_id = null)
    {
        $idPenyimpanan = DetailPenyimpanan::getIdPenyimpanan($request);
        $k_analisis = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'k_analisis');

        $dataAnswer = null;

        // ketika jawaban sudah ada dan ada api id
        if ($k_analisis && $api_id) {
            $endPointApi = env('PYTHON_END_POINT') . 'competitor-analys/' . $api_id;
            try {
                $dataAnswer = (object) [Http::get($endPointApi)->json()['data']][0];
                return view('surveyor.analisisPesaing', compact('dataAnswer'));
            } catch (\Throwable $th) {
                alert()->error('Gagal', 'Sesalahan server, gagal menampilkan jawaban');
                return redirect()->route('menu.index');
            }
        }
        // ketika jawaban sudah ada dan user memaksa masuk lewat url
        elseif ($k_analisis) {
            toast('Form survey sudah diisikan', 'error')
                ->position('top')
                ->autoClose(3000);
            return redirect()->route('menu.index');
        } else {
            return view('surveyor.analisisPesaing', compact('dataAnswer'));
        }
    }

    public function store(Request $request)
    {

        $customMessages = [
            'required' => 'Harap lengkapi kuisioner.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
        ];

        $validator = Validator::make($request->all(), [
            'competitor' => 'required',
            'new_competitor' => 'required',
            'substitution' => 'required',
            'supplier' => 'required',
            'buyer' => 'required',
            'any_competitor' => 'required',
            'difference' => 'required',
            'easy_out' => 'required',
            'quantity' => 'required',
            'clear_difference' => 'required',
            'big_capital' => 'required',
            'cost' => 'required',
            'easy_channel' => 'required',
            'policy' => 'required',
            'find_subtitution' => 'required',
            'competitive_price' => 'required',
            'supplier_choice' => 'required',
            'change_price' => 'required',
            'any_substitution' => 'required',
            'competitive_tendencies' => 'required',
            'dominant' => 'required',
            'contribution' => 'required',
            'difference_desire' => 'required',
            'customor_movement' => 'required',
            'price_sensitivity' => 'required',
            'quality_than_price' => 'required',
            'trend_competition' => 'required',
            // 'latitude' => 'required',
            // 'longitude' => 'required',
        ], $customMessages);


        if ($validator->fails()) {
            alert()->error('Gagal', $validator->messages()->all()[0]);
            return redirect()->back()->withInput();
        }

        $idPenyimpanan = DetailPenyimpanan::getIdPenyimpanan($request);
        $cekDetailPenyimpanan = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'k_analisis');

        // cek apakah sudah ada detail penyimpanan dengan jenis pertanyaan yang sama
        if ($cekDetailPenyimpanan) {
            alert()->warning('Gagal', 'Data form sudah ada');
            return redirect()->route('menu.index');
        }

        $endPointApi = env('PYTHON_END_POINT') . 'competitor-analys';

        // latitude & longitude
        $koordinat = Customer::select('koordinat')
            ->where('id', $request->cookie('selectedTokoId'))
            ->first()
            ->koordinat;
        $koordinat = explode(", ", $koordinat);

        // convert function
        $convert = function ($params) {
            return ($params == '1') ? true : false;
        };

        // data answer fieldlist
        $competitor = explode(", ", $request->competitor);
        $new_competitor = explode(", ", $request->new_competitor);
        $substitution = explode(", ", $request->substitution);
        $supplier = explode(", ", $request->supplier);
        $buyer = explode(", ", $request->buyer);

        // data answer true false
        $any_competitor = $convert($request->any_competitor);
        $difference = $convert($request->difference);
        $easy_out = $convert($request->easy_out);
        $quantity = $convert($request->quantity);
        $clear_difference = $convert($request->clear_difference);
        $big_capital = $convert($request->big_capital);
        $cost = $convert($request->cost);
        $easy_channel = $convert($request->easy_channel);
        $policy = $convert($request->policy);
        $find_subtitution = $convert($request->find_subtitution);
        $competitive_price = $convert($request->competitive_price);
        $supplier_choice = $convert($request->supplier_choice);
        $change_price = $convert($request->change_price);
        $any_substitution = $convert($request->any_substitution);
        $competitive_tendencies = $convert($request->competitive_tendencies);
        $dominant = $convert($request->dominant);
        $contribution = $convert($request->contribution);
        $difference_desire = $convert($request->difference_desire);
        $customor_movement = $convert($request->customor_movement);
        $price_sensitivity = $convert($request->price_sensitivity);
        $quality_than_price = $convert($request->quality_than_price);
        $trend_competition = $convert($request->trend_competition);
        // $latitude = floatval($request->latitude);
        // $longitude = floatval($request->longitude);
        $latitude = floatval($koordinat[0]);
        $longitude = floatval($koordinat[1]);


        try {
            $response = Http::post($endPointApi, [
                "surveyor" => Auth::user()->id,
                "location" => [
                    "latitude" => $latitude,
                    "longtitude" => $longitude
                ],
                "competitor" => $competitor,
                "new_competitor" => $new_competitor,
                "substitution" => $substitution,
                "supplier" => $supplier,
                "buyer" => $buyer,
                "any_competitor" => $any_competitor,
                "difference" => $difference,
                "easy_out" => $easy_out,
                "quantity" => $quantity,
                "clear_difference" => $clear_difference,
                "big_capital" => $big_capital,
                "cost" => $cost,
                "easy_channel" => $easy_channel,
                "policy" => $policy,
                "find_subtitution" => $find_subtitution,
                "competitive_price" => $competitive_price,
                "supplier_choice" => $supplier_choice,
                "change_price" => $change_price,
                "any_substitution" => $any_substitution,
                "competitive_tendencies" => $competitive_tendencies,
                "dominant" => $dominant,
                "contribution" => $contribution,
                "difference_desire" => $difference_desire,
                "customor_movement" => $customor_movement,
                "price_sensitivity" => $price_sensitivity,
                "quality_than_price" => $quality_than_price,
                "trend_competition" => $trend_competition
            ]);
    
            $responJson = $response->json();
    
            DetailPenyimpanan::create([
                'penyimpanan_id' => $idPenyimpanan,
                'pertanyaan' => 'k_analisis',
                'api_id' => $responJson['id']
            ]);
    
            if (Penyimpanan::hasDonePenyimpanan($request)) {
                $penyimpanan = Penyimpanan::findOrFail($idPenyimpanan);
                $penyimpanan->status = '1';
                $penyimpanan->save();
            }
    
            alert()->success('Berhasil', 'Berhasil menambahkan kuisioner');
            return redirect()->route('menu.index');
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Sesalahan server, gagal menambahkan kuisioner');
            return redirect()->back()->withInput();
        }
    }
}
