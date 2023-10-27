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
        $dataPerusahaan = Customer::with('kota', 'kota.provinsi')
            ->orderBy('created_at', 'desc')
            ->get();
        $provinsi = Provinsi::all();
        // dd($dataPerusahaan);

        return view('admin.customer', compact('dataPerusahaan', 'provinsi'));
    }

    public function store(Request $request)
    {

        $customMessages = [
            'required' => ':attribute harus diisi.',
            'max' => ':attribute melebihi :max karakter.',
            'string' =>':attribute harus berupa string.'
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:40',
            'jenis' => 'required|in:petani_pengguna,master_dealer,dealer,kios,lahan_petani,lainnya',
            'kota' => 'required|string|max:255',
            'latitude' => 'required|string|max:30',
            'longitude' => 'required|string|max:30',
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
        $customer->kota_id = $request->kota;

        $koordinat = $request->latitude.', '.$request->longitude;
        $customer->koordinat = $koordinat;

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
            'string' =>':attribute harus berupa string.'
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:40',
            'jenis' => 'required|in:petani_pengguna,master_dealer,dealer,kios,lahan_petani,lainnya',
            'kota' => 'required|string|max:255',
            'latitude' => 'required|string|max:30',
            'longitude' => 'required|string|max:30',
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
        $dataEdit->kota_id = $request->kota;
        
        $koordinat = $request->latitude.', '.$request->longitude;
        $dataEdit->koordinat = $koordinat;

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

    public function getProvinsi($id_kota)
    {
        $dataWilayah = Kota::with('provinsi')->where('id', $id_kota)->get()->first();
        $listKota = Kota::where('provinsi_id', $dataWilayah->provinsi->id)->get();
        $dataWilayah->listKota = $listKota;
        return response()->json([
            'success' => true,
            'data' => $dataWilayah
        ]);
    }
}