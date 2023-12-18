<?php

namespace Database\Seeders;

use App\Models\CustomerProdev;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ProdevCustomerSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		$endPoint = env('PRODEV_END_POINT') . 'customers';
		$loopStatus = true;
		while ($loopStatus) {
			$response = Http::withToken(env('TOKEN_PRODEV'))
				->get($endPoint)
				->json();
			$nextPage = $response['next_page_url'];
			$data = $response['data'];

			foreach ($data as $val) {
				CustomerProdev::create([
					'kode_customer' => $val['kode_customer'],
					'provinsi' => $val['provinsi'] === null ? '-' : $val['provinsi'],
					'kota' => $val['kota'] === null ? '-' : $val['kota'],
					'nama_toko' => $val['nama_toko'],
					'tipe_customer' => $val['tipe_customer'],
					'kode_area' => $val['kode_area'],
					'kode_amm' => $val['kode_amm'],
				]);
			}
			!$nextPage ? $loopStatus = false : $endPoint = $nextPage;
		}
	}
}
