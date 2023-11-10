<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamaProdukBenih extends Model
{
    use HasFactory;

    protected $table = 'nama_produk_benih';

    protected $fillable = [
        'id',
        'benih_id',
        'nama',
    ];
}
