<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestApi extends Controller
{
    public function getDataKompetitorAnalys(){
        $response = Http::get('http://103.175.216.72:8002/competitor-analys');

        dd($response->json());
    }
}
