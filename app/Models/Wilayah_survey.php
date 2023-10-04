<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah_survey extends Model
{
    use HasFactory;

    protected $table = 'wilayah_survey';

    protected $fillable = ['kota_id', 'surveyor_id', 'start_day', 'end_day'];

    public static function getWilayahSurvey()
    {
        return User::leftJoin(
            'wilayah_survey',
            'users.id',
            '=',
            'wilayah_survey.surveyor_id'
        )
            ->leftJoin('kota', 'wilayah_survey.kota_id', '=', 'kota.id')
            ->select(
                'users.id',
                'users.name',
                'users.nip',
                'users.alamat',
                'users.no_telp',
                'kota.id AS kota_id',
                'kota.nama AS wilayah',
                'kota.provinsi_id'
            )
            ->where('users.role', '=', 'user')
            ->get();
    }
}
