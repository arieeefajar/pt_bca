<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PerusahaanController extends Controller
{
    public function index()
    {
        $dataPerusahaan = Perusahaan::all();
        return view('admin.perusahaan', compact('dataPerusahaan'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $customMessages = [
            'nama.required' => 'Nama harus diisi.',
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Perusahaan::create([
            'nama' => $request->nama,
        ]);

        return redirect(route('perusahaan.index'))->with('success', 'Data created successfully.');
    }

    public function update(Request $request)
    {
        $customMessages = [
            'id.required' => 'ID Error',
            'nama.required' => 'Nama harus diisi.',
        ];

        $validator = Validator::make($request->all(), [
            'id' => 'required|string',
            'nama' => 'required|string|max:255',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dataEdit = Perusahaan::findOrFail($request->id);
        $dataEdit->update([
            'nama' => $request->nama,
        ]);

        return redirect(route('perusahaan.index'))->with('success', 'Data Updated successfully.');
    }

    public function destroy($id)
    {
        $dataDelete = Perusahaan::findOrFail($id);
        $dataDelete->delete();

        return redirect(route('perusahaan.index'))->with('success', 'Data Deleted successfully.');
    }
}
