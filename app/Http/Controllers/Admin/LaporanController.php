<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kuisioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LaporanController extends Controller
{
    public function index()
    {
        $dataKuisioner = Kuisioner::all();
        return view('admin.laporan', compact('dataKuisioner'));
    }

    public function jawaban_kuisioner($type)
    {
        $endPointApi = env('PYTHON_END_POINT') . $type;
        $dataAnswer = collect([Http::get($endPointApi)->json()])[0]['data'];

        $product = [];
        $promosi = [];
        $kualitas_produk = [];
        $layanan_petugas_lapang = [];
        $penanganan_komplain = [];

        $allowedKeysProduct = [
            'information',
            'price_comparison',
            'variety_previlege',
            'packaging_view',
            'getting_easy',
            'satisfaction',
            'image_view',
        ];
        $allowedKeysPromosi = [
            'material_amount',
            'promotion_quantity',
            'promotion_quality',
        ];
        $allowedKeysKualitas = [
            'seed_purity',
            'vigor',
            'growing_power',
            'genetic_purity',
            'pest_resistance',
            'suitablelity_image_result',
            'suitablelity_result_request',
            'satisfaction_result',
        ];
        $allowedKeysLayanan = [
            'technical_ability',
            'visit_intensity',
            'communication_intensity',
            'skill_credibility',
            'influence_of_officer',
            'communication_skill',
        ];
        $allowedKeysKomplain = [
            'verification_speed',
            'completion_speed',
            'handling',
        ];

        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysProduct)) {
                    array_push($product, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysPromosi)) {
                    array_push($promosi, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysKualitas)) {
                    array_push($kualitas_produk, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysLayanan)) {
                    array_push($layanan_petugas_lapang, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysKomplain)) {
                    array_push($penanganan_komplain, $value2);
                }
            }
        }

        // penilaian pelanggan
        $product = $this->countValues($product);
        $promosi = $this->countValues($promosi);
        $kualitas_produk = $this->countValues($kualitas_produk);
        $layanan_petugas_lapang = $this->countValues($layanan_petugas_lapang);
        $penanganan_komplain = $this->countValues($penanganan_komplain);

        $product['total'] = array_sum($product);
        $promosi['total'] = array_sum($promosi);
        $kualitas_produk['total'] = array_sum($kualitas_produk);
        $layanan_petugas_lapang['total'] = array_sum($layanan_petugas_lapang);
        $penanganan_komplain['total'] = array_sum($penanganan_komplain);

        // index kepuasan

        //! product
        $product_index = [
            '1' => isset($product['1']) ? $product['1'] * 1 : 0,
            '2' => isset($product['2']) ? $product['2'] * 2 : 0,
            '3' => isset($product['3']) ? $product['3'] * 3 : 0,
            '4' => isset($product['4']) ? $product['4'] * 4 : 0,
            '5' => isset($product['5']) ? $product['5'] * 5 : 0,
        ];
        $product_index['total'] = array_sum($product_index);
        $product_index['index'] = number_format($product_index['total'] / $product['total'], 2, '.', '');
        $value5 = isset($product['5']) ? $product['5'] : 0;
        $value4 = isset($product['4']) ? $product['4'] : 0;
        $value3 = isset($product['3']) ? $product['3'] : 0;
        $product_index['kepuasan'] = number_format(($value5+$value4+$value3) / $product['total'], 2, '.', '').'%';

        //! promosi
        $promosi_index = [
            '1' => isset($promosi['1']) ? $promosi['1'] * 1 : 0,
            '2' => isset($promosi['2']) ? $promosi['2'] * 2 : 0,
            '3' => isset($promosi['3']) ? $promosi['3'] * 3 : 0,
            '4' => isset($promosi['4']) ? $promosi['4'] * 4 : 0,
            '5' => isset($promosi['5']) ? $promosi['5'] * 5 : 0,
        ];
        $promosi_index['total'] = array_sum($promosi_index);
        $promosi_index['index'] = number_format($promosi_index['total'] / $promosi['total'], 2, '.', '');
        $value5 = isset($promosi['5']) ? $promosi['5'] : 0;
        $value4 = isset($promosi['4']) ? $promosi['4'] : 0;
        $value3 = isset($promosi['3']) ? $promosi['3'] : 0;
        $promosi_index['kepuasan'] = number_format(($value5+$value4+$value3) / $promosi['total'], 2, '.', '').'%';

        //! kualitas_produk
        $kualitas_produk_index = [
            '1' => isset($kualitas_produk['1']) ? $kualitas_produk['1'] * 1 : 0,
            '2' => isset($kualitas_produk['2']) ? $kualitas_produk['2'] * 2 : 0,
            '3' => isset($kualitas_produk['3']) ? $kualitas_produk['3'] * 3 : 0,
            '4' => isset($kualitas_produk['4']) ? $kualitas_produk['4'] * 4 : 0,
            '5' => isset($kualitas_produk['5']) ? $kualitas_produk['5'] * 5 : 0,
        ];
        $kualitas_produk_index['total'] = array_sum($kualitas_produk_index);
        $kualitas_produk_index['index'] = number_format($kualitas_produk_index['total'] / $kualitas_produk['total'], 2, '.', '');
        $value5 = isset($kualitas_produk['5']) ? $kualitas_produk['5'] : 0;
        $value4 = isset($kualitas_produk['4']) ? $kualitas_produk['4'] : 0;
        $value3 = isset($kualitas_produk['3']) ? $kualitas_produk['3'] : 0;
        $kualitas_produk_index['kepuasan'] = number_format(($value5+$value4+$value3) / $kualitas_produk['total'], 2, '.', '').'%';
        
        //! layanan_petugas_lapang
        $layanan_petugas_lapang_index = [
            '1' => isset($layanan_petugas_lapang['1']) ? $layanan_petugas_lapang['1'] * 1 : 0,
            '2' => isset($layanan_petugas_lapang['2']) ? $layanan_petugas_lapang['2'] * 2 : 0,
            '3' => isset($layanan_petugas_lapang['3']) ? $layanan_petugas_lapang['3'] * 3 : 0,
            '4' => isset($layanan_petugas_lapang['4']) ? $layanan_petugas_lapang['4'] * 4 : 0,
            '5' => isset($layanan_petugas_lapang['5']) ? $layanan_petugas_lapang['5'] * 5 : 0,
        ];
        $layanan_petugas_lapang_index['total'] = array_sum($layanan_petugas_lapang_index);
        $layanan_petugas_lapang_index['index'] = number_format($layanan_petugas_lapang_index['total'] / $layanan_petugas_lapang['total'], 2, '.', '');
        $value5 = isset($layanan_petugas_lapang['5']) ? $layanan_petugas_lapang['5'] : 0;
        $value4 = isset($layanan_petugas_lapang['4']) ? $layanan_petugas_lapang['4'] : 0;
        $value3 = isset($layanan_petugas_lapang['3']) ? $layanan_petugas_lapang['3'] : 0;
        $layanan_petugas_lapang_index['kepuasan'] = number_format(($value5+$value4+$value3) / $layanan_petugas_lapang['total'], 2, '.', '').'%';

        //! penanganan_komplain
        $penanganan_komplain_index = [
            '1' => isset($penanganan_komplain['1']) ? $penanganan_komplain['1'] * 1 : 0,
            '2' => isset($penanganan_komplain['2']) ? $penanganan_komplain['2'] * 2 : 0,
            '3' => isset($penanganan_komplain['3']) ? $penanganan_komplain['3'] * 3 : 0,
            '4' => isset($penanganan_komplain['4']) ? $penanganan_komplain['4'] * 4 : 0,
            '5' => isset($penanganan_komplain['5']) ? $penanganan_komplain['5'] * 5 : 0,
        ];
        $penanganan_komplain_index['total'] = array_sum($penanganan_komplain_index);
        $penanganan_komplain_index['index'] = number_format($penanganan_komplain_index['total'] / $penanganan_komplain['total'], 2, '.', '');
        $value5 = isset($penanganan_komplain['5']) ? $penanganan_komplain['5'] : 0;
        $value4 = isset($penanganan_komplain['4']) ? $penanganan_komplain['4'] : 0;
        $value3 = isset($penanganan_komplain['3']) ? $penanganan_komplain['3'] : 0;
        $penanganan_komplain_index['kepuasan'] = number_format(($value5+$value4+$value3) / $penanganan_komplain['total'], 2, '.', '').'%';

        return response()->json([
            'penilaian_pelanggan' => [
                'product' => $product,
                'promosi' => $promosi,
                'kualitas_produk' => $kualitas_produk,
                'layanan_petugas_lapang' => $layanan_petugas_lapang,
                'penanganan_komplain' => $penanganan_komplain,
            ],
            'perhitungan_index_aspek' => [
                'product' => $product_index,
                'promosi' => $promosi_index,
                'kualitas_produk' => $kualitas_produk_index,
                'layanan_petugas_lapang' => $layanan_petugas_lapang_index,
                'penanganan_komplain' => $penanganan_komplain_index,
            ],
        ]);
    }

    function countValues($array)
    {
        $valueCounts = [];

        foreach ($array as $value) {
            if (array_key_exists($value, $valueCounts)) {
                $valueCounts[$value]++;
            } else {
                $valueCounts[$value] = 1;
            }
        }

        return $valueCounts;
    }
}
