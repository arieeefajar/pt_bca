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
        $pathJson = base_path('database/seeders/dataJson/kelurahan.json');
        $readJson = file_get_contents($pathJson);
        $jsonData = [json_decode($readJson, true)];

        foreach ($jsonData as $provinsi) {
            $dataProvinsi = new Provinsi();
            $dataProvinsi->nama = $provinsi['name'];
            $dataProvinsi->save();

            foreach ($provinsi['kota'] as $kota) {
                $dataKota = new Kota();
                $dataKota->provinsi_id = $dataProvinsi->id;
                $dataKota->nama = $kota['name'];
                $dataKota->save();

                foreach ($kota['kecamatan'] as $kecamatan) {
                    $dataKecamatan = new Kecamatan();
                    $dataKecamatan->kota_id = $dataKota->id;
                    $dataKecamatan->nama = $kecamatan['name'];
                    $dataKecamatan->save();

                    foreach ($kecamatan['kelurahan'] as $kelurahan) {
                        $dataKelurahan = new Kelurahan();
                        $dataKelurahan->kecamatan_id = $dataKecamatan->id;
                        $dataKelurahan->nama = $kelurahan['name'];
                        $dataKelurahan->latitude = $kelurahan['latitude'];
                        $dataKelurahan->longitude = $kelurahan['longtitude'];
                        $dataKelurahan->save();
                    }
                }
            }
        }
    }
}