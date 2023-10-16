<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kuisioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LaporanController extends Controller
{
    public function index()
    {
        $dataKuisioner = Kuisioner::all();
        return view('admin.laporan', compact('dataKuisioner'));
    }

    public function jawaban_kuisioner($type)
    {
        $endPointApi = env('PYTHON_END_POINT') . $type;
        $dataAnswer = [Http::get($endPointApi)->json()['data']];

        return response()->json(
            $dataAnswer,
        );
        // dd($dataAnswer);
        // return view('admin.laporan', compact('dataAnswer'));
    }
}
