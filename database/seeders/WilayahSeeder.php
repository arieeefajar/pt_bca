<?php

namespace Database\Seeders;

use App\Models\Wilayah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wilayahData = [
            [
                'nama' => 'Wilayah A',
                'koordinat' => 'Koordinat A',
            ],
            [
                'nama' => 'Wilayah B',
                'koordinat' => 'Koordinat B',

            ],
        ];

        foreach ($wilayahData as $value) {
            Wilayah::create([
                'nama' => $value['nama'],
                'koordinat' => $value['koordinat']
            ]);
        }
    }
}
