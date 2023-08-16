<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Posisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PosisiController extends Controller
{
    public function index()
    {
        $dataPosisi = Posisi::all();
        return view('admin.posisi', compact('dataPosisi'));
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

        Posisi::create([
            'nama' => $request->nama,
        ]);

        return redirect(route('posisi.index'))->with('success', 'Data created successfully.');
    }

    public function update(Request $request)
    {
        // dd($request->all());
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

        $dataUpdate = Posisi::findOrFail($request->id);
        $dataUpdate->update([
            'nama' => $request->nama,
        ]);

        return redirect(route('posisi.index'))->with('success', 'Data updated successfully.');
    }

    public function destroy($id)
    {
        $dataDelete = Posisi::findOrFail($id);
        $dataDelete->delete();

        return redirect(route('posisi.index'))->with('success', 'Data deleted successfully.');
    }
}
