<?php

namespace Database\Seeders;

use App\Models\Benih;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BenihSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
        [
            'produk_benih_id' => '1',
            'nama'=> 'Jagung Hibrida',
        ],
        [
            'produk_benih_id' => '2',
            'nama'=> 'Padi Hibrida',
        ],
        [
            'produk_benih_id' => '2',
            'nama'=> 'Padi Inhibrida',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Cabai Besar',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Cabai Rawit',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Cabai Keriting',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Jagung Manis',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Kacang Panjang',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Oyong',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Labu',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Mentimun',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Paria',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Blewah',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Semangaka',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Melon',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Tomat',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Terong',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Labu Air',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Buncis',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Ciplukan',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Okra',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Pepaya',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Waluh',
        ],
        [
            'produk_benih_id' => '3',
            'nama'=> 'Zuccni',
        ],
        [
            'produk_benih_id' => '4',
            'nama'=> 'Selada',
        ],
        [
            'produk_benih_id' => '4',
            'nama'=> 'Sawi Hijau',
        ],
        [
            'produk_benih_id' => '4',
            'nama'=> 'Sawi Pahit',
        ],
        [
            'produk_benih_id' => '4',
            'nama'=> 'Kangkung',
        ],
        [
            'produk_benih_id' => '4',
            'nama'=> 'Bayam',
        ],
        [
            'produk_benih_id' => '4',
            'nama'=> 'Kabocha',
        ],
        [
            'produk_benih_id' => '4',
            'nama'=> 'Kailan',
        ],
        [
            'produk_benih_id' => '4',
            'nama'=> 'Pak Coy',
        ],
        [
            'produk_benih_id' => '4',
            'nama'=> 'Kubis',
        ],
        [
            'produk_benih_id' => '4',
            'nama'=> 'Seledri',
        ],
        [
            'produk_benih_id' => '4',
            'nama'=> 'Bawang Daun',
        ],
        [
            'produk_benih_id' => '4',
            'nama'=> 'Bawang Merah',
        ],
    ];
    foreach ($data as $value) {
        Benih::create([
            'produk_benih_id' => $value['produk_benih_id'],
            'nama' => $value['nama'],
        ]);
    }
    }
}
