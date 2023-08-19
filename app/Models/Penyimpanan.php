<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyimpanan extends Model
{
    use HasFactory;

    protected $table = 'penyimpanan';

    protected $fillable = [
        'surveyor_id',
        'perusahaan_id',
        'status',
    ];
}
