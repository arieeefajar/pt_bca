<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah_survey extends Model
{
    use HasFactory;

    protected $table = 'wilayah_survey';

    protected $fillable = [
        'wilayah_id',
        'surveyor_id',
        'start_day',
        'end_day',
    ];
}
