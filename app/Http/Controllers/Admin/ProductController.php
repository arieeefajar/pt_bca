<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\JenisTanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {

        // get data product
        $dataProduct = JenisTanaman::join('produk', 'jenis_tanaman.id', '=', 'produk.id_jenis_tanaman')->select('produk.id as id', 'produk.nama_produk', 'jenis_tanaman.id as id_jenis_tanaman', 'jenis_tanaman.jenis')->get();

        // get data jenis tanaman from data input in view
        $dataJenisTanaman = JenisTanaman::all();

        // return view
        return view('admin.product', compact('dataProduct', 'dataJenisTanaman'));
    }

    public function store(Request $request)
    {
        $customMessages = [
            'required' => ':attribute harus diisi.',
            'max' => ':attribute max 50 kata.',
        ];

        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:50',
            'jenis_tanaman' => 'required',
        ], $customMessages);

        // check validator
        if ($validator->fails()) {
            alert()->error('Gagal', $validator->messages()->all()[0]);
            return redirect()->back()->withInput();
        }

        // create new product data
        $product = new Product();
        $product->nama_produk = $request->nama_produk;
        $product->id_jenis_tanaman = $request->jenis_tanaman;

        // execute
        try {
            $product->save();
            alert()->success('Berhasil', 'Berhasil menambahkan data produk baru');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Berhasil', $th);
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        // custom message validate
        $customMessages = [
            'required' => ':attribute harus diisi.',
            'max' => ':attribute max 50 kata.',
        ];

        // validate
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:50',
            'jenis_tanaman' => 'required',
        ], $customMessages);

        // check validator
        if ($validator->fails()) {
            alert()->error('Gagal', $validator->messages()->all()[0]);
            return redirect()->back();
        }

        // get product data from id
        $product = Product::findOrFail($id);
        $product->nama_produk = $request->nama_produk;
        $product->id_jenis_tanaman = $request->jenis_tanaman;

        // execute edit
        try {
            $product->save();
            alert()->success('Berhasil', 'Berhasil mengubah data produk');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Gagal', $th);
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {

        // get product data from id
        $product = Product::find($id);

        // if product data not exists
        if (!$product) {
            alert()->error('Gagal', 'Produk tidak di temukan');
            return redirect()->route('user.index')->with('error', 'User not found.');
        }

        // execute delete
        try {
            $product->delete();
            alert()->success('Berhasil', 'Berhasil menghapus data produk');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Gagal', $th);
            return redirect()->back();
        }
    }
}
