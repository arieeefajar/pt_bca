<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRecordSurveyStock extends Model
{
    use HasFactory;

    protected $table = 'detail_record_survey_stock';

    protected $fillable = [
        'id',
        'record_survey_stock_id',
        'nama_produk_id',
        'produsen_benih_id',
        'jumlah',
        'satuan_produk_id',
    ];
}
