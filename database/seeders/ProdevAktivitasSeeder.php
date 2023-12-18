<?php

namespace Database\Seeders;

use App\Models\aktivitasProdev;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ProdevAktivitasSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$endPoint = env('PRODEV_END_POINT') . 'activities';
		$loopStatus = true;
		while ($loopStatus) {
			$response = Http::withToken(env('TOKEN_PRODEV'))
				->get($endPoint)
				->json();
			$nextPage = $response['next_page_url'];
			$data = $response['data'];

			foreach ($data as $val) {
				aktivitasProdev::create([
					'id' => $val['id'] !== null ? $val['id'] : '-',
					'nama_kegiatan' => $val['nama_kegiatan'] !== null ? $val['nama_kegiatan'] : '-',
					'tanggal' => $val['tanggal'] !== null ? $val['tanggal'] : '-',
					'kode_customer' => $val['kode_customer'] !== null ? $val['kode_customer'] : '-',
					'nama_produk' => $val['nama_produk'] !== null ? $val['nama_produk'] : '-',
					'id_produk' => $val['id_produk'] !== null ? $val['id_produk'] : '-',
					'nama_toko' => $val['nama_toko'] !== null ? $val['nama_toko'] : '-',
					'nip' => $val['nip'] !== null ? $val['nip'] : '-',
				]);
			}
			!$nextPage ? $loopStatus = false : $endPoint = $nextPage;
		}
	}
}
