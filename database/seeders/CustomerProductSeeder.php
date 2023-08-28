<?php

namespace Database\Seeders;

use App\Models\CustomerProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id_customer' => 1, 'id_produk' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id_customer' => 1, 'id_produk' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id_customer' => 1, 'id_produk' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['id_customer' => 2, 'id_produk' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id_customer' => 2, 'id_produk' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id_customer' => 3, 'id_produk' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['id_customer' => 3, 'id_produk' => 2, 'created_at' => now(), 'updated_at' => now()],
        ];

        CustomerProduct::insert($data);
    }
}
