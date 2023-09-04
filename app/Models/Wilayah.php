<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Wilayah extends Model
{
    use HasFactory;

    protected $table = 'wilayah';

    protected $fillable = [
        'id',
        'nama',
        'koordinat',
    ];

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
