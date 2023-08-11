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
        $request->validate([
            'jenis' => 'required',
        ]);

        JenisKuisioner::create([
            'jenis' => $request->jenis,
        ]);

        return redirect('/kuisioner');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'jenis' => 'required',
        ]);

        $dataUpdate = JenisKuisioner::findOrFail($request->id);

        $dataUpdate->update([
            'jenis' => $request->jenis,
        ]);

        return redirect('/kuisioner');
    }

    public function destroy($id)
    {
        $dataDestroy = JenisKuisioner::findOrFail($id);
        $dataDestroy->delete();
        return redirect('/kuisioner');
    }
}
