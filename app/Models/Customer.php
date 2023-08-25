<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';

    protected $fillable = [
        'id',
        'nama',
        'jenis',
        'provinsi',
        'kota',
        'area',
        'amm',
    ];

    public function penyimpanan()
    {
        return $this->hashMany(Penyimpanan::class, 'id', 'perusahaan_id');
    }
}
