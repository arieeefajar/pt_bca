<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Benih;
use App\Models\DetailRecordSurveyStock;
use App\Models\NamaProdukBenih;
use App\Models\ProdukBenih;
use App\Models\ProdusenBenih;
use App\Models\RecordSurveyStock;
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
    public function add_other_4_table(Request $request){

        // when user choice lainnya in all select

        $jenis = $request->jenis; // horti, pangan
        $jenis_benih = $request->nama; // padi, jagung
        $benih = $request->benih; // jagung hibrida, jagung inhibrida
        $nama_produk = $request->nama_produk; // betras 9, betras 7
        $nama_produsen = $request->nama_produsen; // PT BCA

        $produk_benih = new ProdukBenih();
        $produk_benih->nama = $jenis_benih;
        $produk_benih->jenis = $jenis;
        $produk_benih->save();

        $benih = new Benih();
        $benih->produk_benih_id = $produk_benih->id;
        $benih->nama = $benih;
        $benih->save();

        $nama_produk_benih = new NamaProdukBenih();
        $nama_produk_benih->benih_id = $benih->id;
        $nama_produk_benih->nama = $nama_produk;
        $nama_produk_benih->save();

        $produsen = new ProdusenBenih();
        $produsen->nama = $nama_produsen;
        $produsen->save();

        return response()->json([
            'jenis_benih' => $produk_benih->id,
            'benih' => $benih->id,
            'produk' => $nama_produk_benih->id,
            'produsen' => $produsen->id
        ], 200);
    }

    public function add_other_3_table(Request $request){

        // when user choice lainnya from pilih jenis benih

        $jenis = $request->jenis; // horti, pangan
        $jenis_benih = $request->nama; // padi, jagung
        $benih = $request->benih; // jagung hibrida, jagung inhibrida
        $nama_produk = $request->nama_produk; // betras 9, betras 7

        $produk_benih = new ProdukBenih();
        $produk_benih->nama = $jenis_benih;
        $produk_benih->jenis = $jenis;
        $produk_benih->save();

        $benih = new Benih();
        $benih->produk_benih_id = $produk_benih->id;
        $benih->nama = $benih;
        $benih->save();

        $nama_produk_benih = new NamaProdukBenih();
        $nama_produk_benih->benih_id = $benih->id;
        $nama_produk_benih->nama = $nama_produk;
        $nama_produk_benih->save();

        return response()->json([
            'jenis_benih' => $produk_benih->id,
            'benih' => $benih->id,
            'produk' => $nama_produk_benih->id,
        ], 200);
    }

    public function add_other_2_table(Request $request){

        // when user choice lainnya from pilih benih
        $produk_benih_id = $request->produk_benih_id;
        $benih = $request->benih; // jagung hibrida, jagung inhibrida
        $nama_produk = $request->nama_produk; // betras 9, betras 7

        $benih = new Benih();
        $benih->produk_benih_id = $produk_benih_id;
        $benih->nama = $benih;
        $benih->save();

        $nama_produk_benih = new NamaProdukBenih();
        $nama_produk_benih->benih_id = $benih->id;
        $nama_produk_benih->nama = $nama_produk;
        $nama_produk_benih->save();

        return response()->json([
            'benih' => $benih->id,
            'produk' => $nama_produk_benih->id,
        ], 200);
    }

    public function add_other_1_table(Request $request){

        // when user just choice lainnya in pilih produk
        $benih_id = $request->benih_id; // jagung hibrida, jagung inhibrida
        $nama_produk = $request->nama_produk; // betras 9, betras 7

        $nama_produk_benih = new NamaProdukBenih();
        $nama_produk_benih->benih_id = $benih_id;
        $nama_produk_benih->nama = $nama_produk;
        $nama_produk_benih->save();

        return response()->json([
            'produk' => $nama_produk_benih->id,
        ], 200);
    }

    // ! submit data into database
    public function submit(Request $request){

        $record = new RecordSurveyStock();
        $record->toko_id = Auth::guard('toko')->user()->id;
        $record->save();

        foreach ($request->allDatas as $data) {
            DetailRecordSurveyStock::create([
                'record_survey_stock_id' => $record->id,
                'nama_produk_id' => $data->id_produk,
                'produsen_benih_id' => $data->id_produsen,
                'jumlah' => $data->input_satuan,
                'satuan_produk_id' => $data->select_satuan,
            ]);
        }

        return response()->json([
            'message'=> 'success create data'
        ], 200);
    }

}
