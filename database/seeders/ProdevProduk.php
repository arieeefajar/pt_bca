<?php

namespace Database\Seeders;

use App\Models\ProdukProdev;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ProdevProduk extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$data = [];

		$page = 4; // total 428 data, interval 50

		for ($i = 1; $i <= $page; $i++) {
			$response = Http::withToken(env('TOKEN_PRODEV'))
				->get(env('PRODEV_END_POINT') . 'produks?page=' . $i)
				->json()['data'];

			foreach ($response as $val) {
				ProdukProdev::create([
					'id_produk' => $val['id'],
					'nama_produk' => $val['nama_produk'],
					'jenis_tanaman' => $val['jns_tanaman'],
				]);
			}
		}
	}
}
