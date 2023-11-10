<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Benih;
use App\Models\NamaProdukBenih;
use App\Models\ProdukBenih;
use App\Models\ProdusenBenih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyTokoController extends Controller
{
    public function index()
    {
        return view("surveyor.onlineSurveyStokToko");
    }

    //! service show data
    public function get_product_benih($jenis){
        $data = ProdukBenih::where("jenis",$jenis)->get();
        return response()->json($data);
    }

    public function get_jenis_benih($id_produk_benih){
        $data = Benih::where("produk_benih_id",$id_produk_benih)->get();
        return response()->json($data);
    }

    public function get_nama_produk($id_jenis_benih){
        $data = NamaProdukBenih::where("benih_id",$id_jenis_benih)->get();
        return response()->json($data);
    }

    public function get_produsen_benih(){
        $data = ProdusenBenih::all();
        return response()->json($data);
    }

    // ! service add data for lainnya option
    
    public function add_nama_benih(Request $request){

        return response()->json([
            'message' => 'maintenance'
        ], 200);

        // $jenis_produk_benih = isset($request->jenis_produk_benih) ? $request->jenis_produk_benih : null;
        // $produk_benih = isset($request->produk_benih) ? $request->produk_benih : null;
        // $jenis_benih = isset($request->jenis_benih) ? $request->jenis_benih : null;
        // $nama_produk = isset($request->nama_produk) ? $request->nama_produk : null;

        // if ($produk_benih) {
        //     $db_produk_benih = new ProdukBenih();
        //     $db_produk_benih->nama = $produk_benih;
        //     $db_produk_benih->jenis = $jenis_produk_benih;
        //     $db_produk_benih->save();

        //     return response()->json($db_produk_benih);
        // }
    }
}
