<?php

namespace App\Http\Controllers;

use App\Models\JenisKuisioner;
use Illuminate\Http\Request;

class JenisKuisionerController extends Controller
{
    public function index()
    {
        $dataJenisKuisioner = JenisKuisioner::all();
        return view('admin.jenisKuisioner', compact('dataJenisKuisioner'));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'jenis_kuisioner' => 'required',
        ]);

        JenisKuisioner::create([
            'jenis' => $request->jenis_kuisioner,
        ]);

        return redirect('/jenis-kuisioner');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_jenis_kuisioner_edit' => 'required',
            'jenis_kuisioner_edit' => 'required',
        ]);

        $dataUpdate = JenisKuisioner::findOrFail($request->id_jenis_kuisioner_edit);

        $dataUpdate->update([
            'jenis' => $request->jenis_kuisioner_edit,
        ]);

        return redirect('/jenis-kuisioner');
    }

    public function destroy($id)
    {
        $dataDestroy = JenisKuisioner::findOrFail($id);
        $dataDestroy->delete();
        return redirect('/jenis-kuisioner');
    }
}
