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

    public function get_data_kuisioner_analisis_pesaing()
    {
        $namaQuisioner = 'Analisis Kompetitor';

        $detailKuisionerData = DetailKuisioner::select(
            'detail_quisioner.id',
            'detail_quisioner.pertanyaan',
            'detail_quisioner.jenis_jawaban',
            'jenis_quisioner.jenis',
            'quisioner.nama'
        )
            ->rightJoin('jenis_quisioner', 'jenis_quisioner.id', '=', 'detail_quisioner.jenis_quisioner_id')
            ->leftJoin('quisioner', 'quisioner.id', '=', 'detail_quisioner.quisioner_id')
            ->where('quisioner.nama', $namaQuisioner)
            ->get()
            ->groupBy('jenis')
            ->toArray(); // ubah toArray() mejadi toJson() apabila ingin diretun response json

        return $detailKuisionerData;
    }

    public function kuisioner()
    {
        return $this->belongsTo(Kuisioner::class, 'quisioner_id', 'id');
    }

    public function jenisKuisioner()
    {
        return $this->belongsTo(JenisKuisioner::class, 'jenis_quisioner_id', 'id');
    }
}
