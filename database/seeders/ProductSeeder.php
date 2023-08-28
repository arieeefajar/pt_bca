<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produkData = [
            [
                'nama_produk' => 'Phantom Merah',
                'id_jenis_tanaman' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Jamernak',
                'id_jenis_tanaman' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Odin',
                'id_jenis_tanaman' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Product::insert($produkData);
    }
}
