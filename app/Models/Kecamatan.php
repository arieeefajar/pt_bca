<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';

    protected $fillable = [
        'id',
        'kota_id',
        'nama',
    ];

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id', 'id');
    }

    public function kelurahan()
    {
        return $this->hashMany(Kelurahan::class, 'id');
    }
}
