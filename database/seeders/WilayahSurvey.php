<?php

namespace Database\Seeders;

use App\Models\Wilayah_survey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WilayahSurvey extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wilayahSurveyData = [
            [
                'kota_id' => 3509,
                'surveyor_id' => 42,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Wilayah_survey::insert($wilayahSurveyData);
    }
}
