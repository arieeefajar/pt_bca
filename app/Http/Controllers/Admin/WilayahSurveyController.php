<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wilayah_survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WilayahSurveyController extends Controller
{
    public function index()
    {
        // return response
        return response()->json([
            "data" => Wilayah_survey::all()
        ]);
    }

    public function store(Request $request)
    {
        // custom message validate
        $customMessages = [
            'wilayah.required' => 'Wilayah harus diisi.',
            'surveyor.required' => 'Surveyor harus diisi.',
            'start_day.required' => 'Start day harus diisi.',
            'end_day.required' => 'End day harus diisi.',
        ];

        // validate
        $validator = Validator::make($request->all(), [
            'wilayah' => 'required|numeric',
            'surveyor' => 'required|numeric',
            'start_day' => 'required',
            'end_day' => 'required',
        ], $customMessages);

        // check validator
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // create
        $result = Wilayah_survey::create([
            'wilayah_id' => $request->wilayah,
            'surveyor_id' => $request->surveyor,
            'start_day' => $request->start_day,
            'end_day' => $request->end_day,
        ]);

        // return response
        return response()->json([
            "data" => $result
        ]);
    }

    public function update(Request $request)
    {
        // custom message validate
        $customMessages = [
            'id.required' => 'Error ID.',
            'wilayah.required' => 'Wilayah harus diisi.',
            'surveyor.required' => 'Surveyor harus diisi.',
            'start_day.required' => 'Start day harus diisi.',
            'end_day.required' => 'End day harus diisi.',
        ];

        // validate
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'wilayah' => 'required|numeric',
            'surveyor' => 'required|numeric',
            'start_day' => 'required',
            'end_day' => 'required',
        ], $customMessages);

        // check validator
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // update
        $result = Wilayah_survey::findOrFail($request->id)->update([
            'wilayah_id' => $request->wilayah,
            'surveyor_id' => $request->surveyor,
            'start_day' => $request->start_day,
            'end_day' => $request->end_day,
        ]);

        // return response
        return response()->json([
            "data" => Wilayah_survey::findOrFail($request->id)
        ]);
    }

    public function destroy($id)
    {
        try {
            // delete
            Wilayah_survey::findOrFail($id)->delete();

            // return response
            return response()->json([
                'message' => 'data berhasil dihapus'
            ]);
        } catch (\Throwable $th) {

            // return error
            return response()->json($th);
        }
    }
}
