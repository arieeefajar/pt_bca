<?php

namespace App\Http\Controllers;

use App\Models\Kuisioner;
use Illuminate\Http\Request;

class KuisionerController extends Controller
{
    public function index()
    {
        $dataKuisioner = Kuisioner::all();
        return view('admin.kuisioner', compact('dataKuisioner'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama_quisioner' => 'required',
            'status_quisioner' => 'required|numeric',
        ]);

        Kuisioner::create([
            'nama' => $request->nama_quisioner,
            'status' => $request->status_quisioner,
        ]);

        return redirect('/kuisioner');
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_quisioner_edit' => 'required',
            'status_quisioner_edit' => 'required|numeric',
        ]);

        $data = Kuisioner::findOrFail($request->id);
        $data->update([
            'nama' => $request->nama_quisioner_edit,
            'status' => $request->status_quisioner_edit,
        ]);

        return redirect('/kuisioner');
    }

    public function destroy($id)
    {
        // dd($id);
        $data = Kuisioner::findOrFail($id);
        $data->delete();
        return redirect('/kuisioner');
    }

    public function kepuasanPelanggan()
    {
        return view('surveyor.kepuasanPelanggan');
    }

    public function analisisPesaing()
    {
        return view('surveyor.analisisPesaing');
    }

    public function kekuatanKelemahanPesaing()
    {
        return view('surveyor.kekuatanKelemahanPesaing');
    }
}
