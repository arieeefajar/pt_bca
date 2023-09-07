<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisTanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisTanamanController extends Controller
{
    public function index()
    {
        // get data jenis tanaman
        $dataJenisTanaman = JenisTanaman::orderBy('created_at', 'desc')->get();

        // retrun view
        return view('admin.jenisTanaman', compact('dataJenisTanaman'));
    }

    public function store(Request $request)
    {
        // custom message validate
        $customMessages = [
            'required' => ':attribute harus diisi.',
            'max' => ':attribute melebihi :max karakter'
        ];

        // validate
        $validator = Validator::make($request->all(), [
            'jenis' => 'required|string|max:30',
        ], $customMessages);

        // check validator
        if ($validator->fails()) {
            alert()->error('Gagal', $validator->messages()->all()[0]);
            return redirect()->back()->withInput();
        }

        // create new jenis tanaman data
        $jenis = new JenisTanaman();
        $jenis->jenis = $request->jenis;

        // execute
        try {
            $jenis->save();
            alert()->success('Berhasil', 'Berhasil menambahkan data jenis tanaman baru');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Gagal', $th);
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        // custom message validate
        $customMessages = [
            'required' => ':attribute harus diisi.',
            'max' => ':attribute melebihi :max karakter'
        ];

        // validate
        $validator = Validator::make($request->all(), [
            'jenis' => 'required|string|max:30',
        ], $customMessages);

        // check validator
        if ($validator->fails()) {
            alert()->error('Gagal', $validator->messages()->all()[0]);
            return redirect()->back();
        }

        // get jenis data from id
        $jenis = JenisTanaman::findOrFail($id);
        $jenis->jenis = $request->jenis;

        // execute update
        try {
            $jenis->save();
            alert()->success('Berhasil', 'Berhasil mengubah data jenis tanaman');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Gagal', $th);
            return redirect()->back();
        }
    }

    public function destroy($id)
    {

        // get jenis data from id
        $jenis = JenisTanaman::findOrFail($id);

        // if user data not exists
        if (!$jenis) {
            alert()->error('Gagal', 'User tidak di temukan');
            return redirect()->back();
        }

        // execute delete
        try {
            $jenis->delete();
            alert()->success('Berhasil', 'Berhasil menghapus data jenis tanaman');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Gagal', $th);
            return redirect()->back();
        }
    }
}
