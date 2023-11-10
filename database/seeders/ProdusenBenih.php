<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdusenBenih extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "nama"=> "PT Benih Citra Asia",
            ],
        ];
        foreach ($data as $value) {
            \App\Models\ProdusenBenih::create([
                'nama' => $value['nama'],
            ]);
        }
    }
}
