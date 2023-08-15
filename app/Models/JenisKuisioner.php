<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKuisioner extends Model
{
    use HasFactory;

    protected $table = 'jenis_quisioner';

    protected $fillable = [
        'id',
        'jenis',
        'quisioner_id'
    ];

    public function detailKuisioner()
    {
        return $this->hashMany(DetailKuisioner::class, 'id', 'jenis_quisioner_id');
    }
}
