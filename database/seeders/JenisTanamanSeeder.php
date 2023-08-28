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
                'jenis' => 'Jagung Manis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis' => 'Jagung Merah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis' => 'Jagung Unggul',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        JenisTanaman::insert($jenisTanamanData);
    }
}
