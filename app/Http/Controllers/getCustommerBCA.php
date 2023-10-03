<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class getCustommerBCA extends Controller
{
    public function index()
    {

        $endPointApi = 'https://prodev.benihcitraasia.co.id/api/v1/customers';
        $token = '3|Y4LKnJEuhVTSvkhRUgf5rm2nSdqaYh9YpX1ouYUQ'; // Gantilah YOUR_BEARER_TOKEN dengan token Anda yang sesuai

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($endPointApi)->json()['data'];

        return response()->json([
            'data' => $response
        ]);
    }
}
