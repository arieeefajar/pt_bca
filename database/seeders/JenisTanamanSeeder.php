<?php

namespace Database\Seeders;

use App\Models\JenisTanaman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisTanamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisTanamanData = [
            [
                'jenis' => 'JAGUNG MANIS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis' => 'JAGUNG HIBRIDA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        JenisTanaman::insert($jenisTanamanData);
    }
}
