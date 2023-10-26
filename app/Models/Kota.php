<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;

    protected $table = 'kota';

    protected $fillable = [
        'id',
        'provinsi_id',
        'nama',
    ];

    protected $primaryKey = 'id'; // or null

    public $incrementing = false;

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id', 'id');
    }

    public function customer()
    {
        return $this->hasMany(Customer::class, 'kota_id', 'id');
    }
    public function wilayah_survey(){
        return $this->hasMany(Wilayah_survey::class, 'kota_id', 'id');
    }
}
