<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Kelurahan extends Model
{
    use HasFactory;

    protected $table = 'kelurahan';

    protected $fillable = [
        'id',
        'kecamatan_id',
        'nama',
        'latitude',
        'langitude',
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
    }

    public function customer()
    {
        return $this->hashMany(Customer::class, 'id', 'wilayah_id');
    }

    public static function getProvinsi()
    {
        $endPointApi = 'https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json';
        $dataAnswer = Http::get($endPointApi)->json();
        return $dataAnswer;
    }

    public static function getKota()
    {
        $endPointApi = 'https://emsifa.github.io/api-wilayah-indonesia/api/regencies/35.json';
        $dataAnswer = Http::get($endPointApi)->json();
        return $dataAnswer;
    }
}