<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benih extends Model
{
    use HasFactory;

    protected $table = 'jenis_benih';

    protected $fillable = [
        'id',
        'produk_benih_id',
        'nama',
    ];
}
