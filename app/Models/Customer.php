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
        'wilayah_id',
        'koordinat',
    ];

    public function penyimpanan()
    {
        return $this->hashMany(Penyimpanan::class, 'id', 'perusahaan_id');
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah_id', 'id');
    }

    public static function getNamaToko($id)
    {
        $namaToko = Customer::select('nama')->where('id', $id)->first()->nama;
        return $namaToko;
    }
}
