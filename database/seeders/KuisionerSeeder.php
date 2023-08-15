<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Kuisioner;
use Carbon\Carbon;

class KuisionerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Schema::enableForeignKeyConstraints();
        // Kuisioner::truncate();
        // Schema::disableForeignKeyConstraints();

        $data = [
            ['nama' => 'Kepuasan Pelanggan', 'status' => '1'],
            ['nama' => 'Analisis Pesaing', 'status' => '1'],
            ['nama' => 'Kekuatan dan Kelemahan Pesaing', 'status' => '1'],
        ];

        foreach ($data as $value) {
            Kuisioner::insert([
                'nama' => $value['nama'],
                'status' => $value['status'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
