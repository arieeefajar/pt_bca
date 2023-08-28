<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'id',
        'nama_produk',
        'id_jenis_tanaman',
    ];

    public static function getProductCustomer($request)
    {
        $produk = Product::join('custommer_produk', 'produk.id', '=', 'custommer_produk.id_produk')
            ->where('custommer_produk.id_customer', '=', $request->cookie('selectedTokoId'))
            ->select('produk.id', 'produk.nama_produk')
            ->get();

        return $produk;
    }
}
