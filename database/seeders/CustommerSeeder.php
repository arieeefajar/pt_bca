<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustommerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customerData = [
            [
                'nama' => 'Maju jaya',
                'jenis' => 'dealer',
                'kota_id' => 3509,
                'koordinat' => '-7.2575, 112.7521',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Raja bibit',
                'jenis' => 'dealer',
                'kota_id' => 3509,
                'koordinat' => '-7.2575, 112.7530',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Sahabat Petani',
                'jenis' => 'master_dealer',
                'kota_id' => 3509,
                'koordinat' => '-8.1724, 113.7005',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Customer::insert($customerData);
    }
}
