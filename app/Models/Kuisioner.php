<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuisioner extends Model
{
    use HasFactory;

    protected $table = 'quisioner';

    protected $fillable = [
        'id',
        'nama',
        'status',
    ];

    public function jenisKuisioners()
    {
        return $this->hasMany(JenisKuisioner::class, 'quisioner_id', 'id');
    }
}
