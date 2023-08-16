<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\JenisKuisioner;
use App\Models\Kuisioner;
use Illuminate\Http\Request;

class JenisKuisionerController extends Controller
{
    public function index()
    {
        $dataJenisKuisioner = JenisKuisioner::all();
        $dataKuisioner = Kuisioner::all();
        return view('admin.jenisKuisioner', compact('dataJenisKuisioner', 'dataKuisioner'));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'jenis_kuisioner' => 'required',
            'kuisioner' => 'required',
        ]);

        JenisKuisioner::create([
            'jenis' => $request->jenis_kuisioner,
            'quisioner_id' => $request->kuisioner,
        ]);

        return redirect(route('jenisKuisioner.index'));
    }

    public function update(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'id_jenis_kuisioner_edit' => 'required',
            'jenis_kuisioner_edit' => 'required',
            'kuisioner_edit' => 'required',
        ]);

        $dataUpdate = JenisKuisioner::findOrFail($request->id_jenis_kuisioner_edit);

        $dataUpdate->update([
            'jenis' => $request->jenis_kuisioner_edit,
            'quisioner_id' => $request->kuisioner_edit,
        ]);

        return redirect(route('jenisKuisioner.index'));
    }

    public function destroy($id)
    {
        $dataDestroy = JenisKuisioner::findOrFail($id);
        $dataDestroy->delete();
        return redirect(route('jenisKuisioner.index'));
    }
}
