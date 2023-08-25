<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $dataPerusahaan = Customer::all();
        return view('admin.customer', compact('dataPerusahaan'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $customMessages = [
            'nama.required' => 'Nama harus diisi.',
            'jenis.required' => 'Jenis harus diisi.',
            'provinsi.required' => 'Provinsi harus diisi.',
            'kota.required' => 'Kota harus diisi.',
            'area.required' => 'Area harus diisi.',
            'amm.required' => 'Amm harus diisi.',
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:dealer,master_dealer,lainnya',
            'provinsi' => 'required|string|max:20',
            'kota' => 'required|string|max:30',
            'area' => 'required|string|max:20',
            'amm' => 'required|string|max:7',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Customer::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'area' => $request->area,
            'amm' => $request->amm,
        ]);

        return redirect(route('customer.index'))->with('success', 'Data created successfully.');
    }

    public function update(Request $request)
    {
        $customMessages = [
            'id.required' => 'ID Error',
            'nama.required' => 'Nama harus diisi.',
            'jenis.required' => 'Jenis harus diisi.',
            'provinsi.required' => 'Provinsi harus diisi.',
            'kota.required' => 'Kota harus diisi.',
            'area.required' => 'Area harus diisi.',
            'amm.required' => 'Amm harus diisi.',
        ];

        $validator = Validator::make($request->all(), [
            'id' => 'required|string',
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:dealer,master_dealer,lainnya',
            'provinsi' => 'required|string|max:20',
            'kota' => 'required|string|max:30',
            'area' => 'required|string|max:20',
            'amm' => 'required|string|max:7',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dataEdit = Customer::findOrFail($request->id);
        $dataEdit->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'area' => $request->area,
            'amm' => $request->amm,
        ]);

        return redirect(route('customer.index'))->with('success', 'Data Updated successfully.');
    }

    public function destroy($id)
    {
        $dataDelete = Customer::findOrFail($id);
        $dataDelete->delete();

        return redirect(route('customer.index'))->with('success', 'Data Deleted successfully.');
    }
}
