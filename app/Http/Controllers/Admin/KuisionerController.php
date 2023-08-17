<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\DetailKuisioner;
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

        return redirect(route('kuisioner.index'));
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

        return redirect(route('kuisioner.index'));
    }

    public function destroy($id)
    {
        // dd($id);
        $data = Kuisioner::findOrFail($id);
        $data->delete();
        return redirect(route('kuisioner.index'));
    }

    public function kepuasanPelanggan()
    {
        $model_detail_kuisioner = new DetailKuisioner();
        $dataPertanyaan = $model_detail_kuisioner->get_data_kuisioner('Kepuasan Pelanggan');

        return view('surveyor.kepuasanPelanggan', compact('dataPertanyaan'));
    }

    // public function analisisPesaing()
    // {
    //     $model_detail_kuisioner = new DetailKuisioner();
    //     $dataPertanyaan = $model_detail_kuisioner->get_data_kuisioner('Analisis Pesaing');

    //     return view('surveyor.analisisPesaing', compact('dataPertanyaan'));
    // }

    // public function kekuatanKelemahanPesaing()
    // {
    //     $model_detail_kuisioner = new DetailKuisioner();
    //     $dataPertanyaan = $model_detail_kuisioner->get_data_kuisioner('Kekuatan dan Kelemahan Pesaing');

    //     return view('surveyor.kekuatanKelemahanPesaing', compact('dataPertanyaan'));
    // }
}
