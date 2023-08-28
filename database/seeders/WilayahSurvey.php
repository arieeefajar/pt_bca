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
                'wilayah_id' => 1,
                'surveyor_id' => 4,
                'start_day' => '2023-08-01 00:00:00',
                'end_day' => '2023-08-05 23:59:59',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'wilayah_id' => 2,
                'surveyor_id' => 5,
                'start_day' => '2023-08-01 00:00:00',
                'end_day' => '2023-08-05 23:59:59',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Wilayah_survey::insert($wilayahSurveyData);
    }
}
