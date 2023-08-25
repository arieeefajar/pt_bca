<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTanaman extends Model
{
    use HasFactory;

    protected $table = 'jenis_tanaman';

    protected $fillable = [
        'id',
        'jenis',
    ];
}
