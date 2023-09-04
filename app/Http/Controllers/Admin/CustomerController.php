<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        // get perusahaan and area data
        $dataPerusahaan = Customer::with('wilayah')->get();
        $dataArea = Wilayah::all();
        $dataProvinsi = Wilayah::getProvinsi();
        $dataKota = Wilayah::getKota();
        // dd($dataProvinsi);

        return view('admin.customer', compact('dataPerusahaan', 'dataArea', 'dataProvinsi', 'dataKota'));
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
            'provinsi' => 'required|string|max:20',
            'kota' => 'required|string|max:30',
            'area' => 'required|string|max:255',
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
        $customer->provinsi = $request->provinsi;
        $customer->kota = $request->kota;
        $customer->wilayah_id = $request->area;
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
            'provinsi' => 'required|string|max:20',
            'kota' => 'required|string|max:30',
            'area' => 'required|string|max:255',
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
        $dataEdit->provinsi = $request->provinsi;
        $dataEdit->kota = $request->kota;
        $dataEdit->wilayah_id = $request->area;
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
        $endPointApi = 'https://emsifa.github.io/api-wilayah-indonesia/api/regencies/' . $id . '.json';
        $dataAnswer = Http::get($endPointApi)->json();
        return response()->json($dataAnswer);
    }
}
