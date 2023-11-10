<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukBenih extends Model
{
    use HasFactory;

    protected $table = 'produk_benih';

    protected $fillable = [
        'id',
        'nama',
        'jenis',
    ];
}
