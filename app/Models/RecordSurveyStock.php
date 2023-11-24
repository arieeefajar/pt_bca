<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordSurveyStock extends Model
{
    use HasFactory;

    protected $table = 'record_survey_stock';

    protected $fillable = [
        'id',
        'toko_id',
    ];
}
