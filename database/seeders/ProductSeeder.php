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

        // betras
        for ($i = 1; $i <= 10; $i++) {
            Product::create(
                [
                    'nama_produk' => 'BETRAS ' . $i,
                    'id_jenis_tanaman' => 2,
                ],
            );
        }

        Product::create(
            ['nama_produk' => 'ASIA 86 F1', 'id_jenis_tanaman' => 1,
            ],
            ['nama_produk' => 'MANISE', 'id_jenis_tanaman' => 1,
            ],
        );
    }
}
