<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DetailKuisioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KuisonerAnalisisPesaingController extends Controller
{
    public function index()
    {
        $model_detail_kuisioner = new DetailKuisioner();
        $dataPertanyaan = $model_detail_kuisioner->get_data_kuisioner('Analisis Pesaing');

        return view('surveyor.analisisPesaing', compact('dataPertanyaan'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        // convert function
        $convert = function ($params) {
            return ($params == '1') ? true : false;
        };

        // data answer fieldlist
        $competitor = $request->competitor;
        $new_competitor = $request->new_competitor;
        $substitution = $request->substitution;
        $supplier = $request->supplier;
        $buyer = $request->buyer;

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



        $response = Http::post('http://103.175.216.72:8002/competitor-analys', [
            "surveyor" => 1,
            "location" => "123",
            "competitor" => [$competitor],
            "new_competitor" => [$new_competitor],
            "substitution" => [$substitution],
            "supplier" => [$supplier],
            "buyer" => [$buyer],
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

        dd($response->json());
    }
}
