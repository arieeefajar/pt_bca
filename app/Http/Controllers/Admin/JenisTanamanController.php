<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisTanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisTanamanController extends Controller
{
    public function index()
    {
        $dataJenisTanaman = JenisTanaman::all();
        return view('admin.jenisTanaman', compact('dataJenisTanaman'));
    }

    // create
    public function store(Request $request)
    {
        // custom message validate
        $customMessages = [
            'jenis.required' => 'Jenis harus diisi.',
        ];

        // validate
        $validator = Validator::make($request->all(), [
            'jenis' => 'required|string|max:255',
        ], $customMessages);

        // check validator
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // create
        $result = JenisTanaman::create([
            'jenis' => $request->jenis,
            'awdawda' => $request->jenis
        ]);

        return redirect()->route('jenisTanaman.index')->with('success', 'Jenis Tanaman created successfully.');
        // return response
        // return response()->json([
        //     "data" => $result
        // ]);
    }

    // update
    public function update(Request $request)
    {
        // custom message validate
        $customMessages = [
            'id.required' => 'Error ID',
            'jenis.required' => 'Jenis harus diisi.',
        ];

        // validate
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'jenis' => 'required|string|max:255',
        ], $customMessages);

        // check validator
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // update
        $result = JenisTanaman::findOrFail($request->id)->update([
            'jenis' => $request->jenis
        ]);

        return redirect(route('jenisTanaman.index'))->with('success', 'Data Updated successfully.');
        // return response
        // return response()->json([
        //     "data" => JenisTanaman::findOrFail($request->id)
        // ]);
    }

    // delete
    public function destroy($id)
    {

        $dataDelete = JenisTanaman::findOrFail($id);
        $dataDelete->delete();
        return redirect(route('jenisTanaman.index'))->with('success', 'Data Deleted successfully.');
        // try {
        //     // delete
        //     JenisTanaman::findOrFail($id)->delete();

        //     // return response
        //     return response()->json([
        //         'message' => 'data berhasil dihapus'
        //     ]);
        // } catch (\Throwable $th) {

        //     // return error
        //     return response()->json($th);
        // }
    }
}
