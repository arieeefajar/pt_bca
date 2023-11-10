<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ProdukBenih extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
        [
            'nama' =>'Jagung',
            'jenis'=> 'pangan',
        ],
        [
            'nama' =>'Padi',
            'jenis'=> 'pangan',
        ],
        [
            'nama' =>'Buah Semusim',
            'jenis'=> 'horti',
        ],
        [
            'nama' =>'Sayur Semusim',
            'jenis'=> 'horti',
        ],
        [
            'nama' =>'Bunga',
            'jenis'=> 'horti',
        ],
    ];

    foreach ($data as $value) {
        \App\Models\ProdukBenih::create([
            'nama' => $value['nama'],
            'jenis' => $value['jenis'],
        ]);
    }
    }
}
