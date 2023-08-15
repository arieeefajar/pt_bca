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
    ];

    public function get_data_kuisioner($namaQuisioner)
    {

        // select jenis section yang ada berdasarkan nama kuisioner
        $sectionDistinct = JenisKuisioner::select('jenis_quisioner.jenis')
            ->join('detail_quisioner', 'jenis_quisioner.id', '=', 'detail_quisioner.jenis_quisioner_id')
            ->join('quisioner', 'quisioner.id', '=', 'jenis_quisioner.quisioner_id')
            ->where('quisioner.nama', '=', $namaQuisioner)
            ->distinct()
            ->pluck('jenis_quisioner.jenis');

        // membuat wadah array berdasarkan jenis pertanyaan
        $groupBySection = [];
        foreach ($sectionDistinct as $value) {
            $groupBySection[$value] = [];
        }

        // insert data pertanyaan berdasarkan section kuisioner kedalam array berdasarkan jenis pertanyaan
        foreach ($groupBySection as $keyJawaban => $jawaban) {
            $groupByJenis = DetailKuisioner::select(
                'detail_quisioner.id',
                'detail_quisioner.pertanyaan',
                'detail_quisioner.jenis_jawaban',
                'jenis_quisioner.jenis',
                'quisioner.nama'
            )
                ->join('jenis_quisioner', 'jenis_quisioner.id', '=', 'detail_quisioner.jenis_quisioner_id')
                ->join('quisioner', 'quisioner.id', '=', 'jenis_quisioner.quisioner_id')
                ->where('quisioner.nama', $namaQuisioner)
                ->where('jenis_quisioner.jenis', $keyJawaban)
                ->orderBy('jenis_jawaban', 'ASC')
                ->get()
                ->groupBy('jenis_jawaban')
                ->toArray(); // ubah toArray() mejadi toJson() apabila ingin diretun response json

            $groupBySection[$keyJawaban] = $groupByJenis;
        }

        return $groupBySection;
    }

    public function jenisKuisioner()
    {
        return $this->belongsTo(JenisKuisioner::class, 'jenis_quisioner_id', 'id');
    }
}
