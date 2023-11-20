<?php

namespace App\Http\Controllers;

use App\Models\ProdevSales;
use App\Models\TextProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;

class regretionController extends Controller
{
	public $x, //inputted x param
	$y, //inputted y param
	$n, //count of data
	$x2,
	$y2,
	$xy,
	$a,
	$b,
	$all; //forecast y value based on linear regression

	public function index()
	{
		$dataDB = TextProcess::all();
		$dataRegretion = [];

		foreach ($dataDB as $val) {
			$x = json_decode($val['data'])->x;
			$y = json_decode($val['data'])->y;

			$this->x = $x;
			$this->y = $y;
			$this->compute();

			$data = [
				'label' => json_decode($val['data'])->name,
				'data' => $this->all,
			];

			array_push($dataRegretion, $data);
		}

		return response()->json([
			'data' => $dataRegretion,
			'status' => 'success'
		], 200);
	}

	function compute()
	{
		if (is_array($this->x) && is_array($this->y)) {
			if (count($this->x) == count($this->y)) {
				$this->n = count($this->x);

				$this->prepare_calculation();
				$this->ab();
				$this->linear_regression();
			} else {
				throw new Exception('Jumlah data variabel X dan Y harus sama');
			}
		} else {
			throw new Exception('Variabel X atau Y belum didefinisikan');
		}
	}

	public function prepare_calculation()
	{
		//persiapan menghitung x2, y2, dan xy;
		$this->x2 = array_map(function ($n) {
			return $n * $n;
		}, $this->x);
		$this->y2 = array_map(function ($n) {
			return $n * $n;
		}, $this->y);

		for ($i = 0; $i < $this->n; $i++) {
			$this->xy[$i] = $this->x[$i] * $this->y[$i];
		}
	}

	public function ab()
	{
		//mendapat nilai konstanta A dan B
		$a =
			(array_sum($this->y) * array_sum($this->x2) -
				array_sum($this->x) * array_sum($this->xy)) /
			($this->n * array_sum($this->x2) -
				array_sum($this->x) * array_sum($this->x));
		$this->a = $a;

		$b =
			($this->n * array_sum($this->xy) -
				array_sum($this->x) * array_sum($this->y)) /
			($this->n * array_sum($this->x2) -
				array_sum($this->x) * array_sum($this->x));
		$this->b = $b;
	}

	public function forecast($xfore)
	{
		$y = $this->a + $this->b * $xfore;
		return $y;
	}

	public function linear_regression()
	{
		$n = 0;
		foreach ($this->x as $xnew) {
			$this->all[$n] = $this->forecast($xnew);
			$n++;
		}
	}

	function getDataPenjualanProDev()
	{
		$year = '2021';
		$month = 12;
		$finalData = [];

		$dataProduk = ProdevSales::select('nama_produk')
			->distinct()
			->whereYear('tanggal', $year)
			->pluck('nama_produk')
			->toArray();
		foreach ($dataProduk as $value) {
			$finalData[$value] = [];
		}

		foreach ($finalData as $nama_produk => $val) {
			for ($i = 1; $i <= $month; $i++) {
				$data = ProdevSales::where('nama_produk', $nama_produk)
					->whereYear('tanggal', $year)
					->whereMonth('tanggal', $i)
					->get();

				if (!isset($finalData[$nama_produk]['x'])) {
					$finalData[$nama_produk]['x'] = [$i];
				} else {
					array_push($finalData[$nama_produk]['x'], $i);
				}

				if ($data) {
					$total_gram = 0;

					foreach ($data as $gram) {
						$total_gram += floatval($gram->berat);
					}

					if (!isset($finalData[$nama_produk]['y'])) {
						$finalData[$nama_produk]['y'] = [(int) $total_gram];
					} else {
						array_push(
							$finalData[$nama_produk]['y'],
							(int) $total_gram
						);
					}
				} else {
					if (!isset($finalData[$nama_produk]['y'])) {
						$finalData[$nama_produk]['y'] = [0];
					} else {
						array_push($finalData[$nama_produk]['y'], 0);
					}
				}
			}
		}

		return $finalData;
	}

	function dataProcessing()
	{
		TextProcess::truncate();
		$dataRaw = $this->getDataPenjualanProDev();
		foreach ($dataRaw as $key => $value) {
			$dataJson = json_encode([
				'name' => $key,
				'x' => $value['x'],
				'y' => $value['y'],
			]);
			TextProcess::create([
				'data' => $dataJson,
			]);
		}

		return response()->json([
			'message' => 'success process data',
			'status' => 'success',
		], 200);
	}
}
