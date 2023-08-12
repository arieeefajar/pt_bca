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

    public function detailKuisioner()
    {
        return $this->hashMany(DetailKuisioner::class, 'id', 'quisioner_id');
    }
}
