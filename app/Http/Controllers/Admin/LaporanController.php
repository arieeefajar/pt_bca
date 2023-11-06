<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan');
    }

    public function getKategoriKepuasan($category)
    {
        if ($category == 'customer') {
            return response()->json([
                'data' => [
                    'product',
                    'promosi',
                    'kualitas',
                    'layanan',
                    'penanganan'
                ]
            ]);
        }
    }

    public function getPertanyaanKepuasan($category, $area)
    {
        $location_name = base64_decode($area);
        $endPointApi = env('PYTHON_END_POINT') . 'ai';
        $dataAnswer = [];

        try {
            $dataAI = [Http::get($endPointApi)->json()['data']][0];

            // set customer data berdasarkan daerah sesuai parameter
            foreach ($dataAI['customer_data'] as $value) {
                if ($value['location']['name'] === $location_name) {
                    $dataAnswer = $value['answer'];
                    break;
                }
            }

            $dataAllKategory = $this->kepuasanDaerah($dataAnswer);

            if ($category == 'product') {
                $information = [];
                $price_comparison = [];
                $variety_previlege = [];
                $packaging_view = [];
                $getting_easy = [];
                $satisfaction = [];
                $image_view = [];

                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'information') {
                            array_push($information, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'price_comparison') {
                            array_push($price_comparison, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'variety_previlege') {
                            array_push($variety_previlege, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'packaging_view') {
                            array_push($packaging_view, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'getting_easy') {
                            array_push($getting_easy, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'satisfaction') {
                            array_push($satisfaction, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'image_view') {
                            array_push($image_view, $value2);
                        }
                    }
                }

                $dataTotalAllKategory =
                    $dataAllKategory['penilaian_pelanggan']['product']['total'];

                $information = $this->countValues($information);
                $price_comparison = $this->countValues($price_comparison);
                $variety_previlege = $this->countValues($variety_previlege);
                $packaging_view = $this->countValues($packaging_view);
                $getting_easy = $this->countValues($getting_easy);
                $satisfaction = $this->countValues($satisfaction);
                $image_view = $this->countValues($image_view);

                $information5 = isset($information['5'])
                    ? $information['5']
                    : 0;
                $information4 = isset($information['4'])
                    ? $information['4']
                    : 0;
                $information3 = isset($information['3'])
                    ? $information['3']
                    : 0;
                $information['kepuasan'] =
                    number_format(
                        (($information5 + $information4 + $information3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $price_comparison5 = isset($price_comparison['5'])
                    ? $price_comparison['5']
                    : 0;
                $price_comparison4 = isset($price_comparison['4'])
                    ? $price_comparison['4']
                    : 0;
                $price_comparison3 = isset($price_comparison['3'])
                    ? $price_comparison['3']
                    : 0;
                $price_comparison['kepuasan'] =
                    number_format(
                        (($price_comparison5 +
                            $price_comparison4 +
                            $price_comparison3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $variety_previlege5 = isset($variety_previlege['5'])
                    ? $variety_previlege['5']
                    : 0;
                $variety_previlege4 = isset($variety_previlege['4'])
                    ? $variety_previlege['4']
                    : 0;
                $variety_previlege3 = isset($variety_previlege['3'])
                    ? $variety_previlege['3']
                    : 0;
                $variety_previlege['kepuasan'] =
                    number_format(
                        (($variety_previlege5 +
                            $variety_previlege4 +
                            $variety_previlege3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $packaging_view5 = isset($packaging_view['5'])
                    ? $packaging_view['5']
                    : 0;
                $packaging_view4 = isset($packaging_view['4'])
                    ? $packaging_view['4']
                    : 0;
                $packaging_view3 = isset($packaging_view['3'])
                    ? $packaging_view['3']
                    : 0;
                $packaging_view['kepuasan'] =
                    number_format(
                        (($packaging_view5 +
                            $packaging_view4 +
                            $packaging_view3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $getting_easy5 = isset($getting_easy['5'])
                    ? $getting_easy['5']
                    : 0;
                $getting_easy4 = isset($getting_easy['4'])
                    ? $getting_easy['4']
                    : 0;
                $getting_easy3 = isset($getting_easy['3'])
                    ? $getting_easy['3']
                    : 0;
                $getting_easy['kepuasan'] =
                    number_format(
                        (($getting_easy5 + $getting_easy4 + $getting_easy3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $satisfaction5 = isset($satisfaction['5'])
                    ? $satisfaction['5']
                    : 0;
                $satisfaction4 = isset($satisfaction['4'])
                    ? $satisfaction['4']
                    : 0;
                $satisfaction3 = isset($satisfaction['3'])
                    ? $satisfaction['3']
                    : 0;
                $satisfaction['kepuasan'] =
                    number_format(
                        (($satisfaction5 + $satisfaction4 + $satisfaction3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $image_view5 = isset($image_view['5']) ? $image_view['5'] : 0;
                $image_view4 = isset($image_view['4']) ? $image_view['4'] : 0;
                $image_view3 = isset($image_view['3']) ? $image_view['3'] : 0;
                $image_view['kepuasan'] =
                    number_format(
                        (($image_view5 + $image_view4 + $image_view3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $dataSend = [
                    'Kelengkapan informasi pada kemasan' => $information['kepuasan'],
                    'Harga Produk dibanding dengan kompetitor' => $price_comparison['kepuasan'],
                    'Keunggulan Varietas dibanding kompetitor' => $variety_previlege['kepuasan'],
                    'Tampilan kemasan produk' => $packaging_view['kepuasan'],
                    'Kemudahan dalam memperoleh / membeli Produk' => $getting_easy['kepuasan'],
                    'Kepuasan memilih produk' => $satisfaction['kepuasan'],
                    'Tampilan gambar pada kemasan produk' => $image_view['kepuasan'],
                ];

                foreach ($dataSend as $key => $val) {
                    $dataSend[$key] = $this->roundNumber(floatval($dataSend[$key] * count($dataSend)));
                }

                $dataSend = $this->customSort($dataSend);
                return response()->json([
                    [
                        'Kepuasan' => (float) $dataAllKategory['perhitungan_index_aspek']['product']['kepuasan'] * 100,
                    ],
                    $dataSend
                ]);
            }

            if ($category == 'promosi') {
                $material_amount = [];
                $promotion_quantity = [];
                $promotion_quality = [];

                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'material_amount') {
                            array_push($material_amount, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'promotion_quantity') {
                            array_push($promotion_quantity, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'promotion_quality') {
                            array_push($promotion_quality, $value2);
                        }
                    }
                }

                $dataTotalAllKategory =
                    $dataAllKategory['penilaian_pelanggan']['promosi']['total'];

                $material_amount = $this->countValues($material_amount);
                $promotion_quantity = $this->countValues($promotion_quantity);
                $promotion_quality = $this->countValues($promotion_quality);

                $material_amount5 = isset($material_amount['5'])
                    ? $material_amount['5']
                    : 0;
                $material_amount4 = isset($material_amount['4'])
                    ? $material_amount['4']
                    : 0;
                $material_amount3 = isset($material_amount['3'])
                    ? $material_amount['3']
                    : 0;
                $material_amount['kepuasan'] =
                    number_format(
                        (($material_amount5 +
                            $material_amount4 +
                            $material_amount3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $promotion_quantity5 = isset($promotion_quantity['5'])
                    ? $promotion_quantity['5']
                    : 0;
                $promotion_quantity4 = isset($promotion_quantity['4'])
                    ? $promotion_quantity['4']
                    : 0;
                $promotion_quantity3 = isset($promotion_quantity['3'])
                    ? $promotion_quantity['3']
                    : 0;
                $promotion_quantity['kepuasan'] =
                    number_format(
                        (($promotion_quantity5 +
                            $promotion_quantity4 +
                            $promotion_quantity3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $promotion_quality5 = isset($promotion_quality['5'])
                    ? $promotion_quality['5']
                    : 0;
                $promotion_quality4 = isset($promotion_quality['4'])
                    ? $promotion_quality['4']
                    : 0;
                $promotion_quality3 = isset($promotion_quality['3'])
                    ? $promotion_quality['3']
                    : 0;
                $promotion_quality['kepuasan'] =
                    number_format(
                        (($promotion_quality5 +
                            $promotion_quality4 +
                            $promotion_quality3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $dataSend = [
                    'Kecukupan jumlah material promosi' => $material_amount['kepuasan'],
                    'Kuantitas kegiatan promosi yang dilaksanakan oleh petugas' => $promotion_quantity['kepuasan'],
                    'Kualitas kegiatan promosi yang dilaksanakan oleh petugas' => $promotion_quality['kepuasan'],
                ];

                foreach ($dataSend as $key => $val) {
                    $dataSend[$key] = $this->roundNumber(floatval($dataSend[$key] * count($dataSend)));
                }

                $dataSend = $this->customSort($dataSend);
                return response()->json([
                    [
                        'Kepuasan' => (float) $dataAllKategory['perhitungan_index_aspek']['promosi']['kepuasan'] * 100,
                    ],
                    $dataSend
                ]);
            }

            if ($category == 'kualitas') {
                $seed_purity = [];
                $vigor = [];
                $growing_power = [];
                $genetic_purity = [];
                $pest_resistance = [];
                $suitablelity_image_result = [];
                $suitablelity_result_request = [];
                $satisfaction_result = [];

                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'seed_purity') {
                            array_push($seed_purity, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'vigor') {
                            array_push($vigor, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'growing_power') {
                            array_push($growing_power, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'genetic_purity') {
                            array_push($genetic_purity, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'pest_resistance') {
                            array_push($pest_resistance, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'suitablelity_image_result') {
                            array_push($suitablelity_image_result, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'suitablelity_result_request') {
                            array_push($suitablelity_result_request, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'satisfaction_result') {
                            array_push($satisfaction_result, $value2);
                        }
                    }
                }

                $dataTotalAllKategory =
                    $dataAllKategory['penilaian_pelanggan']['kualitas_produk']['total'];

                $seed_purity = $this->countValues($seed_purity);
                $vigor = $this->countValues($vigor);
                $growing_power = $this->countValues($growing_power);
                $genetic_purity = $this->countValues($genetic_purity);
                $pest_resistance = $this->countValues($pest_resistance);
                $suitablelity_image_result = $this->countValues(
                    $suitablelity_image_result
                );
                $suitablelity_result_request = $this->countValues(
                    $suitablelity_result_request
                );
                $satisfaction_result = $this->countValues($satisfaction_result);

                $seed_purity5 = isset($seed_purity['5'])
                    ? $seed_purity['5']
                    : 0;
                $seed_purity4 = isset($seed_purity['4'])
                    ? $seed_purity['4']
                    : 0;
                $seed_purity3 = isset($seed_purity['3'])
                    ? $seed_purity['3']
                    : 0;
                $seed_purity['kepuasan'] =
                    number_format(
                        (($seed_purity5 + $seed_purity4 + $seed_purity3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $vigor5 = isset($vigor['5']) ? $vigor['5'] : 0;
                $vigor4 = isset($vigor['4']) ? $vigor['4'] : 0;
                $vigor3 = isset($vigor['3']) ? $vigor['3'] : 0;
                $vigor['kepuasan'] =
                    number_format(
                        (($vigor5 + $vigor4 + $vigor3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $growing_power5 = isset($growing_power['5'])
                    ? $growing_power['5']
                    : 0;
                $growing_power4 = isset($growing_power['4'])
                    ? $growing_power['4']
                    : 0;
                $growing_power3 = isset($growing_power['3'])
                    ? $growing_power['3']
                    : 0;
                $growing_power['kepuasan'] =
                    number_format(
                        (($growing_power5 + $growing_power4 + $growing_power3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $genetic_purity5 = isset($genetic_purity['5'])
                    ? $genetic_purity['5']
                    : 0;
                $genetic_purity4 = isset($genetic_purity['4'])
                    ? $genetic_purity['4']
                    : 0;
                $genetic_purity3 = isset($genetic_purity['3'])
                    ? $genetic_purity['3']
                    : 0;
                $genetic_purity['kepuasan'] =
                    number_format(
                        (($genetic_purity5 +
                            $genetic_purity4 +
                            $genetic_purity3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $pest_resistance5 = isset($pest_resistance['5'])
                    ? $pest_resistance['5']
                    : 0;
                $pest_resistance4 = isset($pest_resistance['4'])
                    ? $pest_resistance['4']
                    : 0;
                $pest_resistance3 = isset($pest_resistance['3'])
                    ? $pest_resistance['3']
                    : 0;
                $pest_resistance['kepuasan'] =
                    number_format(
                        (($pest_resistance5 +
                            $pest_resistance4 +
                            $pest_resistance3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $suitablelity_image_result5 = isset(
                    $suitablelity_image_result['5']
                )
                    ? $suitablelity_image_result['5']
                    : 0;
                $suitablelity_image_result4 = isset(
                    $suitablelity_image_result['4']
                )
                    ? $suitablelity_image_result['4']
                    : 0;
                $suitablelity_image_result3 = isset(
                    $suitablelity_image_result['3']
                )
                    ? $suitablelity_image_result['3']
                    : 0;
                $suitablelity_image_result['kepuasan'] =
                    number_format(
                        (($suitablelity_image_result5 +
                            $suitablelity_image_result4 +
                            $suitablelity_image_result3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $suitablelity_result_request5 = isset(
                    $suitablelity_result_request['5']
                )
                    ? $suitablelity_result_request['5']
                    : 0;
                $suitablelity_result_request4 = isset(
                    $suitablelity_result_request['4']
                )
                    ? $suitablelity_result_request['4']
                    : 0;
                $suitablelity_result_request3 = isset(
                    $suitablelity_result_request['3']
                )
                    ? $suitablelity_result_request['3']
                    : 0;
                $suitablelity_result_request['kepuasan'] =
                    number_format(
                        (($suitablelity_result_request5 +
                            $suitablelity_result_request4 +
                            $suitablelity_result_request3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $satisfaction_result5 = isset($satisfaction_result['5'])
                    ? $satisfaction_result['5']
                    : 0;
                $satisfaction_result4 = isset($satisfaction_result['4'])
                    ? $satisfaction_result['4']
                    : 0;
                $satisfaction_result3 = isset($satisfaction_result['3'])
                    ? $satisfaction_result['3']
                    : 0;
                $satisfaction_result['kepuasan'] =
                    number_format(
                        (($satisfaction_result5 +
                            $satisfaction_result4 +
                            $satisfaction_result3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $dataSend = [
                    'Kemurnian fisik benih produk sesuai dengan standart mutu' => $seed_purity['kepuasan'],
                    'Vigor benih produk pada saat dipersemaian' => $vigor['kepuasan'],
                    'Daya tumbuh benih produk, sesuai dengan standart mutu' => $growing_power['kepuasan'],
                    'Kemurnian genetik sesuai dengan standart mutu' => $genetic_purity['kepuasan'],
                    'Ketahanan hama dan penyakit produk' => $pest_resistance['kepuasan'],
                    'Kesesuaian gambar produk dengan hasil panen' => $suitablelity_image_result['kepuasan'],
                    'Kesesuaian hasil panen terhadap permintaan pasar' => $suitablelity_result_request['kepuasan'],
                    'Kepuasan hasil panen produk' => $satisfaction_result['kepuasan'],
                ];

                foreach ($dataSend as $key => $val) {
                    $dataSend[$key] = $this->roundNumber(floatval($dataSend[$key] * count($dataSend)));
                }

                $dataSend = $this->customSort($dataSend);
                return response()->json([
                    [
                        'Kepuasan' => (float) $dataAllKategory['perhitungan_index_aspek']['kualitas_produk']['kepuasan'] * 100,
                    ],
                    $dataSend
                ]);
            }

            if ($category == 'layanan') {
                $technical_ability = [];
                $visit_intensity = [];
                $communication_intensity = [];
                $skill_credibility = [];
                $influence_of_officer = [];
                $communication_skill = [];

                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'technical_ability') {
                            array_push($technical_ability, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'visit_intensity') {
                            array_push($visit_intensity, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'communication_intensity') {
                            array_push($communication_intensity, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'skill_credibility') {
                            array_push($skill_credibility, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'influence_of_officer') {
                            array_push($influence_of_officer, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'communication_skill') {
                            array_push($communication_skill, $value2);
                        }
                    }
                }

                $dataTotalAllKategory =
                    $dataAllKategory['penilaian_pelanggan']['layanan_petugas_lapang']['total'];

                $technical_ability = $this->countValues($technical_ability);
                $visit_intensity = $this->countValues($visit_intensity);
                $communication_intensity = $this->countValues(
                    $communication_intensity
                );
                $skill_credibility = $this->countValues($skill_credibility);
                $influence_of_officer = $this->countValues(
                    $influence_of_officer
                );
                $communication_skill = $this->countValues($communication_skill);

                $technical_ability5 = isset($technical_ability['5'])
                    ? $technical_ability['5']
                    : 0;
                $technical_ability4 = isset($technical_ability['4'])
                    ? $technical_ability['4']
                    : 0;
                $technical_ability3 = isset($technical_ability['3'])
                    ? $technical_ability['3']
                    : 0;
                $technical_ability['kepuasan'] =
                    number_format(
                        (($technical_ability5 +
                            $technical_ability4 +
                            $technical_ability3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $visit_intensity5 = isset($visit_intensity['5'])
                    ? $visit_intensity['5']
                    : 0;
                $visit_intensity4 = isset($visit_intensity['4'])
                    ? $visit_intensity['4']
                    : 0;
                $visit_intensity3 = isset($visit_intensity['3'])
                    ? $visit_intensity['3']
                    : 0;
                $visit_intensity['kepuasan'] =
                    number_format(
                        (($visit_intensity5 +
                            $visit_intensity4 +
                            $visit_intensity3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $communication_intensity5 = isset($communication_intensity['5'])
                    ? $communication_intensity['5']
                    : 0;
                $communication_intensity4 = isset($communication_intensity['4'])
                    ? $communication_intensity['4']
                    : 0;
                $communication_intensity3 = isset($communication_intensity['3'])
                    ? $communication_intensity['3']
                    : 0;
                $communication_intensity['kepuasan'] =
                    number_format(
                        (($communication_intensity5 +
                            $communication_intensity4 +
                            $communication_intensity3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $skill_credibility5 = isset($skill_credibility['5'])
                    ? $skill_credibility['5']
                    : 0;
                $skill_credibility4 = isset($skill_credibility['4'])
                    ? $skill_credibility['4']
                    : 0;
                $skill_credibility3 = isset($skill_credibility['3'])
                    ? $skill_credibility['3']
                    : 0;
                $skill_credibility['kepuasan'] =
                    number_format(
                        (($skill_credibility5 +
                            $skill_credibility4 +
                            $skill_credibility3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $influence_of_officer5 = isset($influence_of_officer['5'])
                    ? $influence_of_officer['5']
                    : 0;
                $influence_of_officer4 = isset($influence_of_officer['4'])
                    ? $influence_of_officer['4']
                    : 0;
                $influence_of_officer3 = isset($influence_of_officer['3'])
                    ? $influence_of_officer['3']
                    : 0;
                $influence_of_officer['kepuasan'] =
                    number_format(
                        (($influence_of_officer5 +
                            $influence_of_officer4 +
                            $influence_of_officer3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $communication_skill5 = isset($communication_skill['5'])
                    ? $communication_skill['5']
                    : 0;
                $communication_skill4 = isset($communication_skill['4'])
                    ? $communication_skill['4']
                    : 0;
                $communication_skill3 = isset($communication_skill['3'])
                    ? $communication_skill['3']
                    : 0;
                $communication_skill['kepuasan'] =
                    number_format(
                        (($communication_skill5 +
                            $communication_skill4 +
                            $communication_skill3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $dataSend = [
                    'Kemampuan teknis budidaya petugas lapang' => $technical_ability['kepuasan'],
                    'Intensitas kunjungan petugas lapang' => $visit_intensity['kepuasan'],
                    'Intensitas interaksi dan komunikasi petugas lapang' => $communication_intensity['kepuasan'],
                    'Kecakapan dan kredibilitas (dapat dipercaya) petugas lapang' => $skill_credibility['kepuasan'],
                    'Pengaruh keberadaan petugas lapang' => $influence_of_officer['kepuasan'],
                    'Kemampuan teknis komunikasi petugas lapang' => $communication_skill['kepuasan'],
                ];

                foreach ($dataSend as $key => $val) {
                    $dataSend[$key] = $this->roundNumber(floatval($dataSend[$key] * count($dataSend)));
                }

                $dataSend = $this->customSort($dataSend);
                return response()->json([
                    [
                        'Kepuasan' => (float) $dataAllKategory['perhitungan_index_aspek']['layanan_petugas_lapang']['kepuasan'] * 100,
                    ],
                    $dataSend
                ]);
            }

            if ($category == 'penanganan') {
                $verification_speed = [];
                $completion_speed = [];
                $handling = [];

                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'verification_speed') {
                            array_push($verification_speed, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'completion_speed') {
                            array_push($completion_speed, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'handling') {
                            array_push($handling, $value2);
                        }
                    }
                }

                $dataTotalAllKategory =
                    $dataAllKategory['penilaian_pelanggan']['penanganan_komplain']['total'];

                $verification_speed = $this->countValues($verification_speed);
                $completion_speed = $this->countValues($completion_speed);
                $handling = $this->countValues($handling);

                $verification_speed5 = isset($verification_speed['5'])
                    ? $verification_speed['5']
                    : 0;
                $verification_speed4 = isset($verification_speed['4'])
                    ? $verification_speed['4']
                    : 0;
                $verification_speed3 = isset($verification_speed['3'])
                    ? $verification_speed['3']
                    : 0;
                $verification_speed['kepuasan'] =
                    number_format(
                        (($verification_speed5 +
                            $verification_speed4 +
                            $verification_speed3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $completion_speed5 = isset($completion_speed['5'])
                    ? $completion_speed['5']
                    : 0;
                $completion_speed4 = isset($completion_speed['4'])
                    ? $completion_speed['4']
                    : 0;
                $completion_speed3 = isset($completion_speed['3'])
                    ? $completion_speed['3']
                    : 0;
                $completion_speed['kepuasan'] =
                    number_format(
                        (($completion_speed5 +
                            $completion_speed4 +
                            $completion_speed3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $handling5 = isset($handling['5']) ? $handling['5'] : 0;
                $handling4 = isset($handling['4']) ? $handling['4'] : 0;
                $handling3 = isset($handling['3']) ? $handling['3'] : 0;
                $handling['kepuasan'] =
                    number_format(
                        (($handling5 + $handling4 + $handling3) /
                            $dataTotalAllKategory) *
                            100,
                        2,
                        '.',
                        ''
                    );

                $dataSend = [
                    'Kecepatan verifikasi komplain pelanggan' => $verification_speed['kepuasan'],
                    'Kecepatan penyelesaian komplain pelanggan' => $completion_speed['kepuasan'],
                    'Penanganan komplain pelanggan' => $handling['kepuasan'],
                ];

                foreach ($dataSend as $key => $val) {
                    $dataSend[$key] = $this->roundNumber(floatval($dataSend[$key] * count($dataSend)));
                }

                $dataSend = $this->customSort($dataSend);
                return response()->json([
                    [
                        'Kepuasan' => (float) $dataAllKategory['perhitungan_index_aspek']['penanganan_komplain']['kepuasan'] * 100,
                    ],
                    $dataSend
                ]);
            }
        } catch (\Throwable $th) {
            $returnData = [
                'status' => 'error',
                'message' => 'error server',
            ];
            dd($th);
            return response()->json($returnData, 500);
        }
    }

    public function getPertanyaanKepuasanByRespondents($category, $area)
    {
        $location_name = base64_decode($area);
        $endPointApi = env('PYTHON_END_POINT') . 'ai';
        $dataAnswerRaw = [];
        $dataAnswerLoop = [];

        try {
            $dataAI = [Http::get($endPointApi)->json()['data']][0];

            // set customer data berdasarkan daerah sesuai parameter
            foreach ($dataAI['customer_data'] as $value) {
                if ($value['location']['name'] === $location_name) {
                    $dataAnswerRaw = $value['answer'];
                    break;
                }
            }

            // set index for dataAnswerLoop 
            for ($i = 0; $i < count($dataAnswerRaw); $i++) {
                $dataAnswerLoop[$i] = [];
            }

            // insert data into dataAnswerLoop based on count index
            for ($i = 0; $i < count($dataAnswerRaw); $i++) {
                for ($j = 0; $j <= $i; $j++) {
                    array_push($dataAnswerLoop[$i], $dataAnswerRaw[$j]);
                }
            }

            $productFinal = [];
            $promosiFinal = [];
            $kualitasFinal = [];
            $layananFinal = [];
            $penangananFinal = [];

            $totalProductFinal = [];
            $totalPromosiFinal = [];
            $totalKualitasFinal = [];
            $totalLayananFinal = [];
            $totalPenangananFinal = [];

            foreach ($dataAnswerLoop as $key => $dataAnswer) {
                $dataAllKategory = $this->kepuasanDaerah($dataAnswer);

                if ($category == 'product') {
                    $information = [];
                    $price_comparison = [];
                    $variety_previlege = [];
                    $packaging_view = [];
                    $getting_easy = [];
                    $satisfaction = [];
                    $image_view = [];

                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'information') {
                                array_push($information, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'price_comparison') {
                                array_push($price_comparison, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'variety_previlege') {
                                array_push($variety_previlege, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'packaging_view') {
                                array_push($packaging_view, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'getting_easy') {
                                array_push($getting_easy, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'satisfaction') {
                                array_push($satisfaction, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'image_view') {
                                array_push($image_view, $value2);
                            }
                        }
                    }

                    $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['product']['total'];

                    $information = $this->countValues($information);
                    $price_comparison = $this->countValues($price_comparison);
                    $variety_previlege = $this->countValues($variety_previlege);
                    $packaging_view = $this->countValues($packaging_view);
                    $getting_easy = $this->countValues($getting_easy);
                    $satisfaction = $this->countValues($satisfaction);
                    $image_view = $this->countValues($image_view);

                    $information5 = isset($information['5'])
                        ? $information['5']
                        : 0;
                    $information4 = isset($information['4'])
                        ? $information['4']
                        : 0;
                    $information3 = isset($information['3'])
                        ? $information['3']
                        : 0;
                    $information['kepuasan'] =
                        number_format(
                            (($information5 + $information4 + $information3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $price_comparison5 = isset($price_comparison['5'])
                        ? $price_comparison['5']
                        : 0;
                    $price_comparison4 = isset($price_comparison['4'])
                        ? $price_comparison['4']
                        : 0;
                    $price_comparison3 = isset($price_comparison['3'])
                        ? $price_comparison['3']
                        : 0;
                    $price_comparison['kepuasan'] =
                        number_format(
                            (($price_comparison5 +
                                $price_comparison4 +
                                $price_comparison3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $variety_previlege5 = isset($variety_previlege['5'])
                        ? $variety_previlege['5']
                        : 0;
                    $variety_previlege4 = isset($variety_previlege['4'])
                        ? $variety_previlege['4']
                        : 0;
                    $variety_previlege3 = isset($variety_previlege['3'])
                        ? $variety_previlege['3']
                        : 0;
                    $variety_previlege['kepuasan'] =
                        number_format(
                            (($variety_previlege5 +
                                $variety_previlege4 +
                                $variety_previlege3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $packaging_view5 = isset($packaging_view['5'])
                        ? $packaging_view['5']
                        : 0;
                    $packaging_view4 = isset($packaging_view['4'])
                        ? $packaging_view['4']
                        : 0;
                    $packaging_view3 = isset($packaging_view['3'])
                        ? $packaging_view['3']
                        : 0;
                    $packaging_view['kepuasan'] =
                        number_format(
                            (($packaging_view5 +
                                $packaging_view4 +
                                $packaging_view3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $getting_easy5 = isset($getting_easy['5'])
                        ? $getting_easy['5']
                        : 0;
                    $getting_easy4 = isset($getting_easy['4'])
                        ? $getting_easy['4']
                        : 0;
                    $getting_easy3 = isset($getting_easy['3'])
                        ? $getting_easy['3']
                        : 0;
                    $getting_easy['kepuasan'] =
                        number_format(
                            (($getting_easy5 + $getting_easy4 + $getting_easy3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $satisfaction5 = isset($satisfaction['5'])
                        ? $satisfaction['5']
                        : 0;
                    $satisfaction4 = isset($satisfaction['4'])
                        ? $satisfaction['4']
                        : 0;
                    $satisfaction3 = isset($satisfaction['3'])
                        ? $satisfaction['3']
                        : 0;
                    $satisfaction['kepuasan'] =
                        number_format(
                            (($satisfaction5 + $satisfaction4 + $satisfaction3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $image_view5 = isset($image_view['5']) ? $image_view['5'] : 0;
                    $image_view4 = isset($image_view['4']) ? $image_view['4'] : 0;
                    $image_view3 = isset($image_view['3']) ? $image_view['3'] : 0;
                    $image_view['kepuasan'] =
                        number_format(
                            (($image_view5 + $image_view4 + $image_view3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $dataByCountIndex = [
                        'Kemasan Produk' => $information['kepuasan'],
                        'Harga Kompetitor' => $price_comparison['kepuasan'],
                        'Keunggulan Varietas' => $variety_previlege['kepuasan'],
                        'Desain Kemasan' => $packaging_view['kepuasan'],
                        'Akses Pembelian' => $getting_easy['kepuasan'],
                        'Kepuasan Konsumen' => $satisfaction['kepuasan'],
                        'Tampilan Gambar' => $image_view['kepuasan'],
                    ];

                    foreach ($dataByCountIndex as $key => $val) {
                        $dataByCountIndex[$key] = $this->roundNumber(floatval($dataByCountIndex[$key] * count($dataByCountIndex)));
                    }
                    $dataSend = $this->customSort($dataByCountIndex);

                    $total = ['total' => (int) (array_sum($dataByCountIndex) / count($dataByCountIndex))];

                    array_push($totalProductFinal, $total);
                    array_push($productFinal, $dataByCountIndex);
                }
                if ($category == 'promosi') {
                    $material_amount = [];
                    $promotion_quantity = [];
                    $promotion_quality = [];

                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'material_amount') {
                                array_push($material_amount, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'promotion_quantity') {
                                array_push($promotion_quantity, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'promotion_quality') {
                                array_push($promotion_quality, $value2);
                            }
                        }
                    }

                    $dataTotalAllKategory =
                        $dataAllKategory['penilaian_pelanggan']['promosi']['total'];

                    $material_amount = $this->countValues($material_amount);
                    $promotion_quantity = $this->countValues($promotion_quantity);
                    $promotion_quality = $this->countValues($promotion_quality);

                    $material_amount5 = isset($material_amount['5'])
                        ? $material_amount['5']
                        : 0;
                    $material_amount4 = isset($material_amount['4'])
                        ? $material_amount['4']
                        : 0;
                    $material_amount3 = isset($material_amount['3'])
                        ? $material_amount['3']
                        : 0;
                    $material_amount['kepuasan'] =
                        number_format(
                            (($material_amount5 +
                                $material_amount4 +
                                $material_amount3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $promotion_quantity5 = isset($promotion_quantity['5'])
                        ? $promotion_quantity['5']
                        : 0;
                    $promotion_quantity4 = isset($promotion_quantity['4'])
                        ? $promotion_quantity['4']
                        : 0;
                    $promotion_quantity3 = isset($promotion_quantity['3'])
                        ? $promotion_quantity['3']
                        : 0;
                    $promotion_quantity['kepuasan'] =
                        number_format(
                            (($promotion_quantity5 +
                                $promotion_quantity4 +
                                $promotion_quantity3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $promotion_quality5 = isset($promotion_quality['5'])
                        ? $promotion_quality['5']
                        : 0;
                    $promotion_quality4 = isset($promotion_quality['4'])
                        ? $promotion_quality['4']
                        : 0;
                    $promotion_quality3 = isset($promotion_quality['3'])
                        ? $promotion_quality['3']
                        : 0;
                    $promotion_quality['kepuasan'] =
                        number_format(
                            (($promotion_quality5 +
                                $promotion_quality4 +
                                $promotion_quality3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $dataByCountIndex = [
                        'Ketersediaan Materi' => $material_amount['kepuasan'],
                        'Intensitas Petugas' => $promotion_quantity['kepuasan'],
                        'Kualitas Promosi' => $promotion_quality['kepuasan'],
                    ];
                    foreach ($dataByCountIndex as $key => $val) {
                        $dataByCountIndex[$key] = $this->roundNumber(floatval($dataByCountIndex[$key] * count($dataByCountIndex)));
                    }

                    $dataByCountIndex = $this->customSort($dataByCountIndex);
                    $total = ['total' => (int) (array_sum($dataByCountIndex) / count($dataByCountIndex))];

                    array_push($totalPromosiFinal, $total);
                    array_push($promosiFinal, $dataByCountIndex);
                }
                if ($category == 'kualitas') {
                    $seed_purity = [];
                    $vigor = [];
                    $growing_power = [];
                    $genetic_purity = [];
                    $pest_resistance = [];
                    $suitablelity_image_result = [];
                    $suitablelity_result_request = [];
                    $satisfaction_result = [];

                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'seed_purity') {
                                array_push($seed_purity, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'vigor') {
                                array_push($vigor, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'growing_power') {
                                array_push($growing_power, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'genetic_purity') {
                                array_push($genetic_purity, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'pest_resistance') {
                                array_push($pest_resistance, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'suitablelity_image_result') {
                                array_push($suitablelity_image_result, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'suitablelity_result_request') {
                                array_push($suitablelity_result_request, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'satisfaction_result') {
                                array_push($satisfaction_result, $value2);
                            }
                        }
                    }

                    $dataTotalAllKategory =
                        $dataAllKategory['penilaian_pelanggan']['kualitas_produk']['total'];

                    $seed_purity = $this->countValues($seed_purity);
                    $vigor = $this->countValues($vigor);
                    $growing_power = $this->countValues($growing_power);
                    $genetic_purity = $this->countValues($genetic_purity);
                    $pest_resistance = $this->countValues($pest_resistance);
                    $suitablelity_image_result = $this->countValues(
                        $suitablelity_image_result
                    );
                    $suitablelity_result_request = $this->countValues(
                        $suitablelity_result_request
                    );
                    $satisfaction_result = $this->countValues($satisfaction_result);

                    $seed_purity5 = isset($seed_purity['5'])
                        ? $seed_purity['5']
                        : 0;
                    $seed_purity4 = isset($seed_purity['4'])
                        ? $seed_purity['4']
                        : 0;
                    $seed_purity3 = isset($seed_purity['3'])
                        ? $seed_purity['3']
                        : 0;
                    $seed_purity['kepuasan'] =
                        number_format(
                            (($seed_purity5 + $seed_purity4 + $seed_purity3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $vigor5 = isset($vigor['5']) ? $vigor['5'] : 0;
                    $vigor4 = isset($vigor['4']) ? $vigor['4'] : 0;
                    $vigor3 = isset($vigor['3']) ? $vigor['3'] : 0;
                    $vigor['kepuasan'] =
                        number_format(
                            (($vigor5 + $vigor4 + $vigor3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $growing_power5 = isset($growing_power['5'])
                        ? $growing_power['5']
                        : 0;
                    $growing_power4 = isset($growing_power['4'])
                        ? $growing_power['4']
                        : 0;
                    $growing_power3 = isset($growing_power['3'])
                        ? $growing_power['3']
                        : 0;
                    $growing_power['kepuasan'] =
                        number_format(
                            (($growing_power5 + $growing_power4 + $growing_power3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $genetic_purity5 = isset($genetic_purity['5'])
                        ? $genetic_purity['5']
                        : 0;
                    $genetic_purity4 = isset($genetic_purity['4'])
                        ? $genetic_purity['4']
                        : 0;
                    $genetic_purity3 = isset($genetic_purity['3'])
                        ? $genetic_purity['3']
                        : 0;
                    $genetic_purity['kepuasan'] =
                        number_format(
                            (($genetic_purity5 +
                                $genetic_purity4 +
                                $genetic_purity3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $pest_resistance5 = isset($pest_resistance['5'])
                        ? $pest_resistance['5']
                        : 0;
                    $pest_resistance4 = isset($pest_resistance['4'])
                        ? $pest_resistance['4']
                        : 0;
                    $pest_resistance3 = isset($pest_resistance['3'])
                        ? $pest_resistance['3']
                        : 0;
                    $pest_resistance['kepuasan'] =
                        number_format(
                            (($pest_resistance5 +
                                $pest_resistance4 +
                                $pest_resistance3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $suitablelity_image_result5 = isset(
                        $suitablelity_image_result['5']
                    )
                        ? $suitablelity_image_result['5']
                        : 0;
                    $suitablelity_image_result4 = isset(
                        $suitablelity_image_result['4']
                    )
                        ? $suitablelity_image_result['4']
                        : 0;
                    $suitablelity_image_result3 = isset(
                        $suitablelity_image_result['3']
                    )
                        ? $suitablelity_image_result['3']
                        : 0;
                    $suitablelity_image_result['kepuasan'] =
                        number_format(
                            (($suitablelity_image_result5 +
                                $suitablelity_image_result4 +
                                $suitablelity_image_result3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $suitablelity_result_request5 = isset(
                        $suitablelity_result_request['5']
                    )
                        ? $suitablelity_result_request['5']
                        : 0;
                    $suitablelity_result_request4 = isset(
                        $suitablelity_result_request['4']
                    )
                        ? $suitablelity_result_request['4']
                        : 0;
                    $suitablelity_result_request3 = isset(
                        $suitablelity_result_request['3']
                    )
                        ? $suitablelity_result_request['3']
                        : 0;
                    $suitablelity_result_request['kepuasan'] =
                        number_format(
                            (($suitablelity_result_request5 +
                                $suitablelity_result_request4 +
                                $suitablelity_result_request3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $satisfaction_result5 = isset($satisfaction_result['5'])
                        ? $satisfaction_result['5']
                        : 0;
                    $satisfaction_result4 = isset($satisfaction_result['4'])
                        ? $satisfaction_result['4']
                        : 0;
                    $satisfaction_result3 = isset($satisfaction_result['3'])
                        ? $satisfaction_result['3']
                        : 0;
                    $satisfaction_result['kepuasan'] =
                        number_format(
                            (($satisfaction_result5 +
                                $satisfaction_result4 +
                                $satisfaction_result3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $dataByCountIndex = [
                        'Murni Benih' => $seed_purity['kepuasan'],
                        'Vigor Benih' => $vigor['kepuasan'],
                        'Daya Tumbuh' => $growing_power['kepuasan'],
                        'Murni Genetik' => $genetic_purity['kepuasan'],
                        'Ketahanan Produk' => $pest_resistance['kepuasan'],
                        'Kesesuaian Gambar' => $suitablelity_image_result['kepuasan'],
                        'Kesesuaian Panen' => $suitablelity_result_request['kepuasan'],
                        'Kepuasan Panen' => $satisfaction_result['kepuasan'],
                    ];
                    foreach ($dataByCountIndex as $key => $val) {
                        $dataByCountIndex[$key] = $this->roundNumber(floatval($dataByCountIndex[$key] * count($dataByCountIndex)));
                    }

                    $dataByCountIndex = $this->customSort($dataByCountIndex);
                    $total = ['total' => (int) (array_sum($dataByCountIndex) / count($dataByCountIndex))];

                    array_push($totalKualitasFinal, $total);
                    array_push($kualitasFinal, $dataByCountIndex);
                }
                if ($category == 'layanan') {
                    $technical_ability = [];
                    $visit_intensity = [];
                    $communication_intensity = [];
                    $skill_credibility = [];
                    $influence_of_officer = [];
                    $communication_skill = [];

                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'technical_ability') {
                                array_push($technical_ability, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'visit_intensity') {
                                array_push($visit_intensity, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'communication_intensity') {
                                array_push($communication_intensity, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'skill_credibility') {
                                array_push($skill_credibility, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'influence_of_officer') {
                                array_push($influence_of_officer, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'communication_skill') {
                                array_push($communication_skill, $value2);
                            }
                        }
                    }

                    $dataTotalAllKategory =
                        $dataAllKategory['penilaian_pelanggan']['layanan_petugas_lapang']['total'];

                    $technical_ability = $this->countValues($technical_ability);
                    $visit_intensity = $this->countValues($visit_intensity);
                    $communication_intensity = $this->countValues(
                        $communication_intensity
                    );
                    $skill_credibility = $this->countValues($skill_credibility);
                    $influence_of_officer = $this->countValues(
                        $influence_of_officer
                    );
                    $communication_skill = $this->countValues($communication_skill);

                    $technical_ability5 = isset($technical_ability['5'])
                        ? $technical_ability['5']
                        : 0;
                    $technical_ability4 = isset($technical_ability['4'])
                        ? $technical_ability['4']
                        : 0;
                    $technical_ability3 = isset($technical_ability['3'])
                        ? $technical_ability['3']
                        : 0;
                    $technical_ability['kepuasan'] =
                        number_format(
                            (($technical_ability5 +
                                $technical_ability4 +
                                $technical_ability3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $visit_intensity5 = isset($visit_intensity['5'])
                        ? $visit_intensity['5']
                        : 0;
                    $visit_intensity4 = isset($visit_intensity['4'])
                        ? $visit_intensity['4']
                        : 0;
                    $visit_intensity3 = isset($visit_intensity['3'])
                        ? $visit_intensity['3']
                        : 0;
                    $visit_intensity['kepuasan'] =
                        number_format(
                            (($visit_intensity5 +
                                $visit_intensity4 +
                                $visit_intensity3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $communication_intensity5 = isset($communication_intensity['5'])
                        ? $communication_intensity['5']
                        : 0;
                    $communication_intensity4 = isset($communication_intensity['4'])
                        ? $communication_intensity['4']
                        : 0;
                    $communication_intensity3 = isset($communication_intensity['3'])
                        ? $communication_intensity['3']
                        : 0;
                    $communication_intensity['kepuasan'] =
                        number_format(
                            (($communication_intensity5 +
                                $communication_intensity4 +
                                $communication_intensity3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $skill_credibility5 = isset($skill_credibility['5'])
                        ? $skill_credibility['5']
                        : 0;
                    $skill_credibility4 = isset($skill_credibility['4'])
                        ? $skill_credibility['4']
                        : 0;
                    $skill_credibility3 = isset($skill_credibility['3'])
                        ? $skill_credibility['3']
                        : 0;
                    $skill_credibility['kepuasan'] =
                        number_format(
                            (($skill_credibility5 +
                                $skill_credibility4 +
                                $skill_credibility3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $influence_of_officer5 = isset($influence_of_officer['5'])
                        ? $influence_of_officer['5']
                        : 0;
                    $influence_of_officer4 = isset($influence_of_officer['4'])
                        ? $influence_of_officer['4']
                        : 0;
                    $influence_of_officer3 = isset($influence_of_officer['3'])
                        ? $influence_of_officer['3']
                        : 0;
                    $influence_of_officer['kepuasan'] =
                        number_format(
                            (($influence_of_officer5 +
                                $influence_of_officer4 +
                                $influence_of_officer3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $communication_skill5 = isset($communication_skill['5'])
                        ? $communication_skill['5']
                        : 0;
                    $communication_skill4 = isset($communication_skill['4'])
                        ? $communication_skill['4']
                        : 0;
                    $communication_skill3 = isset($communication_skill['3'])
                        ? $communication_skill['3']
                        : 0;
                    $communication_skill['kepuasan'] =
                        number_format(
                            (($communication_skill5 +
                                $communication_skill4 +
                                $communication_skill3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $dataByCountIndex = [
                        'Kemampuan Teknis' => $technical_ability['kepuasan'],
                        'Intensitas Kunjungan' => $visit_intensity['kepuasan'],
                        'Interaksi Petugas' => $communication_intensity['kepuasan'],
                        'Kecakapan Petugas' => $skill_credibility['kepuasan'],
                        'Pengaruh Petugas' => $influence_of_officer['kepuasan'],
                        'Kemampuan Komunikasi' => $communication_skill['kepuasan'],
                    ];
                    foreach ($dataByCountIndex as $key => $val) {
                        $dataByCountIndex[$key] = $this->roundNumber(floatval($dataByCountIndex[$key] * count($dataByCountIndex)));
                    }

                    $dataByCountIndex = $this->customSort($dataByCountIndex);
                    $total = ['total' => (int) (array_sum($dataByCountIndex) / count($dataByCountIndex))];

                    array_push($totalLayananFinal, $total);
                    array_push($layananFinal, $dataByCountIndex);
                }
                if ($category == 'penanganan') {
                    $verification_speed = [];
                    $completion_speed = [];
                    $handling = [];

                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'verification_speed') {
                                array_push($verification_speed, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'completion_speed') {
                                array_push($completion_speed, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'handling') {
                                array_push($handling, $value2);
                            }
                        }
                    }

                    $dataTotalAllKategory =
                        $dataAllKategory['penilaian_pelanggan']['penanganan_komplain']['total'];

                    $verification_speed = $this->countValues($verification_speed);
                    $completion_speed = $this->countValues($completion_speed);
                    $handling = $this->countValues($handling);

                    $verification_speed5 = isset($verification_speed['5'])
                        ? $verification_speed['5']
                        : 0;
                    $verification_speed4 = isset($verification_speed['4'])
                        ? $verification_speed['4']
                        : 0;
                    $verification_speed3 = isset($verification_speed['3'])
                        ? $verification_speed['3']
                        : 0;
                    $verification_speed['kepuasan'] =
                        number_format(
                            (($verification_speed5 +
                                $verification_speed4 +
                                $verification_speed3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $completion_speed5 = isset($completion_speed['5'])
                        ? $completion_speed['5']
                        : 0;
                    $completion_speed4 = isset($completion_speed['4'])
                        ? $completion_speed['4']
                        : 0;
                    $completion_speed3 = isset($completion_speed['3'])
                        ? $completion_speed['3']
                        : 0;
                    $completion_speed['kepuasan'] =
                        number_format(
                            (($completion_speed5 +
                                $completion_speed4 +
                                $completion_speed3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $handling5 = isset($handling['5']) ? $handling['5'] : 0;
                    $handling4 = isset($handling['4']) ? $handling['4'] : 0;
                    $handling3 = isset($handling['3']) ? $handling['3'] : 0;
                    $handling['kepuasan'] =
                        number_format(
                            (($handling5 + $handling4 + $handling3) /
                                $dataTotalAllKategory) *
                                100,
                            2,
                            '.',
                            ''
                        );

                    $dataByCountIndex = [
                        'Verifikasi Cepat' => $verification_speed['kepuasan'],
                        'Penyelesaian Cepat' => $completion_speed['kepuasan'],
                        'Penanganan Komplain' => $handling['kepuasan'],
                    ];

                    foreach ($dataByCountIndex as $key => $val) {
                        $dataByCountIndex[$key] = $this->roundNumber(floatval($dataByCountIndex[$key] * count($dataByCountIndex)));
                    }

                    $dataByCountIndex = $this->customSort($dataByCountIndex);
                    $total = ['total' => (int) (array_sum($dataByCountIndex) / count($dataByCountIndex))];

                    array_push($totalPenangananFinal, $total);
                    array_push($penangananFinal, $dataByCountIndex);
                }
            }

            if ($category == 'product') {
                return response()->json([(object)$productFinal, (object)$totalProductFinal]);
            }
            if ($category == 'promosi') {
                return response()->json([(object)$promosiFinal, (object)$totalPromosiFinal]);
            }
            if ($category == 'kualitas') {
                return response()->json([(object)$kualitasFinal, (object)$totalKualitasFinal]);
            }
            if ($category == 'layanan') {
                return response()->json([(object)$layananFinal, (object)$totalLayananFinal]);
            }
            if ($category == 'penanganan') {
                return response()->json([(object)$penangananFinal, (object)$totalPenangananFinal]);
            }
        } catch (\Throwable $th) {
            $returnData = [
                'status' => 'error',
                'message' => 'error server',
            ];
            return response()->json($returnData, 500);
        }
    }

    public function getPertanyaanKekuatanKelemahan($category, $area)
    {
        $location_name = base64_decode($area);
        $endPointApi = env('PYTHON_END_POINT') . 'ai';
        $dataAnswer = [];

        try {
            $dataAI = [Http::get($endPointApi)->json()['data']][0];

            // set customer data berdasarkan daerah sesuai parameter
            foreach ($dataAI['competitor_identifier_data'] as $value) {
                if ($value['location']['name'] === $location_name) {
                    $dataAnswer = $value['answer'];
                    break;
                }
            }

            $dataAllKategory = $this->kekuatanKelemahanDaerah($dataAnswer);

            if ($category == 'product') {
                $position_pov = [];
                $deep = [];

                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'position_pov') {
                            array_push($position_pov, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'deep') {
                            array_push($deep, $value2);
                        }
                    }
                }

                $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['product']['total'];

                $position_pov = $this->countValues($position_pov);
                $deep = $this->countValues($deep);

                $position_pov5 = isset($position_pov['5']) ? $position_pov['5'] : 0;
                $position_pov4 = isset($position_pov['4']) ? $position_pov['4'] : 0;
                $position_pov3 = isset($position_pov['3']) ? $position_pov['3'] : 0;
                $position_pov['kepuasan'] = number_format((($position_pov5 + $position_pov4 + $position_pov3) / $dataTotalAllKategory) * 100, 2, '.', '');

                $deep5 = isset($deep['5']) ? $deep['5'] : 0;
                $deep4 = isset($deep['4']) ? $deep['4'] : 0;
                $deep3 = isset($deep['3']) ? $deep['3'] : 0;
                $deep['kepuasan'] = number_format((($deep5 + $deep4 + $deep3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $dataSend = [
                    'Kedudukan produk pesaing (dari sudut pandang pengguna) di setiap segmen pasar' => floatval($position_pov['kepuasan']),
                    'Luas dan dalamnya lini produk pesaing' => floatval($deep['kepuasan']),
                ];

                $dataSend = $this->customSort($dataSend);
                return response()->json([
                    [
                        'Kepuasan' => (float) $dataAllKategory['perhitungan_index_aspek']['product']['kepuasan'] * 100,
                    ],
                    $dataSend
                ]);
            }
            if ($category == 'distribusi') {
                $distribution_line = [];
                $line_power = [];
                $line_ability = [];

                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'distribution_line') {
                            array_push($distribution_line, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'line_power') {
                            array_push($line_power, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'line_ability') {
                            array_push($line_ability, $value2);
                        }
                    }
                }

                $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['distribusi']['total'];

                $distribution_line = $this->countValues($distribution_line);
                $line_power = $this->countValues($line_power);
                $line_ability = $this->countValues($line_ability);

                $distribution_line5 = isset($distribution_line['5']) ? $distribution_line['5'] : 0;
                $distribution_line4 = isset($distribution_line['4']) ? $distribution_line['4'] : 0;
                $distribution_line3 = isset($distribution_line['3']) ? $distribution_line['3'] : 0;
                $distribution_line['kepuasan'] = number_format((($distribution_line5 + $distribution_line4 + $distribution_line3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $line_power5 = isset($line_power['5']) ? $line_power['5'] : 0;
                $line_power4 = isset($line_power['4']) ? $line_power['4'] : 0;
                $line_power3 = isset($line_power['3']) ? $line_power['3'] : 0;
                $line_power['kepuasan'] = number_format((($line_power5 + $line_power4 + $line_power3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $line_ability5 = isset($line_ability['5']) ? $line_ability['5'] : 0;
                $line_ability4 = isset($line_ability['4']) ? $line_ability['4'] : 0;
                $line_ability3 = isset($line_ability['3']) ? $line_ability['3'] : 0;
                $line_ability['kepuasan'] = number_format((($line_ability5 + $line_ability4 + $line_ability3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $dataSend = [
                    'Kualitas saluran distribusi pesaing' => floatval($distribution_line['kepuasan']),
                    'Kekuatan hubungan saluran distribusi yang dimiliki pesaing' => floatval($line_power['kepuasan']),
                    'Kemampuan pesaing untuk melayani saluran distribusi' => floatval($line_ability['kepuasan']),
                ];

                $dataSend = $this->customSort($dataSend);
                return response()->json([
                    [
                        'Kepuasan' => (float) $dataAllKategory['perhitungan_index_aspek']['distribusi']['kepuasan'] * 100,
                    ],
                    $dataSend
                ]);
            }
            if ($category == 'pemasaran') {
                $marketing_skill = [];
                $dev_skill = [];

                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'marketing_skill') {
                            array_push($marketing_skill, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'dev_skill') {
                            array_push($dev_skill, $value2);
                        }
                    }
                }

                $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['pemasaran']['total'];

                $marketing_skill = $this->countValues($marketing_skill);
                $dev_skill = $this->countValues($dev_skill);

                $marketing_skill5 = isset($marketing_skill['5']) ? $marketing_skill['5'] : 0;
                $marketing_skill4 = isset($marketing_skill['4']) ? $marketing_skill['4'] : 0;
                $marketing_skill3 = isset($marketing_skill['3']) ? $marketing_skill['3'] : 0;
                $marketing_skill['kepuasan'] = number_format((($marketing_skill5 + $marketing_skill4 + $marketing_skill3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $dev_skill5 = isset($dev_skill['5']) ? $dev_skill['5'] : 0;
                $dev_skill4 = isset($dev_skill['4']) ? $dev_skill['4'] : 0;
                $dev_skill3 = isset($dev_skill['3']) ? $dev_skill['3'] : 0;
                $dev_skill['kepuasan'] = number_format((($dev_skill5 + $dev_skill4 + $dev_skill3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $dataSend = [
                    'Keterampilan pesaing pada masing-masing aspek bauran pemasaran' => floatval($marketing_skill['kepuasan']),
                    'Keterampilan pesaing dalam pengembangan produk baru' => floatval($dev_skill['kepuasan']),
                ];

                $dataSend = $this->customSort($dataSend);
                return response()->json([
                    [
                        'Kepuasan' => (float) $dataAllKategory['perhitungan_index_aspek']['pemasaran']['kepuasan'] * 100,
                    ],
                    $dataSend
                ]);
            }
            if ($category == 'operasional') {
                $advanced_tech = [];
                $fasility_flexibility = [];
                $scale_up_skill = [];
                $material_cost = [];

                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'advanced_tech') {
                            array_push($advanced_tech, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'fasility_flexibility') {
                            array_push($fasility_flexibility, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'scale_up_skill') {
                            array_push($scale_up_skill, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'material_cost') {
                            array_push($material_cost, $value2);
                        }
                    }
                }

                $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['operasional']['total'];

                $advanced_tech = $this->countValues($advanced_tech);
                $fasility_flexibility = $this->countValues($fasility_flexibility);
                $scale_up_skill = $this->countValues($scale_up_skill);
                $material_cost = $this->countValues($material_cost);

                $advanced_tech5 = isset($advanced_tech['5']) ? $advanced_tech['5'] : 0;
                $advanced_tech4 = isset($advanced_tech['4']) ? $advanced_tech['4'] : 0;
                $advanced_tech3 = isset($advanced_tech['3']) ? $advanced_tech['3'] : 0;
                $advanced_tech['kepuasan'] = number_format((($advanced_tech5 + $advanced_tech4 + $advanced_tech3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $fasility_flexibility5 = isset($fasility_flexibility['5']) ? $fasility_flexibility['5'] : 0;
                $fasility_flexibility4 = isset($fasility_flexibility['4']) ? $fasility_flexibility['4'] : 0;
                $fasility_flexibility3 = isset($fasility_flexibility['3']) ? $fasility_flexibility['3'] : 0;
                $fasility_flexibility['kepuasan'] = number_format((($fasility_flexibility5 + $fasility_flexibility4 + $fasility_flexibility3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $scale_up_skill5 = isset($scale_up_skill['5']) ? $scale_up_skill['5'] : 0;
                $scale_up_skill4 = isset($scale_up_skill['4']) ? $scale_up_skill['4'] : 0;
                $scale_up_skill3 = isset($scale_up_skill['3']) ? $scale_up_skill['3'] : 0;
                $scale_up_skill['kepuasan'] = number_format((($scale_up_skill5 + $scale_up_skill4 + $scale_up_skill3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $material_cost5 = isset($material_cost['5']) ? $material_cost['5'] : 0;
                $material_cost4 = isset($material_cost['4']) ? $material_cost['4'] : 0;
                $material_cost3 = isset($material_cost['3']) ? $material_cost['3'] : 0;
                $material_cost['kepuasan'] = number_format((($material_cost5 + $material_cost4 + $material_cost3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $dataSend = [
                    'Kecanggihan teknologi dari fasilitas dan peralatan yang dimiliki pesaing' => floatval($advanced_tech['kepuasan']),
                    'Fleksibilitas fasilitas dan peralatan yang dimiliki pesaing' => floatval($fasility_flexibility['kepuasan']),
                    'Keterampilan pesaing dalam penambahan kapasitas, pengendalian kualitas, penggunaan fasilitas, dan peralatan' => floatval($scale_up_skill['kepuasan']),
                    'Akses dan biaya bahan baku yang dialokasikan pesaing' => floatval($material_cost['kepuasan']),
                ];

                $dataSend = $this->customSort($dataSend);
                return response()->json([
                    [
                        'Kepuasan' => (float) $dataAllKategory['perhitungan_index_aspek']['operasional']['kepuasan'] * 100,
                    ],
                    $dataSend
                ]);
            }
            if ($category == 'riset') {
                $copyrights = [];
                $rnd_ability = [];
                $staff_skill = [];
                $resource_access = [];

                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'copyrights') {
                            array_push($copyrights, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'rnd_ability') {
                            array_push($rnd_ability, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'staff_skill') {
                            array_push($staff_skill, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'resource_access') {
                            array_push($resource_access, $value2);
                        }
                    }
                }

                $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['riset']['total'];

                $copyrights = $this->countValues($copyrights);
                $rnd_ability = $this->countValues($rnd_ability);
                $staff_skill = $this->countValues($staff_skill);
                $resource_access = $this->countValues($resource_access);

                $copyrights5 = isset($copyrights['5']) ? $copyrights['5'] : 0;
                $copyrights4 = isset($copyrights['4']) ? $copyrights['4'] : 0;
                $copyrights3 = isset($copyrights['3']) ? $copyrights['3'] : 0;
                $copyrights['kepuasan'] = number_format((($copyrights5 + $copyrights4 + $copyrights3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $rnd_ability5 = isset($rnd_ability['5']) ? $rnd_ability['5'] : 0;
                $rnd_ability4 = isset($rnd_ability['4']) ? $rnd_ability['4'] : 0;
                $rnd_ability3 = isset($rnd_ability['3']) ? $rnd_ability['3'] : 0;
                $rnd_ability['kepuasan'] = number_format((($rnd_ability5 + $rnd_ability4 + $rnd_ability3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $staff_skill5 = isset($staff_skill['5']) ? $staff_skill['5'] : 0;
                $staff_skill4 = isset($staff_skill['4']) ? $staff_skill['4'] : 0;
                $staff_skill3 = isset($staff_skill['3']) ? $staff_skill['3'] : 0;
                $staff_skill['kepuasan'] = number_format((($staff_skill5 + $staff_skill4 + $staff_skill3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $resource_access5 = isset($resource_access['5']) ? $resource_access['5'] : 0;
                $resource_access4 = isset($resource_access['4']) ? $resource_access['4'] : 0;
                $resource_access3 = isset($resource_access['3']) ? $resource_access['3'] : 0;
                $resource_access['kepuasan'] = number_format((($resource_access5 + $resource_access4 + $resource_access3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $dataSend = [
                    'Paten dan hak cipta yang dimiliki pesaing' => floatval($copyrights['kepuasan']),
                    'Kemampuan internal perusahaan pesaing dalam proses riset dan pengembangan' => floatval($rnd_ability['kepuasan']),
                    'Keterampilan staf divisi riset dan pengembangan pesaing' => floatval($staff_skill['kepuasan']),
                    'Akses pesaing ke sumber-sumber eksternal perusahaan untuk penguatan riset dan pengembangan' => floatval($resource_access['kepuasan']),
                ];

                $dataSend = $this->customSort($dataSend);
                return response()->json([
                    [
                        'Kepuasan' => (float) $dataAllKategory['perhitungan_index_aspek']['riset']['kepuasan'] * 100,
                    ],
                    $dataSend
                ]);
            }
            if ($category == 'keuangan') {
                $cash_flow = [];
                $capital_capacity = [];
                $trust_management = [];

                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'cash_flow') {
                            array_push($cash_flow, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'capital_capacity') {
                            array_push($capital_capacity, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'trust_management') {
                            array_push($trust_management, $value2);
                        }
                    }
                }

                $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['keuangan']['total'];

                $cash_flow = $this->countValues($cash_flow);
                $capital_capacity = $this->countValues($capital_capacity);
                $trust_management = $this->countValues($trust_management);

                $cash_flow5 = isset($cash_flow['5']) ? $cash_flow['5'] : 0;
                $cash_flow4 = isset($cash_flow['4']) ? $cash_flow['4'] : 0;
                $cash_flow3 = isset($cash_flow['3']) ? $cash_flow['3'] : 0;
                $cash_flow['kepuasan'] = number_format((($cash_flow5 + $cash_flow4 + $cash_flow3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $capital_capacity5 = isset($capital_capacity['5']) ? $capital_capacity['5'] : 0;
                $capital_capacity4 = isset($capital_capacity['4']) ? $capital_capacity['4'] : 0;
                $capital_capacity3 = isset($capital_capacity['3']) ? $capital_capacity['3'] : 0;
                $capital_capacity['kepuasan'] = number_format((($capital_capacity5 + $capital_capacity4 + $capital_capacity3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $trust_management5 = isset($trust_management['5']) ? $trust_management['5'] : 0;
                $trust_management4 = isset($trust_management['4']) ? $trust_management['4'] : 0;
                $trust_management3 = isset($trust_management['3']) ? $trust_management['3'] : 0;
                $trust_management['kepuasan'] = number_format((($trust_management5 + $trust_management4 + $trust_management3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $dataSend = [
                    'Arus kas pesaing' => floatval($cash_flow['kepuasan']),
                    'Kapasitas modal baru yang dimiliki pesaing untuk bisnis masa depan' => floatval($capital_capacity['kepuasan']),
                    'Kemampuan manajemen keuangan pesaing, termasuk negosiasi, mendapatkan modal, kredit, persediaan, serta piutang' => floatval($trust_management['kepuasan']),
                ];

                $dataSend = $this->customSort($dataSend);
                return response()->json([
                    [
                        'Kepuasan' => (float) $dataAllKategory['perhitungan_index_aspek']['keuangan']['kepuasan'] * 100,
                    ],
                    $dataSend
                ]);
            }
            if ($category == 'organisasi') {
                $vision_mission = [];
                $consistency_organization_structure = [];

                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'vision_mission') {
                            array_push($vision_mission, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'consistency_organization_structure') {
                            array_push($consistency_organization_structure, $value2);
                        }
                    }
                }

                $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['organisasi']['total'];

                $vision_mission = $this->countValues($vision_mission);
                $consistency_organization_structure = $this->countValues($consistency_organization_structure);

                $vision_mission5 = isset($vision_mission['5']) ? $vision_mission['5'] : 0;
                $vision_mission4 = isset($vision_mission['4']) ? $vision_mission['4'] : 0;
                $vision_mission3 = isset($vision_mission['3']) ? $vision_mission['3'] : 0;
                $vision_mission['kepuasan'] = number_format((($vision_mission5 + $vision_mission4 + $vision_mission3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $consistency_organization_structure5 = isset($consistency_organization_structure['5']) ? $consistency_organization_structure['5'] : 0;
                $consistency_organization_structure4 = isset($consistency_organization_structure['4']) ? $consistency_organization_structure['4'] : 0;
                $consistency_organization_structure3 = isset($consistency_organization_structure['3']) ? $consistency_organization_structure['3'] : 0;
                $consistency_organization_structure['kepuasan'] = number_format((($consistency_organization_structure5 + $consistency_organization_structure4 + $consistency_organization_structure3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $dataSend = [
                    'Keseragaman nilai dan kejelasan misi dan tujuan organisasi pesaing' => floatval($vision_mission['kepuasan']),
                    'Konsistensi struktur organisasi dengan strategi bisnis pesaing' => floatval($consistency_organization_structure['kepuasan']),
                ];

                $dataSend = $this->customSort($dataSend);
                return response()->json([
                    [
                        'Kepuasan' => (float) $dataAllKategory['perhitungan_index_aspek']['organisasi']['kepuasan'] * 100,
                    ],
                    $dataSend
                ]);
            }
            if ($category == 'manajerial') {
                $lead_quality = [];
                $management_ability = [];

                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'lead_quality') {
                            array_push($lead_quality, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'management_ability') {
                            array_push($management_ability, $value2);
                        }
                    }
                }

                $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['manajerial']['total'];

                $lead_quality = $this->countValues($lead_quality);
                $management_ability = $this->countValues($management_ability);

                $lead_quality5 = isset($lead_quality['5']) ? $lead_quality['5'] : 0;
                $lead_quality4 = isset($lead_quality['4']) ? $lead_quality['4'] : 0;
                $lead_quality3 = isset($lead_quality['3']) ? $lead_quality['3'] : 0;
                $lead_quality['kepuasan'] = number_format((($lead_quality5 + $lead_quality4 + $lead_quality3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $management_ability5 = isset($management_ability['5']) ? $management_ability['5'] : 0;
                $management_ability4 = isset($management_ability['4']) ? $management_ability['4'] : 0;
                $management_ability3 = isset($management_ability['3']) ? $management_ability['3'] : 0;
                $management_ability['kepuasan'] = number_format((($management_ability5 + $management_ability4 + $management_ability3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $dataSend = [
                    'Kualitas kepemimpinan CEO pesaing - kemampuan Direktur Utama untuk memotivasi' => floatval($lead_quality['kepuasan']),
                    'Kemampuan manajemen perusahaan pesaing untuk mengkoordinasi fungsi atau kelompok fungsi tertentu (misalnya koordinasi pengembangan produk dengan riset)' => floatval($management_ability['kepuasan']),
                ];

                $dataSend = $this->customSort($dataSend);
                return response()->json([
                    [
                        'Kepuasan' => (float) $dataAllKategory['perhitungan_index_aspek']['manajerial']['kepuasan'] * 100,
                    ],
                    $dataSend
                ]);
            }
            if ($category == 'inti') {
                $functional_ability = [];
                $measurement_ability = [];
                $movement_response = [];
                $response_to_change = [];
                $competition_ability = [];

                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'functional_ability') {
                            array_push($functional_ability, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'measurement_ability') {
                            array_push($measurement_ability, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'movement_response') {
                            array_push($movement_response, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'response_to_change') {
                            array_push($response_to_change, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'competition_ability') {
                            array_push($competition_ability, $value2);
                        }
                    }
                }

                $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['inti']['total'];

                $functional_ability = $this->countValues($functional_ability);
                $measurement_ability = $this->countValues($measurement_ability);
                $movement_response = $this->countValues($movement_response);
                $response_to_change = $this->countValues($response_to_change);
                $competition_ability = $this->countValues($competition_ability);

                $functional_ability5 = isset($functional_ability['5']) ? $functional_ability['5'] : 0;
                $functional_ability4 = isset($functional_ability['4']) ? $functional_ability['4'] : 0;
                $functional_ability3 = isset($functional_ability['3']) ? $functional_ability['3'] : 0;
                $functional_ability['kepuasan'] = number_format((($functional_ability5 + $functional_ability4 + $functional_ability3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $measurement_ability5 = isset($measurement_ability['5']) ? $measurement_ability['5'] : 0;
                $measurement_ability4 = isset($measurement_ability['4']) ? $measurement_ability['4'] : 0;
                $measurement_ability3 = isset($measurement_ability['3']) ? $measurement_ability['3'] : 0;
                $measurement_ability['kepuasan'] = number_format((($measurement_ability5 + $measurement_ability4 + $measurement_ability3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $movement_response5 = isset($movement_response['5']) ? $movement_response['5'] : 0;
                $movement_response4 = isset($movement_response['4']) ? $movement_response['4'] : 0;
                $movement_response3 = isset($movement_response['3']) ? $movement_response['3'] : 0;
                $movement_response['kepuasan'] = number_format((($movement_response5 + $movement_response4 + $movement_response3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $response_to_change5 = isset($response_to_change['5']) ? $response_to_change['5'] : 0;
                $response_to_change4 = isset($response_to_change['4']) ? $response_to_change['4'] : 0;
                $response_to_change3 = isset($response_to_change['3']) ? $response_to_change['3'] : 0;
                $response_to_change['kepuasan'] = number_format((($response_to_change5 + $response_to_change4 + $response_to_change3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $competition_ability5 = isset($competition_ability['5']) ? $competition_ability['5'] : 0;
                $competition_ability4 = isset($competition_ability['4']) ? $competition_ability['4'] : 0;
                $competition_ability3 = isset($competition_ability['3']) ? $competition_ability['3'] : 0;
                $competition_ability['kepuasan'] = number_format((($competition_ability5 + $competition_ability4 + $competition_ability3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $dataSend = [
                    'Kemampuan pesaing dalam bidang fungsional' => floatval($functional_ability['kepuasan']),
                    'Kemampuan pesaing mengukur konsistensi dari strateginya' => floatval($measurement_ability['kepuasan']),
                    'Kapasitas pesaing dalam menanggapi gerakan pihak lain (misalnya produk baru yang belum diperkenalkan, tetapi sudah siap untuk diluncurkan)' => floatval($movement_response['kepuasan']),
                    'Kemampuan pesaing dalam menyesuaikan diri dan merespon kondisi yang berubah di setiap bidang fungsional (misalnya menyesuaikan diri untuk bersaing dalam harga, mengelola lini produk yang lebih kompleks, menambah produk baru, bersaing dalam layanan, meningkatkan kegiatan pemasaran)' => floatval($response_to_change['kepuasan']),
                    'Kemampuan pesaing untuk bertahan dari perang persaingan yang berkepanjangan, yang mungkin akan menekan laba dan arus kas' => floatval($competition_ability['kepuasan']),
                ];

                $dataSend = $this->customSort($dataSend);
                return response()->json([
                    [
                        'Kepuasan' => (float) $dataAllKategory['perhitungan_index_aspek']['inti']['kepuasan'] * 100,
                    ],
                    $dataSend
                ]);
            }
            if ($category == 'portofolio') {
                $support_change = [];
                $strengthening_ability = [];

                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'support_change') {
                            array_push($support_change, $value2);
                        }
                    }
                }
                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'strengthening_ability') {
                            array_push($strengthening_ability, $value2);
                        }
                    }
                }

                $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['portofolio']['total'];

                $support_change = $this->countValues($support_change);
                $strengthening_ability = $this->countValues($strengthening_ability);

                $support_change5 = isset($support_change['5']) ? $support_change['5'] : 0;
                $support_change4 = isset($support_change['4']) ? $support_change['4'] : 0;
                $support_change3 = isset($support_change['3']) ? $support_change['3'] : 0;
                $support_change['kepuasan'] = number_format((($support_change5 + $support_change4 + $support_change3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $strengthening_ability5 = isset($strengthening_ability['5']) ? $strengthening_ability['5'] : 0;
                $strengthening_ability4 = isset($strengthening_ability['4']) ? $strengthening_ability['4'] : 0;
                $strengthening_ability3 = isset($strengthening_ability['3']) ? $strengthening_ability['3'] : 0;
                $strengthening_ability['kepuasan'] = number_format((($strengthening_ability5 + $strengthening_ability4 + $strengthening_ability3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $dataSend = [
                    'Kemampuan pesaing untuk mendukung perubahan yang terencana dalam semua unit bisnisnya dalam bentuk sumber dana dan sumber daya lain' => floatval($support_change['kepuasan']),
                    'Kemampuan pesaing untuk melengkapi atau memperkokoh kekuatan unit bisnisnya' => floatval($strengthening_ability['kepuasan']),
                ];

                $dataSend = $this->customSort($dataSend);
                return response()->json([
                    [
                        'Kepuasan' => (float) $dataAllKategory['perhitungan_index_aspek']['portofolio']['kepuasan'] * 100,
                    ],
                    $dataSend
                ]);
            }
            if ($category == 'lainnya') {
                $special_treatment = [];

                foreach ($dataAnswer as $value) {
                    foreach ($value as $key => $value2) {
                        if ($key === 'special_treatment') {
                            array_push($special_treatment, $value2);
                        }
                    }
                }

                $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['lainnya']['total'];

                $special_treatment = $this->countValues($special_treatment);

                $special_treatment5 = isset($special_treatment['5']) ? $special_treatment['5'] : 0;
                $special_treatment4 = isset($special_treatment['4']) ? $special_treatment['4'] : 0;
                $special_treatment3 = isset($special_treatment['3']) ? $special_treatment['3'] : 0;
                $special_treatment['kepuasan'] = number_format((($special_treatment5 + $special_treatment4 + $special_treatment3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                $dataSend = [
                    'Perlakuan khusus atau akses pesaing ke lembaga pemerintahan' => floatval($special_treatment['kepuasan']),
                ];

                $dataSend = $this->customSort($dataSend);
                return response()->json([
                    [
                        'Kepuasan' => (float) $dataAllKategory['perhitungan_index_aspek']['lainnya']['kepuasan'] * 100,
                    ],
                    $dataSend
                ]);
            }
        } catch (\Throwable $th) {
            $returnData = [
                'status' => 'error',
                'message' => 'error server',
            ];
            return response()->json($returnData, 500);
        }
    }

    public function getPertanyaanKekuatanKelemahanByRespondents($category, $area)
    {
        $location_name = base64_decode($area);
        $endPointApi = env('PYTHON_END_POINT') . 'ai';
        $dataAnswerRaw = [];
        $dataAnswerLoop = [];

        try {
            $dataAI = [Http::get($endPointApi)->json()['data']][0];
            // set customer data berdasarkan daerah sesuai parameter
            foreach ($dataAI['competitor_identifier_data'] as $value) {
                if ($value['location']['name'] === $location_name) {
                    $dataAnswerRaw = $value['answer'];
                    break;
                }
            }

            // set index for dataAnswerLoop 
            for ($i = 0; $i < count($dataAnswerRaw); $i++) {
                $dataAnswerLoop[$i] = [];
            }

            // insert data into dataAnswerLoop based on count index
            for ($i = 0; $i < count($dataAnswerRaw); $i++) {
                for ($j = 0; $j <= $i; $j++) {
                    array_push($dataAnswerLoop[$i], $dataAnswerRaw[$j]);
                }
            }

            $productFinal = [];
            $pemasaranFinal = [];
            $distribusiFinal = [];
            $operasionalFinal = [];
            $risetFinal = [];
            $keuanganFinal = [];
            $organisasiFinal = [];
            $manajerialFinal = [];
            $intiFinal = [];
            $portofolioFinal = [];
            $lainnyaFinal = [];

            $totalProductFinal = [];
            $totalPemasaranFinal = [];
            $totalDistribusiFinal = [];
            $totalOperasionalFinal = [];
            $totalRisetFinal = [];
            $totalKeuanganFinal = [];
            $totalOrganisasiFinal = [];
            $totalManajerialFinal = [];
            $totalIntiFinal = [];
            $totalPortofolioFinal = [];
            $totalLainnyaFinal = [];

            foreach ($dataAnswerLoop as $key => $dataAnswer) {
                $dataAllKategory = $this->kekuatanKelemahanDaerah($dataAnswer);

                if ($category == 'product') {
                    $position_pov = [];
                    $deep = [];

                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'position_pov') {
                                array_push($position_pov, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'deep') {
                                array_push($deep, $value2);
                            }
                        }
                    }

                    $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['product']['total'];

                    $position_pov = $this->countValues($position_pov);
                    $deep = $this->countValues($deep);

                    $position_pov5 = isset($position_pov['5']) ? $position_pov['5'] : 0;
                    $position_pov4 = isset($position_pov['4']) ? $position_pov['4'] : 0;
                    $position_pov3 = isset($position_pov['3']) ? $position_pov['3'] : 0;
                    $position_pov['kepuasan'] = number_format((($position_pov5 + $position_pov4 + $position_pov3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $deep5 = isset($deep['5']) ? $deep['5'] : 0;
                    $deep4 = isset($deep['4']) ? $deep['4'] : 0;
                    $deep3 = isset($deep['3']) ? $deep['3'] : 0;
                    $deep['kepuasan'] = number_format((($deep5 + $deep4 + $deep3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $dataByCountIndex = [
                        'Kedudukan Pesaing' => floatval($position_pov['kepuasan']),
                        'Lini Produk' => floatval($deep['kepuasan']),
                    ];
                    $total = ['total' => (int) array_sum($dataByCountIndex)];

                    array_push($totalProductFinal, $total);
                    array_push($productFinal, $dataByCountIndex);
                }
                if ($category == 'pemasaran') {
                    $marketing_skill = [];
                    $dev_skill = [];

                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'marketing_skill') {
                                array_push($marketing_skill, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'dev_skill') {
                                array_push($dev_skill, $value2);
                            }
                        }
                    }

                    $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['pemasaran']['total'];

                    $marketing_skill = $this->countValues($marketing_skill);
                    $dev_skill = $this->countValues($dev_skill);

                    $marketing_skill5 = isset($marketing_skill['5']) ? $marketing_skill['5'] : 0;
                    $marketing_skill4 = isset($marketing_skill['4']) ? $marketing_skill['4'] : 0;
                    $marketing_skill3 = isset($marketing_skill['3']) ? $marketing_skill['3'] : 0;
                    $marketing_skill['kepuasan'] = number_format((($marketing_skill5 + $marketing_skill4 + $marketing_skill3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $dev_skill5 = isset($dev_skill['5']) ? $dev_skill['5'] : 0;
                    $dev_skill4 = isset($dev_skill['4']) ? $dev_skill['4'] : 0;
                    $dev_skill3 = isset($dev_skill['3']) ? $dev_skill['3'] : 0;
                    $dev_skill['kepuasan'] = number_format((($dev_skill5 + $dev_skill4 + $dev_skill3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $dataByCountIndex = [
                        'Keterampilan Pesaing' => floatval($marketing_skill['kepuasan']),
                        'Pengembangan Produk' => floatval($dev_skill['kepuasan']),
                    ];
                    $total = ['total' => (int) array_sum($dataByCountIndex)];

                    array_push($totalPemasaranFinal, $total);
                    array_push($pemasaranFinal, $dataByCountIndex);
                }
                if ($category == 'distribusi') {
                    $distribution_line = [];
                    $line_power = [];
                    $line_ability = [];

                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'distribution_line') {
                                array_push($distribution_line, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'line_power') {
                                array_push($line_power, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'line_ability') {
                                array_push($line_ability, $value2);
                            }
                        }
                    }

                    $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['distribusi']['total'];

                    $distribution_line = $this->countValues($distribution_line);
                    $line_power = $this->countValues($line_power);
                    $line_ability = $this->countValues($line_ability);

                    $distribution_line5 = isset($distribution_line['5']) ? $distribution_line['5'] : 0;
                    $distribution_line4 = isset($distribution_line['4']) ? $distribution_line['4'] : 0;
                    $distribution_line3 = isset($distribution_line['3']) ? $distribution_line['3'] : 0;
                    $distribution_line['kepuasan'] = number_format((($distribution_line5 + $distribution_line4 + $distribution_line3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $line_power5 = isset($line_power['5']) ? $line_power['5'] : 0;
                    $line_power4 = isset($line_power['4']) ? $line_power['4'] : 0;
                    $line_power3 = isset($line_power['3']) ? $line_power['3'] : 0;
                    $line_power['kepuasan'] = number_format((($line_power5 + $line_power4 + $line_power3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $line_ability5 = isset($line_ability['5']) ? $line_ability['5'] : 0;
                    $line_ability4 = isset($line_ability['4']) ? $line_ability['4'] : 0;
                    $line_ability3 = isset($line_ability['3']) ? $line_ability['3'] : 0;
                    $line_ability['kepuasan'] = number_format((($line_ability5 + $line_ability4 + $line_ability3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $dataByCountIndex = [
                        'Kualitas Distribusi' => floatval($distribution_line['kepuasan']),
                        'Hubungan Saluran' => floatval($line_power['kepuasan']),
                        'Pelayanan Distribusi' => floatval($line_ability['kepuasan']),
                    ];

                    $total = ['total' => (int) array_sum($dataByCountIndex)];

                    array_push($totalDistribusiFinal, $total);
                    array_push($distribusiFinal, $dataByCountIndex);
                }
                if ($category == 'operasional') {
                    $advanced_tech = [];
                    $fasility_flexibility = [];
                    $scale_up_skill = [];
                    $material_cost = [];

                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'advanced_tech') {
                                array_push($advanced_tech, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'fasility_flexibility') {
                                array_push($fasility_flexibility, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'scale_up_skill') {
                                array_push($scale_up_skill, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'material_cost') {
                                array_push($material_cost, $value2);
                            }
                        }
                    }

                    $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['operasional']['total'];

                    $advanced_tech = $this->countValues($advanced_tech);
                    $fasility_flexibility = $this->countValues($fasility_flexibility);
                    $scale_up_skill = $this->countValues($scale_up_skill);
                    $material_cost = $this->countValues($material_cost);

                    $advanced_tech5 = isset($advanced_tech['5']) ? $advanced_tech['5'] : 0;
                    $advanced_tech4 = isset($advanced_tech['4']) ? $advanced_tech['4'] : 0;
                    $advanced_tech3 = isset($advanced_tech['3']) ? $advanced_tech['3'] : 0;
                    $advanced_tech['kepuasan'] = number_format((($advanced_tech5 + $advanced_tech4 + $advanced_tech3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $fasility_flexibility5 = isset($fasility_flexibility['5']) ? $fasility_flexibility['5'] : 0;
                    $fasility_flexibility4 = isset($fasility_flexibility['4']) ? $fasility_flexibility['4'] : 0;
                    $fasility_flexibility3 = isset($fasility_flexibility['3']) ? $fasility_flexibility['3'] : 0;
                    $fasility_flexibility['kepuasan'] = number_format((($fasility_flexibility5 + $fasility_flexibility4 + $fasility_flexibility3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $scale_up_skill5 = isset($scale_up_skill['5']) ? $scale_up_skill['5'] : 0;
                    $scale_up_skill4 = isset($scale_up_skill['4']) ? $scale_up_skill['4'] : 0;
                    $scale_up_skill3 = isset($scale_up_skill['3']) ? $scale_up_skill['3'] : 0;
                    $scale_up_skill['kepuasan'] = number_format((($scale_up_skill5 + $scale_up_skill4 + $scale_up_skill3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $material_cost5 = isset($material_cost['5']) ? $material_cost['5'] : 0;
                    $material_cost4 = isset($material_cost['4']) ? $material_cost['4'] : 0;
                    $material_cost3 = isset($material_cost['3']) ? $material_cost['3'] : 0;
                    $material_cost['kepuasan'] = number_format((($material_cost5 + $material_cost4 + $material_cost3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $dataByCountIndex = [
                        'Teknologi Pesaing' => floatval($advanced_tech['kepuasan']),
                        'Fleksibilitas Pesaing' => floatval($fasility_flexibility['kepuasan']),
                        'Keterampilan Pesaing' => floatval($scale_up_skill['kepuasan']),
                        'Akses Bahan Baku' => floatval($material_cost['kepuasan']),
                    ];
                    $total = ['total' => (int) array_sum($dataByCountIndex)];

                    array_push($totalOperasionalFinal, $total);
                    array_push($operasionalFinal, $dataByCountIndex);
                }
                if ($category == 'riset') {
                    $copyrights = [];
                    $rnd_ability = [];
                    $staff_skill = [];
                    $resource_access = [];

                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'copyrights') {
                                array_push($copyrights, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'rnd_ability') {
                                array_push($rnd_ability, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'staff_skill') {
                                array_push($staff_skill, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'resource_access') {
                                array_push($resource_access, $value2);
                            }
                        }
                    }

                    $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['riset']['total'];

                    $copyrights = $this->countValues($copyrights);
                    $rnd_ability = $this->countValues($rnd_ability);
                    $staff_skill = $this->countValues($staff_skill);
                    $resource_access = $this->countValues($resource_access);

                    $copyrights5 = isset($copyrights['5']) ? $copyrights['5'] : 0;
                    $copyrights4 = isset($copyrights['4']) ? $copyrights['4'] : 0;
                    $copyrights3 = isset($copyrights['3']) ? $copyrights['3'] : 0;
                    $copyrights['kepuasan'] = number_format((($copyrights5 + $copyrights4 + $copyrights3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $rnd_ability5 = isset($rnd_ability['5']) ? $rnd_ability['5'] : 0;
                    $rnd_ability4 = isset($rnd_ability['4']) ? $rnd_ability['4'] : 0;
                    $rnd_ability3 = isset($rnd_ability['3']) ? $rnd_ability['3'] : 0;
                    $rnd_ability['kepuasan'] = number_format((($rnd_ability5 + $rnd_ability4 + $rnd_ability3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $staff_skill5 = isset($staff_skill['5']) ? $staff_skill['5'] : 0;
                    $staff_skill4 = isset($staff_skill['4']) ? $staff_skill['4'] : 0;
                    $staff_skill3 = isset($staff_skill['3']) ? $staff_skill['3'] : 0;
                    $staff_skill['kepuasan'] = number_format((($staff_skill5 + $staff_skill4 + $staff_skill3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $resource_access5 = isset($resource_access['5']) ? $resource_access['5'] : 0;
                    $resource_access4 = isset($resource_access['4']) ? $resource_access['4'] : 0;
                    $resource_access3 = isset($resource_access['3']) ? $resource_access['3'] : 0;
                    $resource_access['kepuasan'] = number_format((($resource_access5 + $resource_access4 + $resource_access3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $dataByCountIndex = [
                        'Paten Pesaing' => floatval($copyrights['kepuasan']),
                        'Riset Internal Pesaing' => floatval($rnd_ability['kepuasan']),
                        'Keterampilan Riset Pesaing' => floatval($staff_skill['kepuasan']),
                        'Akses Riset Eksternal Pesaing' => floatval($resource_access['kepuasan']),
                    ];
                    $total = ['total' => (int) array_sum($dataByCountIndex)];

                    array_push($totalRisetFinal, $total);
                    array_push($risetFinal, $dataByCountIndex);
                }
                if ($category == 'keuangan') {
                    $cash_flow = [];
                    $capital_capacity = [];
                    $trust_management = [];

                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'cash_flow') {
                                array_push($cash_flow, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'capital_capacity') {
                                array_push($capital_capacity, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'trust_management') {
                                array_push($trust_management, $value2);
                            }
                        }
                    }

                    $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['keuangan']['total'];

                    $cash_flow = $this->countValues($cash_flow);
                    $capital_capacity = $this->countValues($capital_capacity);
                    $trust_management = $this->countValues($trust_management);

                    $cash_flow5 = isset($cash_flow['5']) ? $cash_flow['5'] : 0;
                    $cash_flow4 = isset($cash_flow['4']) ? $cash_flow['4'] : 0;
                    $cash_flow3 = isset($cash_flow['3']) ? $cash_flow['3'] : 0;
                    $cash_flow['kepuasan'] = number_format((($cash_flow5 + $cash_flow4 + $cash_flow3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $capital_capacity5 = isset($capital_capacity['5']) ? $capital_capacity['5'] : 0;
                    $capital_capacity4 = isset($capital_capacity['4']) ? $capital_capacity['4'] : 0;
                    $capital_capacity3 = isset($capital_capacity['3']) ? $capital_capacity['3'] : 0;
                    $capital_capacity['kepuasan'] = number_format((($capital_capacity5 + $capital_capacity4 + $capital_capacity3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $trust_management5 = isset($trust_management['5']) ? $trust_management['5'] : 0;
                    $trust_management4 = isset($trust_management['4']) ? $trust_management['4'] : 0;
                    $trust_management3 = isset($trust_management['3']) ? $trust_management['3'] : 0;
                    $trust_management['kepuasan'] = number_format((($trust_management5 + $trust_management4 + $trust_management3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $dataByCountIndex = [
                        'Arus kas pesaing' => floatval($cash_flow['kepuasan']),
                        'Modal Baru Pesaing' => floatval($capital_capacity['kepuasan']),
                        'Manajemen Keuangan Pesaing' => floatval($trust_management['kepuasan']),
                    ];
                    $total = ['total' => (int) array_sum($dataByCountIndex)];

                    array_push($totalKeuanganFinal, $total);
                    array_push($keuanganFinal, $dataByCountIndex);
                }
                if ($category == 'organisasi') {
                    $vision_mission = [];
                    $consistency_organization_structure = [];

                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'vision_mission') {
                                array_push($vision_mission, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'consistency_organization_structure') {
                                array_push($consistency_organization_structure, $value2);
                            }
                        }
                    }

                    $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['organisasi']['total'];

                    $vision_mission = $this->countValues($vision_mission);
                    $consistency_organization_structure = $this->countValues($consistency_organization_structure);

                    $vision_mission5 = isset($vision_mission['5']) ? $vision_mission['5'] : 0;
                    $vision_mission4 = isset($vision_mission['4']) ? $vision_mission['4'] : 0;
                    $vision_mission3 = isset($vision_mission['3']) ? $vision_mission['3'] : 0;
                    $vision_mission['kepuasan'] = number_format((($vision_mission5 + $vision_mission4 + $vision_mission3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $consistency_organization_structure5 = isset($consistency_organization_structure['5']) ? $consistency_organization_structure['5'] : 0;
                    $consistency_organization_structure4 = isset($consistency_organization_structure['4']) ? $consistency_organization_structure['4'] : 0;
                    $consistency_organization_structure3 = isset($consistency_organization_structure['3']) ? $consistency_organization_structure['3'] : 0;
                    $consistency_organization_structure['kepuasan'] = number_format((($consistency_organization_structure5 + $consistency_organization_structure4 + $consistency_organization_structure3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $dataByCountIndex = [
                        'Misi Pesaing' => floatval($vision_mission['kepuasan']),
                        'Struktur Organisasi Pesaing' => floatval($consistency_organization_structure['kepuasan']),
                    ];
                    $total = ['total' => (int) array_sum($dataByCountIndex)];

                    array_push($totalOrganisasiFinal, $total);
                    array_push($organisasiFinal, $dataByCountIndex);
                }
                if ($category == 'manajerial') {
                    $lead_quality = [];
                    $management_ability = [];

                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'lead_quality') {
                                array_push($lead_quality, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'management_ability') {
                                array_push($management_ability, $value2);
                            }
                        }
                    }

                    $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['manajerial']['total'];

                    $lead_quality = $this->countValues($lead_quality);
                    $management_ability = $this->countValues($management_ability);

                    $lead_quality5 = isset($lead_quality['5']) ? $lead_quality['5'] : 0;
                    $lead_quality4 = isset($lead_quality['4']) ? $lead_quality['4'] : 0;
                    $lead_quality3 = isset($lead_quality['3']) ? $lead_quality['3'] : 0;
                    $lead_quality['kepuasan'] = number_format((($lead_quality5 + $lead_quality4 + $lead_quality3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $management_ability5 = isset($management_ability['5']) ? $management_ability['5'] : 0;
                    $management_ability4 = isset($management_ability['4']) ? $management_ability['4'] : 0;
                    $management_ability3 = isset($management_ability['3']) ? $management_ability['3'] : 0;
                    $management_ability['kepuasan'] = number_format((($management_ability5 + $management_ability4 + $management_ability3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $dataByCountIndex = [
                        'Kualitas Kepemimpinan CEO' => floatval($lead_quality['kepuasan']),
                        'Kemampuan Manajemen Perusahaan' => floatval($management_ability['kepuasan']),
                    ];
                    $total = ['total' => (int) array_sum($dataByCountIndex)];

                    array_push($totalManajerialFinal, $total);
                    array_push($manajerialFinal, $dataByCountIndex);
                }
                if ($category == 'inti') {
                    $functional_ability = [];
                    $measurement_ability = [];
                    $movement_response = [];
                    $response_to_change = [];
                    $competition_ability = [];

                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'functional_ability') {
                                array_push($functional_ability, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'measurement_ability') {
                                array_push($measurement_ability, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'movement_response') {
                                array_push($movement_response, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'response_to_change') {
                                array_push($response_to_change, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'competition_ability') {
                                array_push($competition_ability, $value2);
                            }
                        }
                    }

                    $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['inti']['total'];

                    $functional_ability = $this->countValues($functional_ability);
                    $measurement_ability = $this->countValues($measurement_ability);
                    $movement_response = $this->countValues($movement_response);
                    $response_to_change = $this->countValues($response_to_change);
                    $competition_ability = $this->countValues($competition_ability);

                    $functional_ability5 = isset($functional_ability['5']) ? $functional_ability['5'] : 0;
                    $functional_ability4 = isset($functional_ability['4']) ? $functional_ability['4'] : 0;
                    $functional_ability3 = isset($functional_ability['3']) ? $functional_ability['3'] : 0;
                    $functional_ability['kepuasan'] = number_format((($functional_ability5 + $functional_ability4 + $functional_ability3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $measurement_ability5 = isset($measurement_ability['5']) ? $measurement_ability['5'] : 0;
                    $measurement_ability4 = isset($measurement_ability['4']) ? $measurement_ability['4'] : 0;
                    $measurement_ability3 = isset($measurement_ability['3']) ? $measurement_ability['3'] : 0;
                    $measurement_ability['kepuasan'] = number_format((($measurement_ability5 + $measurement_ability4 + $measurement_ability3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $movement_response5 = isset($movement_response['5']) ? $movement_response['5'] : 0;
                    $movement_response4 = isset($movement_response['4']) ? $movement_response['4'] : 0;
                    $movement_response3 = isset($movement_response['3']) ? $movement_response['3'] : 0;
                    $movement_response['kepuasan'] = number_format((($movement_response5 + $movement_response4 + $movement_response3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $response_to_change5 = isset($response_to_change['5']) ? $response_to_change['5'] : 0;
                    $response_to_change4 = isset($response_to_change['4']) ? $response_to_change['4'] : 0;
                    $response_to_change3 = isset($response_to_change['3']) ? $response_to_change['3'] : 0;
                    $response_to_change['kepuasan'] = number_format((($response_to_change5 + $response_to_change4 + $response_to_change3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $competition_ability5 = isset($competition_ability['5']) ? $competition_ability['5'] : 0;
                    $competition_ability4 = isset($competition_ability['4']) ? $competition_ability['4'] : 0;
                    $competition_ability3 = isset($competition_ability['3']) ? $competition_ability['3'] : 0;
                    $competition_ability['kepuasan'] = number_format((($competition_ability5 + $competition_ability4 + $competition_ability3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $dataByCountIndex = [
                        'Kemampuan Fungsional' => floatval($functional_ability['kepuasan']),
                        'Konsistensi Strategi' => floatval($measurement_ability['kepuasan']),
                        'Kapasitas Responsif' => floatval($movement_response['kepuasan']),
                        'Kemampuan Adaptasi' => floatval($response_to_change['kepuasan']),
                        'Kemampuan Bertahan' => floatval($competition_ability['kepuasan']),
                    ];
                    $total = ['total' => (int) array_sum($dataByCountIndex)];

                    array_push($totalIntiFinal, $total);
                    array_push($intiFinal, $dataByCountIndex);
                }
                if ($category == 'portofolio') {
                    $support_change = [];
                    $strengthening_ability = [];

                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'support_change') {
                                array_push($support_change, $value2);
                            }
                        }
                    }
                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'strengthening_ability') {
                                array_push($strengthening_ability, $value2);
                            }
                        }
                    }

                    $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['portofolio']['total'];

                    $support_change = $this->countValues($support_change);
                    $strengthening_ability = $this->countValues($strengthening_ability);

                    $support_change5 = isset($support_change['5']) ? $support_change['5'] : 0;
                    $support_change4 = isset($support_change['4']) ? $support_change['4'] : 0;
                    $support_change3 = isset($support_change['3']) ? $support_change['3'] : 0;
                    $support_change['kepuasan'] = number_format((($support_change5 + $support_change4 + $support_change3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $strengthening_ability5 = isset($strengthening_ability['5']) ? $strengthening_ability['5'] : 0;
                    $strengthening_ability4 = isset($strengthening_ability['4']) ? $strengthening_ability['4'] : 0;
                    $strengthening_ability3 = isset($strengthening_ability['3']) ? $strengthening_ability['3'] : 0;
                    $strengthening_ability['kepuasan'] = number_format((($strengthening_ability5 + $strengthening_ability4 + $strengthening_ability3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $dataByCountIndex = [
                        'Mendukung Perubahan' => floatval($support_change['kepuasan']),
                        'Mengokoh Unit' => floatval($strengthening_ability['kepuasan']),
                    ];
                    $total = ['total' => (int) array_sum($dataByCountIndex)];

                    array_push($totalPortofolioFinal, $total);
                    array_push($portofolioFinal, $dataByCountIndex);
                }
                if ($category == 'lainnya') {
                    $special_treatment = [];

                    foreach ($dataAnswer as $value) {
                        foreach ($value as $key => $value2) {
                            if ($key === 'special_treatment') {
                                array_push($special_treatment, $value2);
                            }
                        }
                    }

                    $dataTotalAllKategory = $dataAllKategory['penilaian_pelanggan']['lainnya']['total'];

                    $special_treatment = $this->countValues($special_treatment);

                    $special_treatment5 = isset($special_treatment['5']) ? $special_treatment['5'] : 0;
                    $special_treatment4 = isset($special_treatment['4']) ? $special_treatment['4'] : 0;
                    $special_treatment3 = isset($special_treatment['3']) ? $special_treatment['3'] : 0;
                    $special_treatment['kepuasan'] = number_format((($special_treatment5 + $special_treatment4 + $special_treatment3) / $dataTotalAllKategory) * 100, 2, '.', '') . '%';

                    $dataByCountIndex = [
                        'Akses Pemerintah' => floatval($special_treatment['kepuasan']),
                    ];
                    $total = ['total' => (int) array_sum($dataByCountIndex)];

                    array_push($totalLainnyaFinal, $total);
                    array_push($lainnyaFinal, $dataByCountIndex);
                }
            }

            if ($category == 'product') {
                return response()->json([(object)$productFinal, (object)$totalProductFinal], 200);
            }
            if ($category == 'pemasaran') {
                return response()->json([(object)$pemasaranFinal, (object)$totalPemasaranFinal], 200);
            }
            if ($category == 'distribusi') {
                return response()->json([(object)$distribusiFinal, (object)$totalDistribusiFinal], 200);
            }
            if ($category == 'operasional') {
                return response()->json([(object)$operasionalFinal, (object)$totalOperasionalFinal], 200);
            }
            if ($category == 'riset') {
                return response()->json([(object)$risetFinal, (object)$totalRisetFinal], 200);
            }
            if ($category == 'keuangan') {
                return response()->json([(object)$keuanganFinal, (object)$totalKeuanganFinal], 200);
            }
            if ($category == 'organisasi') {
                return response()->json([(object)$organisasiFinal, (object)$totalOrganisasiFinal], 200);
            }
            if ($category == 'manajerial') {
                return response()->json([(object)$manajerialFinal, (object)$totalManajerialFinal], 200);
            }
            if ($category == 'inti') {
                return response()->json([(object)$intiFinal, (object)$totalIntiFinal], 200);
            }
            if ($category == 'portofolio') {
                return response()->json([(object)$portofolioFinal, (object)$totalPortofolioFinal], 200);
            }
            if ($category == 'lainnya') {
                return response()->json([(object)$lainnyaFinal, (object)$totalLainnyaFinal], 200);
            }
        } catch (\Throwable $th) {
            $returnData = [
                'status' => 'error',
                'message' => 'error server',
            ];
            return response()->json($returnData, 500);
        }
    }

    public function laporanDaerah($daerah)
    {
        $location_name = base64_decode($daerah);
        return view('admin.laporanKota', compact('location_name'));
    }

    public function jawaban_kuisioner($type)
    {
        if ($type === 'customer') {
            return $this->kepuasan();
        } elseif ($type === 'competitor-identifier') {
            return $this->kekuatanKelemahan();
        }
    }

    function kepuasan()
    {
        $endPointApi = env('PYTHON_END_POINT') . 'customer';

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
        $product_index['index'] = number_format(
            $product_index['total'] / $product['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($product['5']) ? $product['5'] : 0;
        $value4 = isset($product['4']) ? $product['4'] : 0;
        $value3 = isset($product['3']) ? $product['3'] : 0;
        $product_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $product['total'],
                2,
                '.',
                ''
            ) . '%';

        //! promosi
        $promosi_index = [
            '1' => isset($promosi['1']) ? $promosi['1'] * 1 : 0,
            '2' => isset($promosi['2']) ? $promosi['2'] * 2 : 0,
            '3' => isset($promosi['3']) ? $promosi['3'] * 3 : 0,
            '4' => isset($promosi['4']) ? $promosi['4'] * 4 : 0,
            '5' => isset($promosi['5']) ? $promosi['5'] * 5 : 0,
        ];
        $promosi_index['total'] = array_sum($promosi_index);
        $promosi_index['index'] = number_format(
            $promosi_index['total'] / $promosi['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($promosi['5']) ? $promosi['5'] : 0;
        $value4 = isset($promosi['4']) ? $promosi['4'] : 0;
        $value3 = isset($promosi['3']) ? $promosi['3'] : 0;
        $promosi_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $promosi['total'],
                2,
                '.',
                ''
            ) . '%';

        //! kualitas_produk
        $kualitas_produk_index = [
            '1' => isset($kualitas_produk['1']) ? $kualitas_produk['1'] * 1 : 0,
            '2' => isset($kualitas_produk['2']) ? $kualitas_produk['2'] * 2 : 0,
            '3' => isset($kualitas_produk['3']) ? $kualitas_produk['3'] * 3 : 0,
            '4' => isset($kualitas_produk['4']) ? $kualitas_produk['4'] * 4 : 0,
            '5' => isset($kualitas_produk['5']) ? $kualitas_produk['5'] * 5 : 0,
        ];
        $kualitas_produk_index['total'] = array_sum($kualitas_produk_index);
        $kualitas_produk_index['index'] = number_format(
            $kualitas_produk_index['total'] / $kualitas_produk['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($kualitas_produk['5']) ? $kualitas_produk['5'] : 0;
        $value4 = isset($kualitas_produk['4']) ? $kualitas_produk['4'] : 0;
        $value3 = isset($kualitas_produk['3']) ? $kualitas_produk['3'] : 0;
        $kualitas_produk_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $kualitas_produk['total'],
                2,
                '.',
                ''
            ) . '%';

        //! layanan_petugas_lapang
        $layanan_petugas_lapang_index = [
            '1' => isset($layanan_petugas_lapang['1'])
                ? $layanan_petugas_lapang['1'] * 1
                : 0,
            '2' => isset($layanan_petugas_lapang['2'])
                ? $layanan_petugas_lapang['2'] * 2
                : 0,
            '3' => isset($layanan_petugas_lapang['3'])
                ? $layanan_petugas_lapang['3'] * 3
                : 0,
            '4' => isset($layanan_petugas_lapang['4'])
                ? $layanan_petugas_lapang['4'] * 4
                : 0,
            '5' => isset($layanan_petugas_lapang['5'])
                ? $layanan_petugas_lapang['5'] * 5
                : 0,
        ];
        $layanan_petugas_lapang_index['total'] = array_sum(
            $layanan_petugas_lapang_index
        );
        $layanan_petugas_lapang_index['index'] = number_format(
            $layanan_petugas_lapang_index['total'] /
                $layanan_petugas_lapang['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($layanan_petugas_lapang['5'])
            ? $layanan_petugas_lapang['5']
            : 0;
        $value4 = isset($layanan_petugas_lapang['4'])
            ? $layanan_petugas_lapang['4']
            : 0;
        $value3 = isset($layanan_petugas_lapang['3'])
            ? $layanan_petugas_lapang['3']
            : 0;
        $layanan_petugas_lapang_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) /
                    $layanan_petugas_lapang['total'],
                2,
                '.',
                ''
            ) . '%';

        //! penanganan_komplain
        $penanganan_komplain_index = [
            '1' => isset($penanganan_komplain['1'])
                ? $penanganan_komplain['1'] * 1
                : 0,
            '2' => isset($penanganan_komplain['2'])
                ? $penanganan_komplain['2'] * 2
                : 0,
            '3' => isset($penanganan_komplain['3'])
                ? $penanganan_komplain['3'] * 3
                : 0,
            '4' => isset($penanganan_komplain['4'])
                ? $penanganan_komplain['4'] * 4
                : 0,
            '5' => isset($penanganan_komplain['5'])
                ? $penanganan_komplain['5'] * 5
                : 0,
        ];
        $penanganan_komplain_index['total'] = array_sum(
            $penanganan_komplain_index
        );
        $penanganan_komplain_index['index'] = number_format(
            $penanganan_komplain_index['total'] / $penanganan_komplain['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($penanganan_komplain['5'])
            ? $penanganan_komplain['5']
            : 0;
        $value4 = isset($penanganan_komplain['4'])
            ? $penanganan_komplain['4']
            : 0;
        $value3 = isset($penanganan_komplain['3'])
            ? $penanganan_komplain['3']
            : 0;
        $penanganan_komplain_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $penanganan_komplain['total'],
                2,
                '.',
                ''
            ) . '%';

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

    function kekuatanKelemahan()
    {
        $endPointApi = env('PYTHON_END_POINT') . 'competitor-identifier';

        $dataAnswer = collect([Http::get($endPointApi)->json()])[0]['data'];
        $product = [];
        $distribusi = [];
        $pemasaran = [];
        $operasional = [];
        $riset = [];
        $keuangan = [];
        $organisasi = [];
        $manajerial = [];
        $inti = [];
        $portofolio = [];

        $allowedKeysProduct = ['position_pov', 'deep'];
        $allowedKeysDistribusi = [
            'distribution_line',
            'line_power',
            'line_ability',
        ];
        $allowedKeysPemasaran = ['marketing_skill', 'dev_skill'];
        $allowedKeysOperasional = [
            'advanced_tech',
            'fasility_flexibility',
            'scale_up_skill',
            'material_cost',
        ];
        $allowedKeysRiset = [
            'copyrights',
            'rnd_ability',
            'staff_skill',
            'resource_access',
        ];
        $allowedKeysKeuangan = [
            'cash_flow',
            'capital_capacity',
            'trust_management',
        ];
        $allowedKeysOrganisasi = [
            'vision_mission',
            'consistency_organization_structure',
        ];
        $allowedKeysManajerial = ['lead_quality', 'management_ability'];
        $allowedKeysInti = [
            'functional_ability',
            'measurement_ability',
            'movement_response',
            'response_to_change',
            'competition_ability',
        ];
        $allowedKeysPortofolio = [
            'support_change',
            'strengthening_ability',
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
                if (in_array($key, $allowedKeysDistribusi)) {
                    array_push($distribusi, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysPemasaran)) {
                    array_push($pemasaran, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysOperasional)) {
                    array_push($operasional, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysRiset)) {
                    array_push($riset, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysKeuangan)) {
                    array_push($keuangan, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysOrganisasi)) {
                    array_push($organisasi, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysManajerial)) {
                    array_push($manajerial, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysInti)) {
                    array_push($inti, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysPortofolio)) {
                    array_push($portofolio, $value2);
                }
            }
        }

        //penilaian pelanggan
        $product = $this->countValues($product);
        $distribusi = $this->countValues($distribusi);
        $pemasaran = $this->countValues($pemasaran);
        $operasional = $this->countValues($operasional);
        $riset = $this->countValues($riset);
        $keuangan = $this->countValues($keuangan);
        $organisasi = $this->countValues($organisasi);
        $manajerial = $this->countValues($manajerial);
        $inti = $this->countValues($inti);
        $portofolio = $this->countValues($portofolio);

        $product['total'] = array_sum($product);
        $distribusi['total'] = array_sum($distribusi);
        $pemasaran['total'] = array_sum($pemasaran);
        $operasional['total'] = array_sum($operasional);
        $riset['total'] = array_sum($riset);
        $keuangan['total'] = array_sum($keuangan);
        $organisasi['total'] = array_sum($organisasi);
        $manajerial['total'] = array_sum($manajerial);
        $inti['total'] = array_sum($inti);
        $portofolio['total'] = array_sum($portofolio);

        //index kepuasan
        //!product
        $product_index = [
            '1' => isset($product['1']) ? $product['1'] : 0,
            '2' => isset($product['2']) ? $product['2'] : 0,
            '3' => isset($product['3']) ? $product['3'] : 0,
            '4' => isset($product['4']) ? $product['4'] : 0,
            '5' => isset($product['5']) ? $product['5'] : 0,
        ];
        $product_index['total'] = array_sum($product_index);
        $product_index['index'] = number_format(
            $product_index['total'] / $product['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($product['5']) ? $product['5'] : 0;
        $value4 = isset($product['4']) ? $product['4'] : 0;
        $value3 = isset($product['3']) ? $product['3'] : 0;
        $product_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $product['total'],
                2,
                '.',
                ''
            ) . '%';

        //!distribusi
        $distribusi_index = [
            '1' => isset($distribusi['1']) ? $distribusi['1'] : 0,
            '2' => isset($distribusi['2']) ? $distribusi['2'] : 0,
            '3' => isset($distribusi['3']) ? $distribusi['3'] : 0,
            '4' => isset($distribusi['4']) ? $distribusi['4'] : 0,
            '5' => isset($distribusi['5']) ? $distribusi['5'] : 0,
        ];
        $distribusi_index['total'] = array_sum($distribusi_index);
        $distribusi_index['index'] = number_format(
            $distribusi_index['total'] / $distribusi['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($distribusi['5']) ? $distribusi['5'] : 0;
        $value4 = isset($distribusi['4']) ? $distribusi['4'] : 0;
        $value3 = isset($distribusi['3']) ? $distribusi['3'] : 0;
        $distribusi_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $distribusi['total'],
                2,
                '.',
                ''
            ) . '%';

        //!pemasaran
        $pemasaran_index = [
            '1' => isset($pemasaran['1']) ? $pemasaran['1'] : 0,
            '2' => isset($pemasaran['2']) ? $pemasaran['2'] : 0,
            '3' => isset($pemasaran['3']) ? $pemasaran['3'] : 0,
            '4' => isset($pemasaran['4']) ? $pemasaran['4'] : 0,
            '5' => isset($pemasaran['5']) ? $pemasaran['5'] : 0,
        ];
        $pemasaran_index['total'] = array_sum($pemasaran_index);
        $pemasaran_index['index'] = number_format(
            $pemasaran_index['total'] / $pemasaran['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($pemasaran['5']) ? $pemasaran['5'] : 0;
        $value4 = isset($pemasaran['4']) ? $pemasaran['4'] : 0;
        $value3 = isset($pemasaran['3']) ? $pemasaran['3'] : 0;
        $pemasaran_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $pemasaran['total'],
                2,
                '.',
                ''
            ) . '%';

        //!operasional
        $operasional_index = [
            '1' => isset($operasional['1']) ? $operasional['1'] : 0,
            '2' => isset($operasional['2']) ? $operasional['2'] : 0,
            '3' => isset($operasional['3']) ? $operasional['3'] : 0,
            '4' => isset($operasional['4']) ? $operasional['4'] : 0,
            '5' => isset($operasional['5']) ? $operasional['5'] : 0,
        ];
        $operasional_index['total'] = array_sum($operasional_index);
        $operasional_index['index'] = number_format(
            $operasional_index['total'] / $operasional['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($operasional['5']) ? $operasional['5'] : 0;
        $value4 = isset($operasional['4']) ? $operasional['4'] : 0;
        $value3 = isset($operasional['3']) ? $operasional['3'] : 0;
        $operasional_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $operasional['total'],
                2,
                '.',
                ''
            ) . '%';

        //!riset
        $riset_index = [
            '1' => isset($riset['1']) ? $riset['1'] : 0,
            '2' => isset($riset['2']) ? $riset['2'] : 0,
            '3' => isset($riset['3']) ? $riset['3'] : 0,
            '4' => isset($riset['4']) ? $riset['4'] : 0,
            '5' => isset($riset['5']) ? $riset['5'] : 0,
        ];
        $riset_index['total'] = array_sum($riset_index);
        $riset_index['index'] = number_format(
            $riset_index['total'] / $riset['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($riset['5']) ? $riset['5'] : 0;
        $value4 = isset($riset['4']) ? $riset['4'] : 0;
        $value3 = isset($riset['3']) ? $riset['3'] : 0;
        $riset_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $riset['total'],
                2,
                '.',
                ''
            ) . '%';

        //!keuangan
        $keuangan_index = [
            '1' => isset($keuangan['1']) ? $keuangan['1'] : 0,
            '2' => isset($keuangan['2']) ? $keuangan['2'] : 0,
            '3' => isset($keuangan['3']) ? $keuangan['3'] : 0,
            '4' => isset($keuangan['4']) ? $keuangan['4'] : 0,
            '5' => isset($keuangan['5']) ? $keuangan['5'] : 0,
        ];
        $keuangan_index['total'] = array_sum($keuangan_index);
        $keuangan_index['index'] = number_format(
            $keuangan_index['total'] / $keuangan['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($keuangan['5']) ? $keuangan['5'] : 0;
        $value4 = isset($keuangan['4']) ? $keuangan['4'] : 0;
        $value3 = isset($keuangan['3']) ? $keuangan['3'] : 0;
        $keuangan_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $keuangan['total'],
                2,
                '.',
                ''
            ) . '%';

        //!organisasi
        $organisasi_index = [
            '1' => isset($organisasi['1']) ? $organisasi['1'] : 0,
            '2' => isset($organisasi['2']) ? $organisasi['2'] : 0,
            '3' => isset($organisasi['3']) ? $organisasi['3'] : 0,
            '4' => isset($organisasi['4']) ? $organisasi['4'] : 0,
            '5' => isset($organisasi['5']) ? $organisasi['5'] : 0,
        ];
        $organisasi_index['total'] = array_sum($organisasi_index);
        $organisasi_index['index'] = number_format(
            $organisasi_index['total'] / $organisasi['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($organisasi['5']) ? $organisasi['5'] : 0;
        $value4 = isset($organisasi['4']) ? $organisasi['4'] : 0;
        $value3 = isset($organisasi['3']) ? $organisasi['3'] : 0;
        $organisasi_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $organisasi['total'],
                2,
                '.',
                ''
            ) . '%';

        //!manajerial
        $manajerial_index = [
            '1' => isset($manajerial['1']) ? $manajerial['1'] : 0,
            '2' => isset($manajerial['2']) ? $manajerial['2'] : 0,
            '3' => isset($manajerial['3']) ? $manajerial['3'] : 0,
            '4' => isset($manajerial['4']) ? $manajerial['4'] : 0,
            '5' => isset($manajerial['5']) ? $manajerial['5'] : 0,
        ];
        $manajerial_index['total'] = array_sum($manajerial_index);
        $manajerial_index['index'] = number_format(
            $manajerial_index['total'] / $manajerial['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($manajerial['5']) ? $manajerial['5'] : 0;
        $value4 = isset($manajerial['4']) ? $manajerial['4'] : 0;
        $value3 = isset($manajerial['3']) ? $manajerial['3'] : 0;
        $manajerial_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $manajerial['total'],
                2,
                '.',
                ''
            ) . '%';

        //!inti
        $inti_index = [
            '1' => isset($inti['1']) ? $inti['1'] : 0,
            '2' => isset($inti['2']) ? $inti['2'] : 0,
            '3' => isset($inti['3']) ? $inti['3'] : 0,
            '4' => isset($inti['4']) ? $inti['4'] : 0,
            '5' => isset($inti['5']) ? $inti['5'] : 0,
        ];
        $inti_index['total'] = array_sum($inti_index);
        $inti_index['index'] = number_format(
            $inti_index['total'] / $inti['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($inti['5']) ? $inti['5'] : 0;
        $value4 = isset($inti['4']) ? $inti['4'] : 0;
        $value3 = isset($inti['3']) ? $inti['3'] : 0;
        $inti_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $inti['total'],
                2,
                '.',
                ''
            ) . '%';

        //!protofolio
        $portofolio_index = [
            '1' => isset($portofolio['1']) ? $portofolio['1'] : 0,
            '2' => isset($portofolio['2']) ? $portofolio['2'] : 0,
            '3' => isset($portofolio['3']) ? $portofolio['3'] : 0,
            '4' => isset($portofolio['4']) ? $portofolio['4'] : 0,
            '5' => isset($portofolio['5']) ? $portofolio['5'] : 0,
        ];
        $portofolio_index['total'] = array_sum($portofolio_index);
        $portofolio_index['index'] = number_format(
            $portofolio_index['total'] / $portofolio['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($portofolio['5']) ? $portofolio['5'] : 0;
        $value4 = isset($portofolio['4']) ? $portofolio['4'] : 0;
        $value3 = isset($portofolio['3']) ? $portofolio['3'] : 0;
        $portofolio_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $portofolio['total'],
                2,
                '.',
                ''
            ) . '%';
        // dd($inti_index);

        return response()->json([
            'penilaian_pelanggan' => [
                'product' => $product,
                'distribusi' => $distribusi,
                'pemasaran' => $pemasaran,
                'operasional' => $operasional,
                'riset' => $riset,
                'keuangan' => $keuangan,
                'organisasi' => $organisasi,
                'manajerial' => $manajerial,
                'inti' => $inti,
                'portofolio' => $portofolio,
            ],
            'perhitungan_index_aspek' => [
                'product' => $product_index,
                'distribusi' => $distribusi_index,
                'pemasaran' => $pemasaran_index,
                'operasional' => $operasional_index,
                'riset' => $riset_index,
                'keuangan' => $keuangan_index,
                'organisasi' => $organisasi_index,
                'manajerial' => $manajerial_index,
                'inti' => $inti_index,
                'portofolio_index' => $portofolio_index,
            ],
        ]);
    }

    function kepuasanDaerah($data)
    {
        $dataAnswer = $data;
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
        $product_index['index'] = number_format(
            $product_index['total'] / $product['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($product['5']) ? $product['5'] : 0;
        $value4 = isset($product['4']) ? $product['4'] : 0;
        $value3 = isset($product['3']) ? $product['3'] : 0;
        $product_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $product['total'],
                2,
                '.',
                ''
            ) . '%';

        //! promosi
        $promosi_index = [
            '1' => isset($promosi['1']) ? $promosi['1'] * 1 : 0,
            '2' => isset($promosi['2']) ? $promosi['2'] * 2 : 0,
            '3' => isset($promosi['3']) ? $promosi['3'] * 3 : 0,
            '4' => isset($promosi['4']) ? $promosi['4'] * 4 : 0,
            '5' => isset($promosi['5']) ? $promosi['5'] * 5 : 0,
        ];
        $promosi_index['total'] = array_sum($promosi_index);
        $promosi_index['index'] = number_format(
            $promosi_index['total'] / $promosi['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($promosi['5']) ? $promosi['5'] : 0;
        $value4 = isset($promosi['4']) ? $promosi['4'] : 0;
        $value3 = isset($promosi['3']) ? $promosi['3'] : 0;
        $promosi_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $promosi['total'],
                2,
                '.',
                ''
            ) . '%';

        //! kualitas_produk
        $kualitas_produk_index = [
            '1' => isset($kualitas_produk['1']) ? $kualitas_produk['1'] * 1 : 0,
            '2' => isset($kualitas_produk['2']) ? $kualitas_produk['2'] * 2 : 0,
            '3' => isset($kualitas_produk['3']) ? $kualitas_produk['3'] * 3 : 0,
            '4' => isset($kualitas_produk['4']) ? $kualitas_produk['4'] * 4 : 0,
            '5' => isset($kualitas_produk['5']) ? $kualitas_produk['5'] * 5 : 0,
        ];
        $kualitas_produk_index['total'] = array_sum($kualitas_produk_index);
        $kualitas_produk_index['index'] = number_format(
            $kualitas_produk_index['total'] / $kualitas_produk['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($kualitas_produk['5']) ? $kualitas_produk['5'] : 0;
        $value4 = isset($kualitas_produk['4']) ? $kualitas_produk['4'] : 0;
        $value3 = isset($kualitas_produk['3']) ? $kualitas_produk['3'] : 0;
        $kualitas_produk_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $kualitas_produk['total'],
                2,
                '.',
                ''
            ) . '%';

        //! layanan_petugas_lapang
        $layanan_petugas_lapang_index = [
            '1' => isset($layanan_petugas_lapang['1'])
                ? $layanan_petugas_lapang['1'] * 1
                : 0,
            '2' => isset($layanan_petugas_lapang['2'])
                ? $layanan_petugas_lapang['2'] * 2
                : 0,
            '3' => isset($layanan_petugas_lapang['3'])
                ? $layanan_petugas_lapang['3'] * 3
                : 0,
            '4' => isset($layanan_petugas_lapang['4'])
                ? $layanan_petugas_lapang['4'] * 4
                : 0,
            '5' => isset($layanan_petugas_lapang['5'])
                ? $layanan_petugas_lapang['5'] * 5
                : 0,
        ];
        $layanan_petugas_lapang_index['total'] = array_sum(
            $layanan_petugas_lapang_index
        );
        $layanan_petugas_lapang_index['index'] = number_format(
            $layanan_petugas_lapang_index['total'] /
                $layanan_petugas_lapang['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($layanan_petugas_lapang['5'])
            ? $layanan_petugas_lapang['5']
            : 0;
        $value4 = isset($layanan_petugas_lapang['4'])
            ? $layanan_petugas_lapang['4']
            : 0;
        $value3 = isset($layanan_petugas_lapang['3'])
            ? $layanan_petugas_lapang['3']
            : 0;
        $layanan_petugas_lapang_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) /
                    $layanan_petugas_lapang['total'],
                2,
                '.',
                ''
            ) . '%';

        //! penanganan_komplain
        $penanganan_komplain_index = [
            '1' => isset($penanganan_komplain['1'])
                ? $penanganan_komplain['1'] * 1
                : 0,
            '2' => isset($penanganan_komplain['2'])
                ? $penanganan_komplain['2'] * 2
                : 0,
            '3' => isset($penanganan_komplain['3'])
                ? $penanganan_komplain['3'] * 3
                : 0,
            '4' => isset($penanganan_komplain['4'])
                ? $penanganan_komplain['4'] * 4
                : 0,
            '5' => isset($penanganan_komplain['5'])
                ? $penanganan_komplain['5'] * 5
                : 0,
        ];
        $penanganan_komplain_index['total'] = array_sum(
            $penanganan_komplain_index
        );
        $penanganan_komplain_index['index'] = number_format(
            $penanganan_komplain_index['total'] / $penanganan_komplain['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($penanganan_komplain['5'])
            ? $penanganan_komplain['5']
            : 0;
        $value4 = isset($penanganan_komplain['4'])
            ? $penanganan_komplain['4']
            : 0;
        $value3 = isset($penanganan_komplain['3'])
            ? $penanganan_komplain['3']
            : 0;
        $penanganan_komplain_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $penanganan_komplain['total'],
                2,
                '.',
                ''
            ) . '%';

        return [
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
        ];
    }

    function kekuatanKelemahanDaerah($data)
    {
        $dataAnswer = $data;

        $product = [];
        $distribusi = [];
        $pemasaran = [];
        $operasional = [];
        $riset = [];
        $keuangan = [];
        $organisasi = [];
        $manajerial = [];
        $inti = [];
        $portofolio = [];
        $lainnya = [];

        $allowedKeysProduct = ['position_pov', 'deep'];
        $allowedKeysDistribusi = [
            'distribution_line',
            'line_power',
            'line_ability',
        ];
        $allowedKeysPemasaran = ['marketing_skill', 'dev_skill'];
        $allowedKeysOperasional = [
            'advanced_tech',
            'fasility_flexibility',
            'scale_up_skill',
            'material_cost',
        ];
        $allowedKeysRiset = [
            'copyrights',
            'rnd_ability',
            'staff_skill',
            'resource_access',
        ];
        $allowedKeysKeuangan = [
            'cash_flow',
            'capital_capacity',
            'trust_management',
        ];
        $allowedKeysOrganisasi = [
            'vision_mission',
            'consistency_organization_structure',
        ];
        $allowedKeysManajerial = ['lead_quality', 'management_ability'];
        $allowedKeysInti = [
            'functional_ability',
            'measurement_ability',
            'movement_response',
            'response_to_change',
            'competition_ability',
        ];
        $allowedKeysPortofolio = [
            'support_change',
            'strengthening_ability',
        ];
        $allowedKeysLainnya = ['special_treatment'];


        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysProduct)) {
                    array_push($product, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysDistribusi)) {
                    array_push($distribusi, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysPemasaran)) {
                    array_push($pemasaran, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysOperasional)) {
                    array_push($operasional, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysRiset)) {
                    array_push($riset, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysKeuangan)) {
                    array_push($keuangan, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysOrganisasi)) {
                    array_push($organisasi, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysManajerial)) {
                    array_push($manajerial, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysInti)) {
                    array_push($inti, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysPortofolio)) {
                    array_push($portofolio, $value2);
                }
            }
        }
        foreach ($dataAnswer as $value) {
            foreach ($value as $key => $value2) {
                if (in_array($key, $allowedKeysLainnya)) {
                    array_push($lainnya, $value2);
                }
            }
        }

        //penilaian pelanggan
        $product = $this->countValues($product);
        $distribusi = $this->countValues($distribusi);
        $pemasaran = $this->countValues($pemasaran);
        $operasional = $this->countValues($operasional);
        $riset = $this->countValues($riset);
        $keuangan = $this->countValues($keuangan);
        $organisasi = $this->countValues($organisasi);
        $manajerial = $this->countValues($manajerial);
        $inti = $this->countValues($inti);
        $portofolio = $this->countValues($portofolio);
        $lainnya = $this->countValues($lainnya);

        $product['total'] = array_sum($product);
        $distribusi['total'] = array_sum($distribusi);
        $pemasaran['total'] = array_sum($pemasaran);
        $operasional['total'] = array_sum($operasional);
        $riset['total'] = array_sum($riset);
        $keuangan['total'] = array_sum($keuangan);
        $organisasi['total'] = array_sum($organisasi);
        $manajerial['total'] = array_sum($manajerial);
        $inti['total'] = array_sum($inti);
        $portofolio['total'] = array_sum($portofolio);
        $lainnya['total'] = array_sum($lainnya);

        //index kepuasan
        //!product
        $product_index = [
            '1' => isset($product['1']) ? $product['1'] : 0,
            '2' => isset($product['2']) ? $product['2'] : 0,
            '3' => isset($product['3']) ? $product['3'] : 0,
            '4' => isset($product['4']) ? $product['4'] : 0,
            '5' => isset($product['5']) ? $product['5'] : 0,
        ];
        $product_index['total'] = array_sum($product_index);
        $product_index['index'] = number_format(
            $product_index['total'] / $product['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($product['5']) ? $product['5'] : 0;
        $value4 = isset($product['4']) ? $product['4'] : 0;
        $value3 = isset($product['3']) ? $product['3'] : 0;
        $product_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $product['total'],
                2,
                '.',
                ''
            ) . '%';

        //!distribusi
        $distribusi_index = [
            '1' => isset($distribusi['1']) ? $distribusi['1'] : 0,
            '2' => isset($distribusi['2']) ? $distribusi['2'] : 0,
            '3' => isset($distribusi['3']) ? $distribusi['3'] : 0,
            '4' => isset($distribusi['4']) ? $distribusi['4'] : 0,
            '5' => isset($distribusi['5']) ? $distribusi['5'] : 0,
        ];
        $distribusi_index['total'] = array_sum($distribusi_index);
        $distribusi_index['index'] = number_format(
            $distribusi_index['total'] / $distribusi['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($distribusi['5']) ? $distribusi['5'] : 0;
        $value4 = isset($distribusi['4']) ? $distribusi['4'] : 0;
        $value3 = isset($distribusi['3']) ? $distribusi['3'] : 0;
        $distribusi_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $distribusi['total'],
                2,
                '.',
                ''
            ) . '%';

        //!pemasaran
        $pemasaran_index = [
            '1' => isset($pemasaran['1']) ? $pemasaran['1'] : 0,
            '2' => isset($pemasaran['2']) ? $pemasaran['2'] : 0,
            '3' => isset($pemasaran['3']) ? $pemasaran['3'] : 0,
            '4' => isset($pemasaran['4']) ? $pemasaran['4'] : 0,
            '5' => isset($pemasaran['5']) ? $pemasaran['5'] : 0,
        ];
        $pemasaran_index['total'] = array_sum($pemasaran_index);
        $pemasaran_index['index'] = number_format(
            $pemasaran_index['total'] / $pemasaran['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($pemasaran['5']) ? $pemasaran['5'] : 0;
        $value4 = isset($pemasaran['4']) ? $pemasaran['4'] : 0;
        $value3 = isset($pemasaran['3']) ? $pemasaran['3'] : 0;
        $pemasaran_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $pemasaran['total'],
                2,
                '.',
                ''
            ) . '%';

        //!operasional
        $operasional_index = [
            '1' => isset($operasional['1']) ? $operasional['1'] : 0,
            '2' => isset($operasional['2']) ? $operasional['2'] : 0,
            '3' => isset($operasional['3']) ? $operasional['3'] : 0,
            '4' => isset($operasional['4']) ? $operasional['4'] : 0,
            '5' => isset($operasional['5']) ? $operasional['5'] : 0,
        ];
        $operasional_index['total'] = array_sum($operasional_index);
        $operasional_index['index'] = number_format(
            $operasional_index['total'] / $operasional['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($operasional['5']) ? $operasional['5'] : 0;
        $value4 = isset($operasional['4']) ? $operasional['4'] : 0;
        $value3 = isset($operasional['3']) ? $operasional['3'] : 0;
        $operasional_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $operasional['total'],
                2,
                '.',
                ''
            ) . '%';

        //!riset
        $riset_index = [
            '1' => isset($riset['1']) ? $riset['1'] : 0,
            '2' => isset($riset['2']) ? $riset['2'] : 0,
            '3' => isset($riset['3']) ? $riset['3'] : 0,
            '4' => isset($riset['4']) ? $riset['4'] : 0,
            '5' => isset($riset['5']) ? $riset['5'] : 0,
        ];
        $riset_index['total'] = array_sum($riset_index);
        $riset_index['index'] = number_format(
            $riset_index['total'] / $riset['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($riset['5']) ? $riset['5'] : 0;
        $value4 = isset($riset['4']) ? $riset['4'] : 0;
        $value3 = isset($riset['3']) ? $riset['3'] : 0;
        $riset_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $riset['total'],
                2,
                '.',
                ''
            ) . '%';

        //!keuangan
        $keuangan_index = [
            '1' => isset($keuangan['1']) ? $keuangan['1'] : 0,
            '2' => isset($keuangan['2']) ? $keuangan['2'] : 0,
            '3' => isset($keuangan['3']) ? $keuangan['3'] : 0,
            '4' => isset($keuangan['4']) ? $keuangan['4'] : 0,
            '5' => isset($keuangan['5']) ? $keuangan['5'] : 0,
        ];
        $keuangan_index['total'] = array_sum($keuangan_index);
        $keuangan_index['index'] = number_format(
            $keuangan_index['total'] / $keuangan['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($keuangan['5']) ? $keuangan['5'] : 0;
        $value4 = isset($keuangan['4']) ? $keuangan['4'] : 0;
        $value3 = isset($keuangan['3']) ? $keuangan['3'] : 0;
        $keuangan_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $keuangan['total'],
                2,
                '.',
                ''
            ) . '%';

        //!organisasi
        $organisasi_index = [
            '1' => isset($organisasi['1']) ? $organisasi['1'] : 0,
            '2' => isset($organisasi['2']) ? $organisasi['2'] : 0,
            '3' => isset($organisasi['3']) ? $organisasi['3'] : 0,
            '4' => isset($organisasi['4']) ? $organisasi['4'] : 0,
            '5' => isset($organisasi['5']) ? $organisasi['5'] : 0,
        ];
        $organisasi_index['total'] = array_sum($organisasi_index);
        $organisasi_index['index'] = number_format(
            $organisasi_index['total'] / $organisasi['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($organisasi['5']) ? $organisasi['5'] : 0;
        $value4 = isset($organisasi['4']) ? $organisasi['4'] : 0;
        $value3 = isset($organisasi['3']) ? $organisasi['3'] : 0;
        $organisasi_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $organisasi['total'],
                2,
                '.',
                ''
            ) . '%';

        //!manajerial
        $manajerial_index = [
            '1' => isset($manajerial['1']) ? $manajerial['1'] : 0,
            '2' => isset($manajerial['2']) ? $manajerial['2'] : 0,
            '3' => isset($manajerial['3']) ? $manajerial['3'] : 0,
            '4' => isset($manajerial['4']) ? $manajerial['4'] : 0,
            '5' => isset($manajerial['5']) ? $manajerial['5'] : 0,
        ];
        $manajerial_index['total'] = array_sum($manajerial_index);
        $manajerial_index['index'] = number_format(
            $manajerial_index['total'] / $manajerial['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($manajerial['5']) ? $manajerial['5'] : 0;
        $value4 = isset($manajerial['4']) ? $manajerial['4'] : 0;
        $value3 = isset($manajerial['3']) ? $manajerial['3'] : 0;
        $manajerial_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $manajerial['total'],
                2,
                '.',
                ''
            ) . '%';

        //!inti
        $inti_index = [
            '1' => isset($inti['1']) ? $inti['1'] : 0,
            '2' => isset($inti['2']) ? $inti['2'] : 0,
            '3' => isset($inti['3']) ? $inti['3'] : 0,
            '4' => isset($inti['4']) ? $inti['4'] : 0,
            '5' => isset($inti['5']) ? $inti['5'] : 0,
        ];
        $inti_index['total'] = array_sum($inti_index);
        $inti_index['index'] = number_format(
            $inti_index['total'] / $inti['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($inti['5']) ? $inti['5'] : 0;
        $value4 = isset($inti['4']) ? $inti['4'] : 0;
        $value3 = isset($inti['3']) ? $inti['3'] : 0;
        $inti_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $inti['total'],
                2,
                '.',
                ''
            ) . '%';

        //!protofolio
        $portofolio_index = [
            '1' => isset($portofolio['1']) ? $portofolio['1'] : 0,
            '2' => isset($portofolio['2']) ? $portofolio['2'] : 0,
            '3' => isset($portofolio['3']) ? $portofolio['3'] : 0,
            '4' => isset($portofolio['4']) ? $portofolio['4'] : 0,
            '5' => isset($portofolio['5']) ? $portofolio['5'] : 0,
        ];
        $portofolio_index['total'] = array_sum($portofolio_index);
        $portofolio_index['index'] = number_format(
            $portofolio_index['total'] / $portofolio['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($portofolio['5']) ? $portofolio['5'] : 0;
        $value4 = isset($portofolio['4']) ? $portofolio['4'] : 0;
        $value3 = isset($portofolio['3']) ? $portofolio['3'] : 0;
        $portofolio_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $portofolio['total'],
                2,
                '.',
                ''
            ) . '%';

        //!protofolio
        $lainnya_index = [
            '1' => isset($lainnya['1']) ? $lainnya['1'] : 0,
            '2' => isset($lainnya['2']) ? $lainnya['2'] : 0,
            '3' => isset($lainnya['3']) ? $lainnya['3'] : 0,
            '4' => isset($lainnya['4']) ? $lainnya['4'] : 0,
            '5' => isset($lainnya['5']) ? $lainnya['5'] : 0,
        ];
        $lainnya_index['total'] = array_sum($lainnya_index);
        $lainnya_index['index'] = number_format(
            $lainnya_index['total'] / $lainnya['total'],
            2,
            '.',
            ''
        );
        $value5 = isset($lainnya['5']) ? $lainnya['5'] : 0;
        $value4 = isset($lainnya['4']) ? $lainnya['4'] : 0;
        $value3 = isset($lainnya['3']) ? $lainnya['3'] : 0;
        $lainnya_index['kepuasan'] =
            number_format(
                ($value5 + $value4 + $value3) / $lainnya['total'],
                2,
                '.',
                ''
            ) . '%';

        return [
            'penilaian_pelanggan' => [
                'product' => $product,
                'distribusi' => $distribusi,
                'pemasaran' => $pemasaran,
                'operasional' => $operasional,
                'riset' => $riset,
                'keuangan' => $keuangan,
                'organisasi' => $organisasi,
                'manajerial' => $manajerial,
                'inti' => $inti,
                'portofolio' => $portofolio,
                'lainnya' => $lainnya,
            ],
            'perhitungan_index_aspek' => [
                'product' => $product_index,
                'distribusi' => $distribusi_index,
                'pemasaran' => $pemasaran_index,
                'operasional' => $operasional_index,
                'riset' => $riset_index,
                'keuangan' => $keuangan_index,
                'organisasi' => $organisasi_index,
                'manajerial' => $manajerial_index,
                'inti' => $inti_index,
                'portofolio' => $portofolio_index,
                'lainnya' => $lainnya_index,
            ],
        ];
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

    function customSort($data)
    {
        $formattedData = [];

        // Ubah data ke dalam bentuk array asosiatif
        foreach ($data as $key => $value) {
            $formattedData[] = ['key' => $key, 'value' => $value];
        }

        usort($formattedData, function ($a, $b) {
            // Urutkan berdasarkan jumlah nilai (secara descending)
            $valueComparison = $b['value'] <=> $a['value'];

            // Jika nilai sama, urutkan berdasarkan hurufnya (secara ascending)
            if ($valueComparison === 0) {
                return strcasecmp($a['key'], $b['key']);
            }

            return $valueComparison;
        });

        // Ubah kembali ke format asal
        $sortedData = [];
        foreach ($formattedData as $item) {
            $sortedData[$item['key']] = $item['value'];
        }

        return $sortedData;
    }

    function roundNumber($number)
    {
        if ($number - floor($number) >= 0.5) {
            return ceil($number);
        } else {
            return floor($number);
        }
    }
}
