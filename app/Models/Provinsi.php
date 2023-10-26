<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = 'provinsi';

    protected $fillable = [
        'id',
        'nama',
    ];

    protected $primaryKey = 'id'; // or null

    public $incrementing = false;

    public function kota(){
        return $this->hasMany(Kota::class, 'provinsi_id', 'id');
    }
}
