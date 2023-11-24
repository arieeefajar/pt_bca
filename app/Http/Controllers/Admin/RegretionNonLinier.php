<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TextProcess;
use Illuminate\Http\Request;

class RegretionNonLinier extends Controller
{
	public function index($category = 'JAGUNG HIBRIDA')
	{
		$dataDB = TextProcess::with('produkProdev')
			->whereHas('produkProdev', function ($query) use ($category) {
				$query->where('jenis_tanaman', $category);
				// $query->where('id_produk', '50');
			})
			->get();

		$dataRegretion = [];

		foreach ($dataDB as $val_data) {
			$dataJson = json_decode($val_data->data);
			$x = $dataJson->x;
			$y = $dataJson->y;

			// convert g to kg
			$y_kg = [];
			for ($i = 0; $i < count($y); $i++) {
				$tmp = $y[$i] / 1000;
				array_push($y_kg, $tmp);
			}
			$y = $y_kg;

			$xy = [];
			$x_square = [];
			$x_square_times_y = [];
			$x_to_the_power_of_3 = [];
			$x_to_the_power_of_4 = [];

			for ($i = 0; $i < count($x); $i++) {
				$x_tmp = $x[$i];
				$y_tmp = $y[$i];
				$time = $x_tmp * $y_tmp;

				array_push($xy, $time);
				array_push($x_square, $x_tmp * $x_tmp);
				array_push($x_square_times_y, ($x_tmp * $x_tmp) * $y_tmp);
				array_push($x_to_the_power_of_3, $x_tmp * $x_tmp * $x_tmp);
				array_push($x_to_the_power_of_4, $x_tmp * $x_tmp * $x_tmp * $x_tmp);
			}

			$sum_x = array_sum($x);
			$sum_y = array_sum($y);
			$sum_xy = array_sum($xy);
			$sum_x_square = array_sum($x_square);
			$sum_x_square_times_y = array_sum($x_square_times_y);
			$sum_x_to_the_power_of_3 = array_sum($x_to_the_power_of_3);
			$sum_x_to_the_power_of_4 = array_sum($x_to_the_power_of_4);

			// determinant
			$A1 = count($x);
			$A2 = $sum_x;
			$A3 = $sum_x_square;

			$B1 = $sum_x;
			$B2 = $sum_x_square;
			$B3 = $sum_x_to_the_power_of_3;

			$C1 = $sum_x_square;
			$C2 = $sum_x_to_the_power_of_3;
			$C3 = $sum_x_to_the_power_of_4;

			// determinant 1
			$A1_1 = $sum_y;
			$A1_2 = $sum_xy;
			$A1_3 = $sum_x_square_times_y;

			$B1_1 = $sum_x;
			$B1_2 = $sum_x_square;
			$B1_3 = $sum_x_to_the_power_of_3;

			$C1_1 = $sum_x_square;
			$C1_2 = $sum_x_to_the_power_of_3;
			$C1_3 = $sum_x_to_the_power_of_4;

			// determinant 2
			$A2_1 = count($x);
			$A2_2 = $sum_x;
			$A2_3 = $sum_x_square;

			$B2_1 = $sum_y;
			$B2_2 = $sum_xy;
			$B2_3 = $sum_x_square_times_y;

			$C2_1 = $sum_x_square;
			$C2_2 = $sum_x_to_the_power_of_3;
			$C2_3 = $sum_x_to_the_power_of_4;

			// determinant 3
			$A3_1 = count($x);
			$A3_2 = $sum_x;
			$A3_3 = $sum_x_square;

			$B3_1 = $sum_x;
			$B3_2 = $sum_x_square;
			$B3_3 = $sum_x_to_the_power_of_3;

			$C3_1 = $sum_y;
			$C3_2 = $sum_xy;
			$C3_3 = $sum_x_square_times_y;

			// Formula => A1*(B2*C3-B3*C2) + A2*(B3*C1-B1*C3) + A3*(B1*C2-B2*C1)
			$determinant = $A1 * (($B2 * $C3) - ($B3 * $C2)) + $A2 * (($B3 * $C1) - ($B1 * $C3)) + $A3 * (($B1 * $C2) - ($B2 * $C1));
			$determinant1 = $A1_1 * (($B1_2 * $C1_3) - ($B1_3 * $C1_2)) + $A1_2 * (($B1_3 * $C1_1) - ($B1_1 * $C1_3)) + $A1_3 * (($B1_1 * $C1_2) - ($B1_2 * $C1_1));
			$determinant2 = $A2_1 * (($B2_2 * $C2_3) - ($B2_3 * $C2_2)) + $A2_2 * (($B2_3 * $C2_1) - ($B2_1 * $C2_3)) + $A2_3 * (($B2_1 * $C2_2) - ($B2_2 * $C2_1));
			$determinant3 = $A3_1 * (($B3_2 * $C3_3) - ($B3_3 * $C3_2)) + $A3_2 * (($B3_3 * $C3_1) - ($B3_1 * $C3_3)) + $A3_3 * (($B3_1 * $C3_2) - ($B3_2 * $C3_1));

			$a = $determinant1 / $determinant;
			$b = $determinant2 / $determinant;
			$c = $determinant3 / $determinant;

			$y_predictions = [];
			$y_predictions_next_year = [];

			for ($i = 0; $i < count($x); $i++) {
				$tmp = $a + ($b * $x[$i]) + ($c * ($x[$i] * $x[$i]));
				array_push($y_predictions, $tmp);
			}
			for ($i = 0; $i < count($x); $i++) {
				$tmp = $a + ($b * ($x[$i] + 12)) + ($c * (($x[$i] + 12) * ($x[$i] + 12)));
				array_push($y_predictions_next_year, $tmp);
			}

			$data = [
				'label' => $dataJson->name,
				'data' => $y_predictions,
				'data_next_year' => $y_predictions_next_year,
				// 'data_raw' => $y,
			];

			array_push($dataRegretion, $data);
		}
		return response()->json([
			'data' => $dataRegretion,
			'status' => 'success'
		], 200);
	}
}
