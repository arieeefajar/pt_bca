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

        $dataProduct = JenisTanaman::join('produk', 'jenis_tanaman.id', '=', 'produk.id_jenis_tanaman')->select('produk.id as id', 'produk.nama_produk', 'jenis_tanaman.id as id_jenis_tanaman', 'jenis_tanaman.jenis')->get();

        $dataJenisTanaman = JenisTanaman::all();
        return view('admin.product', compact('dataProduct', 'dataJenisTanaman'));
    }

    public function store(Request $request)
    {
        // custom message validate
        $customMessages = [
            'nama_produk.required' => 'Nama Produk harus diisi.',
            'jenis_tanaman.required' => 'Jenis Tanaman harus diisi.',
        ];

        // validate
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:255',
            'jenis_tanaman' => 'required',
        ], $customMessages);

        // check validator
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // create
        $result = Product::create([
            'nama_produk' => $request->nama_produk,
            'id_jenis_tanaman' => $request->jenis_tanaman
        ]);

        return redirect(route('product.index'))->with('success', 'Data created successfully.');
        // // return response
        // return response()->json([
        //     "data" => $result
        // ]);
    }

    public function update(Request $request)
    {
        // custom message validate
        $customMessages = [
            'nama_produk.required' => 'Nama Produk harus diisi.',
            'jenis_tanaman.required' => 'Jenis Tanaman harus diisi.',
        ];

        // validate
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:255',
            'jenis_tanaman' => 'required',
        ], $customMessages);

        // check validator
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // update
        $result = Product::findOrFail($request->id)->update([
            'nama_produk' => $request->nama_produk,
            'id_jenis_tanaman' => $request->jenis_tanaman
        ]);


        return redirect(route('product.index'))->with('success', 'Data Updated successfully.');
        // // return response
        // return response()->json([
        //     "data" => Product::findOrFail($request->id)
        // ]);
    }

    public function destroy($id)
    {
        try {
            // delete
            Product::findOrFail($id)->delete();

            // return response
            return response()->json([
                'message' => 'data berhasil dihapus'
            ]);
        } catch (\Throwable $th) {

            // return error
            return response()->json($th);
        }
    }
}
