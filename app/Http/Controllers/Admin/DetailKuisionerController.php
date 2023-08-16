<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\DetailKuisioner;
use App\Models\JenisKuisioner;
use App\Models\Kuisioner;
use Illuminate\Http\Request;

class DetailKuisionerController extends Controller
{
    public function index()
    {
        $dataDetailKuisioner = Kuisioner::join('jenis_quisioner', 'quisioner.id', '=', 'jenis_quisioner.quisioner_id')
            ->join('detail_quisioner', 'detail_quisioner.jenis_quisioner_id', '=', 'jenis_quisioner.id')
            ->select('quisioner.id as quisioner_id', 'quisioner.nama', 'jenis_quisioner.id as jenis_quisioner_id', 'jenis_quisioner.jenis', 'detail_quisioner.id', 'detail_quisioner.pertanyaan', 'detail_quisioner.jenis_jawaban')
            ->get();
        $dataJenisKuisioner = JenisKuisioner::all();
        $dataKuisioner = Kuisioner::all();

        return view('admin.detailKuisioner', compact('dataDetailKuisioner', 'dataJenisKuisioner', 'dataKuisioner'));
    }

    // add data
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'jenis_kuisioner_add' => 'required',
            'pertanyaan' => 'required',
            'jenis_jawaban' => 'required|numeric',
        ]);

        DetailKuisioner::create([
            'jenis_quisioner_id' => $request->jenis_kuisioner_add,
            'pertanyaan' => $request->pertanyaan,
            'jenis_jawaban' => $request->jenis_jawaban,
        ]);

        return redirect(route('detailKuisioner.index'));
    }

    // update data
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'id' => 'required',
            'kuisioner' => 'required',
            'jenis_kuisioner' => 'required',
            'pertanyaan' => 'required',
            'jenis_jawaban' => 'required|numeric',
        ]);

        $dataUpdate = DetailKuisioner::findOrFail($request->id);

        $dataUpdate->update([
            'quisioner_id' => $request->kuisioner,
            'jenis_quisioner_id' => $request->jenis_kuisioner,
            'pertanyaan' => $request->pertanyaan,
            'jenis_jawaban' => $request->jenis_jawaban,
        ]);

        return redirect(route('detailKuisioner.index'));
    }

    // delete data
    public function destroy($id)
    {
        // dd($id);
        $dataDestroy = DetailKuisioner::findOrFail($id);
        $dataDestroy->delete();
        return redirect(route('detailKuisioner.index'));
    }
}
