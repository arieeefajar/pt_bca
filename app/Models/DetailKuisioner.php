<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKuisioner extends Model
{
    use HasFactory;

    protected $table = 'detail_quisioner';

    protected $fillable = [
        'id',
        'pertanyaan',
        'jenis_jawaban',
        'jenis_quisioner_id',
        'quisioner_id',
    ];

    public function kuisioner()
    {
        return $this->belongsTo(Kuisioner::class, 'quisioner_id', 'id');
    }

    public function jenisKuisioner()
    {
        return $this->belongsTo(JenisKuisioner::class, 'jenis_quisioner_id', 'id');
    }
}
