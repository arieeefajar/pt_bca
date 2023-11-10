<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            KuisionerSeeder::class,
            JenisKuisionerSeeder::class,
            DetailKuisionerSeeder::class,
            UserSeeder::class,
            WilayahSeeder::class,
            CustommerSeeder::class,
            JenisTanamanSeeder::class,
            ProductSeeder::class,
            WilayahSurvey::class,
            Suggestion::class,
            ProdukBenih::class,
            BenihSeeder::class,
            ProdusenBenih::class,
            NamaProdukBenih::class,
            // CustomerProductSeeder::class,
        ]);
    }
}
