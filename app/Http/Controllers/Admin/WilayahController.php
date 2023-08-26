<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WilayahController extends Controller
{
    public function index()
    {
        // return response
        return response()->json([
            "data" => Wilayah::all()
        ]);
    }

    public function store(Request $request)
    {
        // custom message validate
        $customMessages = [
            'nama_wilayah.required' => 'Nama Wilayah harus diisi.',
            'koordinat_wilayah.required' => 'Nama Wilayah harus diisi.',
        ];

        // validate
        $validator = Validator::make($request->all(), [
            'nama_wilayah' => 'required|string|max:255',
            'koordinat_wilayah' => 'required|string|max:255',
        ], $customMessages);

        // check validator
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // create
        $result = Wilayah::create([
            'nama' => $request->nama_wilayah,
            'koordinat' => $request->koordinat_wilayah,
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
            'nama_wilayah.required' => 'Nama Wilayah harus diisi.',
            'koordinat_wilayah.required' => 'Nama Wilayah harus diisi.',
        ];

        // validate
        $validator = Validator::make($request->all(), [
            'nama_wilayah' => 'required|string|max:255',
            'koordinat_wilayah' => 'required|string|max:255',
        ], $customMessages);

        // check validator
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // update
        $result = Wilayah::findOrFail($request->id)->update([
            'nama' => $request->nama_wilayah,
            'koordinat' => $request->koordinat_wilayah,
        ]);

        // return response
        return response()->json([
            "data" => Wilayah::findOrFail($request->id)
        ]);
    }

    public function destroy($id)
    {
        try {
            // delete
            Wilayah::findOrFail($id)->delete();

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
