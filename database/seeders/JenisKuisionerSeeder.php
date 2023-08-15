<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisKuisioner;
use Carbon\Carbon;

class JenisKuisionerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['jenis' => 'Gambaran Umum Situasi Perusahaan', 'quisioner_id' => 2],
            ['jenis' => 'Persaingan diantara Perusahaan', 'quisioner_id' => 2],
            ['jenis' => 'Ancaman Pendatang Baru', 'quisioner_id' => 2],
            ['jenis' => 'Ancaman Produk Substitusi', 'quisioner_id' => 2],
            ['jenis' => 'Kekuatan Menawar Pemasok', 'quisioner_id' => 2],
            ['jenis' => 'Kekuatan Menawar Pembeli', 'quisioner_id' => 2],
            ['jenis' => 'Produk', 'quisioner_id' => 3],
            ['jenis' => 'Distribusi', 'quisioner_id' => 3],
            ['jenis' => 'Pemasaran', 'quisioner_id' => 3],
            ['jenis' => 'Oprasional', 'quisioner_id' => 3],
            ['jenis' => 'Riset dan Pengembangan (R & D)', 'quisioner_id' => 3],
            ['jenis' => 'Keuangan', 'quisioner_id' => 3],
            ['jenis' => 'Organisasi', 'quisioner_id' => 3],
            ['jenis' => 'Kemampuan Manajerial', 'quisioner_id' => 3],
            ['jenis' => 'Kemampuan Inti dan Menyesuaikan Diri dengan Perubahan', 'quisioner_id' => 3],
            ['jenis' => 'Portofolio Pesaing', 'quisioner_id' => 3],
            ['jenis' => 'Lain-lain', 'quisioner_id' => 3],
        ];

        foreach ($data as $value) {
            JenisKuisioner::insert([
                'jenis' => $value['jenis'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'quisioner_id' => $value['quisioner_id']
            ]);
        }
    }
}
