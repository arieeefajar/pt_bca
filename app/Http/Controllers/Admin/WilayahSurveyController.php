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
        $dataSurveyor = User::where('role', 'user')->get();
        $dataWilayah = User::select(
            'users.id',
            'wilayah_survey.id AS id_survey',
            'provinsi.nama AS provinsi',
            'kota.nama AS kota'
        )
            ->join(
                'wilayah_survey',
                'users.id',
                '=',
                'wilayah_survey.surveyor_id'
            )
            ->join('kota', 'wilayah_survey.kota_id', '=', 'kota.id')
            ->join('provinsi', 'kota.provinsi_id', '=', 'provinsi.id')
            ->get();

        foreach ($dataSurveyor as $keyUser => $valUser) {
            $tmpWilayah = [];
            foreach ($dataWilayah as $keyWilayah => $valWilayah) {
                if ($valUser->id === $valWilayah->id) {
                    array_push($tmpWilayah, $valWilayah);
                }
            }
            if (count($tmpWilayah) === 0) {
                $tmpWilayah = null;
            }
            $dataSurveyor[$keyUser]->wilayah = $tmpWilayah;
        }
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

        $validateUnique = Wilayah_survey::where('surveyor_id', $id)
            ->where('kota_id', $request->kota)
            ->get();
        if (count($validateUnique) > 0) {
            alert()->info('Gagal', 'Wilayah survey sudah ada');
            return redirect()->back();
        }

        // create
        try {
            Wilayah_survey::create([
                'kota_id' => $request->kota,
                'surveyor_id' => $id,
            ]);
            alert()->success('Berhasil', 'Berhasil set wilayah survey');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Gagal', $th[0]);
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            Wilayah_survey::findOrFail($id)->delete();
            alert()->success('Berhasil', 'Berhasil menghapus wilayah survey');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Gagal', $th[0]);
            return redirect()->back();
        }
    }
}
