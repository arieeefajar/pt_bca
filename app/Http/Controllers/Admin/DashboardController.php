<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailPenyimpanan;
use App\Models\Penyimpanan;
use App\Models\Customer;
use App\Models\ProdukProdev;
use App\Models\Provinsi;
use App\Models\User;
use Carbon\Carbon;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
	public function supperAdmin()
	{
		$dataJumlah = $this->dataForDashboard();
		return view('dashboard.supperAdmin', compact('dataJumlah'));
	}

	public function admin()
	{
		$dataJumlah = $this->dataForDashboard();
		return view('dashboard.admin', compact('dataJumlah'));
	}

	public function executive()
	{
		$dataJumlah = $this->dataForDashboard();
		$jenis_tanaman = ProdukProdev::select('jenis_tanaman')->distinct()->pluck('jenis_tanaman');

		return view('dashboard.executive', compact('dataJumlah', 'jenis_tanaman'));
	}

	public function getDataMaps()
	{

		$endPointApi = env('PYTHON_END_POINT') . 'ai';
		$dataArea = [];

		try {
			$dataAI = [Http::get($endPointApi)->json()['data']][0];

			// dd($dataAI);

			// set key berdasarkan wilayah
			foreach ($dataAI['potential_area_data'] as $value) {
				$dataArea[$value['location']['name']] = [];
			}

			foreach ($dataAI['retail_data'] as $valueAI) {
				foreach ($dataArea as $key => $valueArea) {
					if ($key !== $valueAI['location']['name']) {
						$dataArea[$valueAI['location']['name']] = [];
					}
				}
			}

			foreach ($dataAI['customer_data'] as $valueAI) {
				foreach ($dataArea as $key => $valueArea) {
					if ($key !== $valueAI['location']['name']) {
						$dataArea[$valueAI['location']['name']] = [];
					}
				}
			}

			foreach ($dataAI['competitor_identifier_data'] as $valueAI) {
				foreach ($dataArea as $key => $valueArea) {
					if ($key !== $valueAI['location']['name']) {
						$dataArea[$valueAI['location']['name']] = [];
					}
				}
			}


			// set data berdasarkan wilayah yang sudah di set
			foreach ($dataArea as $keyArea => $valueArea) {
				foreach ($dataAI['potential_area_data'] as $valueAI) {
					if ($keyArea === $valueAI['location']['name']) {
						$dataArea[$keyArea]['potential_area_data'] = array(
							'location' => $valueAI['location'],
							'monthly' => array(
								'data' => $valueAI['monthly'],
								'sentimen' => $this->analisisSentimen($valueAI['monthly'])
							),
							'quarterly' => array(
								'data' => $valueAI['quarterly'],
								'sentimen' => $this->analisisSentimen($valueAI['quarterly'])
							),
							'semesterly' => array(
								'data' => $valueAI['semesterly'],
								'sentimen' => $this->analisisSentimen($valueAI['semesterly'])
							),
							'yearly' => array(
								'data' => $valueAI['yearly'],
								'sentimen' => $this->analisisSentimen($valueAI['yearly'])
							),
						);
					}
				}
			}
			foreach ($dataArea as $keyArea => $valueArea) {
				foreach ($dataAI['retail_data'] as $valueAI) {
					if ($keyArea === $valueAI['location']['name']) {
						$dataArea[$keyArea]['retail_data'] = array(
							'location' => $valueAI['location'],
							'monthly' => array(
								'data' => $valueAI['monthly'],
								'sentimen' => $this->analisisSentimen($valueAI['monthly'])
							),
							'quarterly' => array(
								'data' => $valueAI['quarterly'],
								'sentimen' => $this->analisisSentimen($valueAI['quarterly'])
							),
							'semesterly' => array(
								'data' => $valueAI['semesterly'],
								'sentimen' => $this->analisisSentimen($valueAI['semesterly'])
							),
							'yearly' => array(
								'data' => $valueAI['yearly'],
								'sentimen' => $this->analisisSentimen($valueAI['yearly'])
							),
						);
					}
				}
			}
			foreach ($dataArea as $keyArea => $valueArea) {
				foreach ($dataAI['customer_data'] as $valueAI) {
					if ($keyArea === $valueAI['location']['name']) {
						$dataArea[$keyArea]['customer_data'] = ['location' => $valueAI['location']];
					}
				}
			}
			foreach ($dataArea as $keyArea => $valueArea) {
				foreach ($dataAI['competitor_identifier_data'] as $valueAI) {
					if ($keyArea === $valueAI['location']['name']) {
						$dataArea[$keyArea]['competitor_identifier_data'] = ['location' => $valueAI['location']];
					}
				}
			}

			foreach ($dataArea as $key => $values) {
				foreach ($values as $value) {
					$dataArea[$key]['location'] = $value['location'];
					break;
				}
			}

			// dd($dataArea);

			// $this->analisisSentimen($dataArea['Jember, Jawa Timur']['potential_area_data']['monthly']);
			return response()->json([
				'data' => $dataArea,
			]);
		} catch (\Throwable $th) {
			return response()->json([
				'data' => null,
			]);
		}
	}

	function analisisSentimen($data)
	{
		$korpus = array(
			'positif' => array(
				'baik',
				'tahan',
				'banyak',
				'potensi',
				'manis'
			),
			'netral' => array(
				'musim',
				'panen',
				'produksi',
			),
			'negatif' => array(
				'sedikit',
				'layu',
				'mati',
				'gagal',
				'busuk',
			)
		);

		$TK = [];
		$TKC = array(
			'positif' => [],
			'netral' => [],
			'negatif' => [],
		);

		// found TK & TKC
		foreach ($data as $val) {
			if ($val['word'] !== '<oov>') {
				array_push($TK, $val['count']);

				if (in_array($val['word'], $korpus['positif'])) {
					array_push($TKC['positif'], $val);
					// jika ya potong perulangan
					continue;
				}

				if (in_array($val['word'], $korpus['netral'])) {
					array_push($TKC['netral'], $val);
					continue;
				}

				if (in_array($val['word'], $korpus['negatif'])) {
					array_push($TKC['negatif'], $val);
					continue;
				}
			}
		}

		$TK = array_sum($TK);

		// sum TKC positif
		$sum_positif = [0];
		if (count($TKC['positif']) > 0) {
			foreach ($TKC['positif'] as $val) {
				$CPositif = $val['count'] / $TK;
				array_push($sum_positif, $CPositif);
			}
		}
		$sum_positif = array_sum($sum_positif);

		// sum TKC netral
		$sum_netral = [0];
		if (count($TKC['netral']) > 0) {
			foreach ($TKC['netral'] as $val) {
				$CNetral = $val['count'] / $TK;
				array_push($sum_netral, $CNetral);
			}
		}
		$sum_netral = array_sum($sum_netral);

		// sum TKC netral
		$sum_negatif = [0];
		if (count($TKC['negatif']) > 0) {
			foreach ($TKC['negatif'] as $val) {
				$CNegatif = $val['count'] / $TK;
				array_push($sum_negatif, $CNegatif);
			}
		}
		$sum_negatif = array_sum($sum_negatif);

		$NilaiTerbesar = max($sum_positif, $sum_netral, $sum_negatif);

		switch ($NilaiTerbesar) {
			case $sum_positif:
				$NilaiTerbesar = 'Positif';
				break;

			case $sum_netral:
				$NilaiTerbesar = 'Netral';
				break;

			case $sum_negatif:
				$NilaiTerbesar = 'Negatif';
				break;
		}

		return $NilaiTerbesar;


		// testing
		// $answer = [
		// 	"Tumbuh cepat",
		// 	"Tumbuh cenderung lama, tetapi hasil lebih bagus",
		// 	"Ukuran buah lurus",
		// 	"Sering memberikan diskon"
		// ];

		// $answer = str_replace(",", "", $answer);
		// $answer = implode(" ", $answer);
		// $answer = explode(" ", $answer . '');

		// dd($answer);
	}

	public function dataSurveyor()
	{
		$users = User::whereIn('role', ['user'])
			->orderBy('role', 'asc')
			->get();
		return view('admin.dataSurveyor', compact('users'));
	}

	public function dataExecutive()
	{
		$users = User::whereIn('role', ['executive'])
			->orderBy('created_at', 'desc')
			->get();
		return view('admin.dataExecutive', compact('users'));
	}

	public function dataAdmin()
	{
		$users = User::whereIn('role', ['admin'])
			->orderBy('created_at', 'asc')
			->get();
		return view('admin.dataAdmin', compact('users'));
	}

	public function dataTargetToko()
	{
		// Mendapatkan tanggal awal bulan ini
		$startDate = Carbon::now()->startOfMonth()->format('Y-m-d') . ' 00:00:00';
		// Mendapatkan tanggal akhir bulan ini
		$endDate = Carbon::now()->endOfMonth()->format('Y-m-d') . ' 23:59:59';

		$dataPerusahaan = Customer::with('kota', 'kota.provinsi')->get();

		foreach ($dataPerusahaan as $key => $value) {
			$penyimpanan = Penyimpanan::with('surveyor')->whereBetween('created_at', [$startDate, $endDate])->where('customer_id', $value->id)->get();
			$detailPenyimpanan = [];
			foreach ($penyimpanan as $value) {
				$detailPenyimpanan = DetailPenyimpanan::where('penyimpanan_id', $value->id)->first();
				if ($detailPenyimpanan) {
					$penyimpanan = Penyimpanan::with('surveyor')->whereBetween('created_at', [$startDate, $endDate])->where('id', $detailPenyimpanan->penyimpanan_id)->first();
					// dd($penyimpanan);
					break;
				}
			}
			if ($detailPenyimpanan) {
				if ($penyimpanan->status != 2) {
					$dataPerusahaan[$key]->status = 1;
					$dataPerusahaan[$key]->surveyor = $penyimpanan->surveyor->name;
				} else {
					$dataPerusahaan[$key]->status = 2;
					$dataPerusahaan[$key]->surveyor = $penyimpanan->surveyor->name;
				}
			} else {
				$dataPerusahaan[$key]->status = 3;
				$dataPerusahaan[$key]->surveyor = '-';
			}
		}
		return view('admin.dataTargetToko', compact('dataPerusahaan'));
	}

	public function dataSurveyToko()
	{
		// Mendapatkan tanggal awal bulan ini
		$startDate = Carbon::now()->startOfMonth()->format('Y-m-d') . ' 00:00:00';
		// Mendapatkan tanggal akhir bulan ini
		$endDate = Carbon::now()->endOfMonth()->format('Y-m-d') . ' 23:59:59';

		$dataPerusahaan = Customer::with('kota', 'kota.provinsi')->get();

		foreach ($dataPerusahaan as $key => $value) {
			$penyimpanan = Penyimpanan::with('surveyor')->whereBetween('created_at', [$startDate, $endDate])->where('customer_id', $value->id)->get();
			$detailPenyimpanan = [];
			foreach ($penyimpanan as $value) {
				$detailPenyimpanan = DetailPenyimpanan::where('penyimpanan_id', $value->id)->first();
				if ($detailPenyimpanan) {
					$penyimpanan = Penyimpanan::with('surveyor')->whereBetween('created_at', [$startDate, $endDate])->where('id', $detailPenyimpanan->penyimpanan_id)->first();
					// dd($penyimpanan);
					break;
				}
			}
			if ($detailPenyimpanan) {
				if ($penyimpanan->status != 2) {
					$dataPerusahaan[$key]->status = 1;
					$dataPerusahaan[$key]->surveyor = $penyimpanan->surveyor->name;
				} else {
					$dataPerusahaan[$key]->status = 2;
					$dataPerusahaan[$key]->surveyor = $penyimpanan->surveyor->name;
				}
			} else {
				$dataPerusahaan[$key]->status = 3;
				$dataPerusahaan[$key]->surveyor = '-';
			}
		}
		// dd($dataPerusahaan);
		return view('admin.dataSurveyToko', compact('dataPerusahaan'));
	}

	public function profileAdmin()
	{
		return view('admin.profile');
	}

	function dataForDashboard()
	{
		// Mendapatkan tanggal awal bulan ini
		$startDate = Carbon::now()->startOfMonth()->format('Y-m-d') . ' 00:00:00';
		// Mendapatkan tanggal akhir bulan ini
		$endDate = Carbon::now()->endOfMonth()->format('Y-m-d') . ' 23:59:59';

		$tokoBlmSelesai = function ($startDate, $endDate) {
			$dataPerusahaan = Customer::with('kota', 'kota.provinsi')->get();
			$finalCount = [];

			foreach ($dataPerusahaan as $key => $value) {
				$penyimpanan = Penyimpanan::with('surveyor')->whereBetween('created_at', [$startDate, $endDate])->where('customer_id', $value->id)->get();
				$detailPenyimpanan = [];
				foreach ($penyimpanan as $value) {
					$detailPenyimpanan = DetailPenyimpanan::where('penyimpanan_id', $value->id)->first();
					if ($detailPenyimpanan) {
						$penyimpanan = Penyimpanan::with('surveyor')->whereBetween('created_at', [$startDate, $endDate])->where('id', $detailPenyimpanan->penyimpanan_id)->first();
						break;
					}
				}
				if ($detailPenyimpanan && $penyimpanan->status == 2) {
					array_push($finalCount, $value);
				}
			}

			return count($finalCount);
		};

		$dataJumlah = [
			'surveyor' => User::where('role', 'user')->get()->count(),
			'executive' => User::where('role', 'executive')->get()->count(),
			'admin' => User::where('role', 'admin')->get()->count(),
			'targetToko' => Customer::all()->count(),

			'targetTokoBlmSelesai' => $tokoBlmSelesai($startDate, $endDate),

			'targetTokoSelesai' => Customer::join('penyimpanan', 'customer.id', '=', 'penyimpanan.customer_id')
				->where('penyimpanan.status', 1)
				->whereBetween('penyimpanan.created_at', [$startDate, $endDate])
				->select('customer.nama')
				->get()
				->count(),
		];

		return $dataJumlah;
	}
}
