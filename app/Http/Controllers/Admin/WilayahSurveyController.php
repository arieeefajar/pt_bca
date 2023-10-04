<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use App\Models\User;
use App\Models\Wilayah_survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WilayahSurveyController extends Controller
{
    public function index()
    {
        $dataSurveyor = Wilayah_survey::getWilayahSurvey();
        $provinsi = Provinsi::all();

        return view('admin.dataSurveyor', compact('dataSurveyor', 'provinsi'));
    }

    public function store(Request $request, $id)
    {
        // custom message validate
        $customMessages = [
            'kota.required' => 'Wilayah harus diisi.',
        ];

        // validate
        $validator = Validator::make(
            $request->all(),
            [
                'kota' => 'required',
            ],
            $customMessages
        );

        // check validator
        if ($validator->fails()) {
            alert()->error('Gagal', $validator->messages()->all()[0]);
            return redirect()
                ->back()
                ->withInput();
        }

        // create
        $wilayahSurvey = Wilayah_survey::where('surveyor_id', $id)->first();

        try {
            if (!$wilayahSurvey) {
                Wilayah_survey::create([
                    'kota_id' => $request->kota,
                    'surveyor_id' => $id,
                ]);
            } else {
                $wilayahSurvey->kota_id = $request->kota;
                $wilayahSurvey->save();
            }
            alert()->success('Berhasil', 'Berhasil set wilayah survey');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Gagal', $th[0]);
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            // delete
            Wilayah_survey::findOrFail($id)->delete();

            // return response
            return response()->json([
                'message' => 'data berhasil dihapus',
            ]);
        } catch (\Throwable $th) {
            // return error
            return response()->json($th);
        }
    }
}
