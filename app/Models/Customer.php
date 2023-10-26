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
        'kota_id',
        'koordinat',
    ];

    public function penyimpanan()
    {
        return $this->hasMany(Penyimpanan::class, 'customer_id', 'id');
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id', 'id');
    }

    public static function getNamaToko($id)
    {
        $namaToko = Customer::select('nama')->where('id', $id)->first()->nama;
        return $namaToko;
    }
}
