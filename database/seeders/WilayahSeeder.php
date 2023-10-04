<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Kota;
use App\Models\Provinsi;
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

        // provinsi
        $pathJson = base_path('database/seeders/dataJson/provinces.json');
        $readJson = file_get_contents($pathJson);
        $jsonData = [json_decode($readJson, true)];

        foreach ($jsonData[0] as $provinsi) {
            Provinsi::create([
                'id' => $provinsi['id'],
                'nama' => $provinsi['name']
            ]);
        }

        // kota
        $pathJson = base_path('database/seeders/dataJson/regencies.json');
        $readJson = file_get_contents($pathJson);
        $jsonData = [json_decode($readJson, true)];

        foreach ($jsonData[0] as $kota) {
            Kota::create([
                'id' => $kota['id'],
                'provinsi_id' => $kota['province_id'],
                'nama' => $kota['name']
            ]);
        }
    }
}