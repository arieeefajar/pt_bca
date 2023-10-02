<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Kota;
use App\Models\Provinsi;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        // get perusahaan and area data
        $dataPerusahaan = Customer::with('kelurahan')
            ->orderBy('created_at', 'desc')
            ->get();
        $provinsi = Provinsi::all();
        // dd($provinsi);

        return view('admin.customer', compact('dataPerusahaan', 'provinsi'));
    }

    public function store(Request $request)
    {

        $customMessages = [
            'required' => ':attribute harus diisi.',
            'max' => ':attribute melebihi :max karakter.',
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:40',
            'jenis' => 'required|in:dealer,master_dealer,lainnya',
            'kelurahan' => 'required|string|max:255',
            'koordinat' => 'required|string|max:100',
        ], $customMessages);

        // check validator
        if ($validator->fails()) {
            alert()->error('Gagal', $validator->messages()->all()[0]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // create new customer data
        $customer = new Customer();
        $customer->nama = $request->nama;
        $customer->jenis = $request->jenis;
        $customer->kelurahan_id = $request->kelurahan;
        $customer->koordinat = $request->koordinat;

        // execute
        try {
            $customer->save();
            alert()->success('Berhasil', 'Berhasil menambahkan data customer baru');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Gagal', $th);
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {

        $customMessages = [
            'required' => ':attribute harus diisi.',
            'max' => ':attribute melebihi :max karakter.',
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:40',
            'jenis' => 'required|in:dealer,master_dealer,lainnya',
            'kelurahan' => 'required|string|max:255',
            'koordinat' => 'required|string|max:100',
        ], $customMessages);

        // check validator
        if ($validator->fails()) {
            alert()->error('Gagal', $validator->messages()->all()[0]);
            return redirect()->back();
        }

        // get customer data from id
        $dataEdit = Customer::findOrFail($id);
        $dataEdit->nama = $request->nama;
        $dataEdit->jenis = $request->jenis;
        $dataEdit->kelurahan_id = $request->kelurahan;
        $dataEdit->koordinat = $request->koordinat;

        // execute update
        try {
            $dataEdit->save();
            alert()->success('Berhasil', 'Berhasil mengubah data customer baru');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'asdgasdjad' . $th);
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        // get customer data from id
        $dataDelete = Customer::findOrFail($id);

        // execute delete
        try {
            $dataDelete->delete();
            alert()->success('Berhasil', 'Berhasil menghapus data customer baru');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Gagal', $th);
            return redirect()->back();
        }
    }

    public function getKota($id)
    {
        $dataKota = Kota::where('provinsi_id', $id)->get();
        return response()->json([
            'success' => true,
            'data' => $dataKota
        ]);
    }

    public function getKecamatan($id)
    {
        $dataKecamatan = Kecamatan::where('kota_id', $id)->get();
        return response()->json([
            'success' => true,
            'data' => $dataKecamatan
        ]);
    }

    public function getKelurahan($id)
    {
        $dataKelurahan = Kelurahan::where('kecamatan_id', $id)->get();
        return response()->json([
            'success' => true,
            'data' => $dataKelurahan
        ]);
    }

    public function getProvinsi($id_kelurahan)
    {
        $dataWilayah = Kelurahan::with('kecamatan', 'kecamatan.kota', 'kecamatan.kota.provinsi')->where('id', $id_kelurahan)->get();

        foreach ($dataWilayah as $value) {
            $idSelected = (object) array(
                'kelurahan' => $value->id,
                'kecamatan' => $value->kecamatan->id,
                'kota' => $value->kecamatan->kota->id,
                'provinsi' => $value->kecamatan->kota->provinsi->id,
            );
        }

        $allData = [
            'kota' => Kota::where('provinsi_id', $idSelected->provinsi)->get(),
            'kecamatan' => Kecamatan::where('kota_id', $idSelected->kota)->get(),
            'kelurahan' => Kelurahan::where('kecamatan_id', $idSelected->kecamatan)->get()
        ];

        $idSelected->allData = $allData;
        return response()->json([
            'success' => true,
            'data' => $idSelected
        ]);
    }
}