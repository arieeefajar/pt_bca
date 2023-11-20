<?php

namespace Database\Seeders;

use App\Models\ProdevSales;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ProdevSalesSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$data = [];

		$page = 428; // total 428 data, interval 50

		for ($i = 401; $i <= $page; $i++) {
			$response = Http::withToken(env('TOKEN_PRODEV'))
				->get(env('PRODEV_END_POINT') . 'sales?page=' . $i)
				->json()['data'];

			foreach ($response as $val) {
				ProdevSales::create([
					'id_transaksi' => $val['id_transaksi'],
					'id_produk' => $val['id_produk'],
					'nama_produk' => $val['nama_produk'],
					'tanggal' => $val['tanggal'],
					'tahun_jual' => $val['tahun_jual'],
					'berat' => $val['berat'],
					'kode_customer' => $val['kode_customer'],
					'nama_toko' => $val['nama_toko'],
				]);
			}

			// foreach ($response as $value) {
			//     array_push($data, $value);
			// }
		}
	}
}
