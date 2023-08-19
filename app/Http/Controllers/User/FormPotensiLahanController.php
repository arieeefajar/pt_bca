<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class FormPotensiLahanController extends Controller
{
    public function index()
    {
        return view('surveyor.potensiLahan');
    }

    public function store()
    {
        $endPointApi = 'http://103.175.216.72/api/simi/potentional-area';

        $data1 = array(
            'varietal_characteristics' => [
                'general_excellence' => 'testing',
                'products_strengths' => 'testing',
                'competitor_advantages' => 'testing',
                'market_environment' => 'testing',
                'market_events' => 'testing',
            ],
        );

        $data2 = array(
            'growing_season' => [
                'climate' => 'testing',
                'market_events' => 'testing',
            ]
        );

        // dd(json_encode($dataSend));

        $response = Http::post($endPointApi, [
            "surveyor" => Auth::user()->id,
            "location" => [
                "latitude" => 123,
                "longtitude" => 456
            ],
            "answer" => [
                $data1,
                $data2
            ]
        ]);

        $responJson = $response->json();
        dd($responJson);
    }
}
