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

    public function laporanDaerah($daerah){
        $location_name = base64_decode($daerah);
        $endPointApi = env('PYTHON_END_POINT') . 'ai';
        $customer_data = [];
        $competitor_identifier_data = [];

        try {
            $dataAI = [Http::get($endPointApi)->json()['data']][0];

            // set customer data berdasarkan daerah sesuai parameter
            foreach ($dataAI['customer_data'] as $value) {
                if ($value['location']['name'] === $location_name){
                    $customer_data = $value['answer'];
                    break;
                }
            }

            // set competitor identifier data berdasarkan daerah sesuai parameter
            foreach ($dataAI['competitor_identifier_data'] as $value) {
                if ($value['location']['name'] === $location_name){
                    $competitor_identifier_data = $value['answer'];
                    break;
                }
            }
            
            $customer_data = $this->kepuasanDaerah($customer_data);
            $competitor_identifier_data = $this->kekuatanKelemahanDaerah($competitor_identifier_data);

            dd($customer_data, $competitor_identifier_data);
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi kesalahan server');
            return redirect()->back()->withInput();
        }
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
        // $endPointApi = env('PYTHON_END_POINT') . 'ai';
        // $dataAI = collect([Http::get($endPointApi)->json()])[0]['data']['customer_data'];
        // $dataAnswer = [];
        // foreach ($dataAI as $valueAI) {
        //     foreach ($valueAI['answer'] as $valueAnswer) {
        //         array_push($dataAnswer, $valueAnswer);
        //     }
        // }

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
        $product_index['index'] = number_format($product_index['total'] / $product['total'], 2, '.', '');
        $value5 = isset($product['5']) ? $product['5'] : 0;
        $value4 = isset($product['4']) ? $product['4'] : 0;
        $value3 = isset($product['3']) ? $product['3'] : 0;
        $product_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $product['total'], 2, '.', '') . '%';
    
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
        $promosi_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $promosi['total'], 2, '.', '') . '%';
    
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
        $kualitas_produk_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $kualitas_produk['total'], 2, '.', '') . '%';
    
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
        $layanan_petugas_lapang_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $layanan_petugas_lapang['total'], 2, '.', '') . '%';
    
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
        $penanganan_komplain_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $penanganan_komplain['total'], 2, '.', '') . '%';
    
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
    
        $allowedKeysProduct = [
            'position_pov',
            'deep',
        ];
        $allowedKeysDistribusi = [
            'distribution_line',
            'line_power',
            'line_ability',
        ];
        $allowedKeysPemasaran = [
            'marketing_skill',
            'dev_skill',
        ];
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
        $allowedKeysManajerial = [
            'lead_quality',
            'management_ability',
        ];
        $allowedKeysInti = [
            'functional_ability',
            'measurement_ability',
            'movement_response',
            'response_to_change',
            'competition_ability',
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
    
        $product['total'] = array_sum($product);
        $distribusi['total'] = array_sum($distribusi);
        $pemasaran['total'] = array_sum($pemasaran);
        $operasional['total'] = array_sum($operasional);
        $riset['total'] = array_sum($riset);
        $keuangan['total'] = array_sum($keuangan);
        $organisasi['total'] = array_sum($organisasi);
        $manajerial['total'] = array_sum($manajerial);
        $inti['total'] = array_sum($inti);
    
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
        $product_index['index'] = number_format($product_index['total'] / $product['total'], 2, '.', '');
        $value5 = isset($product['5']) ? $product['5'] : 0;
        $value4 = isset($product['4']) ? $product['4'] : 0;
        $value3 = isset($product['3']) ? $product['3'] : 0;
        $product_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $product['total'], 2, '.', '') . '%';
    
        //!distribusi
        $distribusi_index = [
            '1' => isset($distribusi['1']) ? $distribusi['1'] : 0,
            '2' => isset($distribusi['2']) ? $distribusi['2'] : 0,
            '3' => isset($distribusi['3']) ? $distribusi['3'] : 0,
            '4' => isset($distribusi['4']) ? $distribusi['4'] : 0,
            '5' => isset($distribusi['5']) ? $distribusi['5'] : 0,
        ];
        $distribusi_index['total'] = array_sum($distribusi_index);
        $distribusi_index['index'] = number_format($distribusi_index['total'] / $distribusi['total'], 2, '.', '');
        $value5 = isset($distribusi['5']) ? $distribusi['5'] : 0;
        $value4 = isset($distribusi['4']) ? $distribusi['4'] : 0;
        $value3 = isset($distribusi['3']) ? $distribusi['3'] : 0;
        $distribusi_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $distribusi['total'], 2, '.', '') . '%';
    
        //!pemasaran
        $pemasaran_index = [
            '1' => isset($pemasaran['1']) ? $pemasaran['1'] : 0,
            '2' => isset($pemasaran['2']) ? $pemasaran['2'] : 0,
            '3' => isset($pemasaran['3']) ? $pemasaran['3'] : 0,
            '4' => isset($pemasaran['4']) ? $pemasaran['4'] : 0,
            '5' => isset($pemasaran['5']) ? $pemasaran['5'] : 0,
        ];
        $pemasaran_index['total'] = array_sum($pemasaran_index);
        $pemasaran_index['index'] = number_format($pemasaran_index['total'] / $pemasaran['total'], 2, '.', '');
        $value5 = isset($pemasaran['5']) ? $pemasaran['5'] : 0;
        $value4 = isset($pemasaran['4']) ? $pemasaran['4'] : 0;
        $value3 = isset($pemasaran['3']) ? $pemasaran['3'] : 0;
        $pemasaran_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $pemasaran['total'], 2, '.', '') . '%';
    
        //!operasional
        $operasional_index = [
            '1' => isset($operasional['1']) ? $operasional['1'] : 0,
            '2' => isset($operasional['2']) ? $operasional['2'] : 0,
            '3' => isset($operasional['3']) ? $operasional['3'] : 0,
            '4' => isset($operasional['4']) ? $operasional['4'] : 0,
            '5' => isset($operasional['5']) ? $operasional['5'] : 0,
        ];
        $operasional_index['total'] = array_sum($operasional_index);
        $operasional_index['index'] = number_format($operasional_index['total'] / $operasional['total'], 2, '.', '');
        $value5 = isset($operasional['5']) ? $operasional['5'] : 0;
        $value4 = isset($operasional['4']) ? $operasional['4'] : 0;
        $value3 = isset($operasional['3']) ? $operasional['3'] : 0;
        $operasional_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $operasional['total'], 2, '.', '') . '%';
    
        //!riset
        $riset_index = [
            '1' => isset($riset['1']) ? $riset['1'] : 0,
            '2' => isset($riset['2']) ? $riset['2'] : 0,
            '3' => isset($riset['3']) ? $riset['3'] : 0,
            '4' => isset($riset['4']) ? $riset['4'] : 0,
            '5' => isset($riset['5']) ? $riset['5'] : 0,
        ];
        $riset_index['total'] = array_sum($riset_index);
        $riset_index['index'] = number_format($riset_index['total'] / $riset['total'], 2, '.', '');
        $value5 = isset($riset['5']) ? $riset['5'] : 0;
        $value4 = isset($riset['4']) ? $riset['4'] : 0;
        $value3 = isset($riset['3']) ? $riset['3'] : 0;
        $riset_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $riset['total'], 2, '.', '') . '%';
    
        //!keuangan
        $keuangan_index = [
            '1' => isset($keuangan['1']) ? $keuangan['1'] : 0,
            '2' => isset($keuangan['2']) ? $keuangan['2'] : 0,
            '3' => isset($keuangan['3']) ? $keuangan['3'] : 0,
            '4' => isset($keuangan['4']) ? $keuangan['4'] : 0,
            '5' => isset($keuangan['5']) ? $keuangan['5'] : 0,
        ];
        $keuangan_index['total'] = array_sum($keuangan_index);
        $keuangan_index['index'] = number_format($keuangan_index['total'] / $keuangan['total'], 2, '.', '');
        $value5 = isset($keuangan['5']) ? $keuangan['5'] : 0;
        $value4 = isset($keuangan['4']) ? $keuangan['4'] : 0;
        $value3 = isset($keuangan['3']) ? $keuangan['3'] : 0;
        $keuangan_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $keuangan['total'], 2, '.', '') . '%';
    
        //!organisasi
        $organisasi_index = [
            '1' => isset($organisasi['1']) ? $organisasi['1'] : 0,
            '2' => isset($organisasi['2']) ? $organisasi['2'] : 0,
            '3' => isset($organisasi['3']) ? $organisasi['3'] : 0,
            '4' => isset($organisasi['4']) ? $organisasi['4'] : 0,
            '5' => isset($organisasi['5']) ? $organisasi['5'] : 0,
        ];
        $organisasi_index['total'] = array_sum($organisasi_index);
        $organisasi_index['index'] = number_format($organisasi_index['total'] / $organisasi['total'], 2, '.', '');
        $value5 = isset($organisasi['5']) ? $organisasi['5'] : 0;
        $value4 = isset($organisasi['4']) ? $organisasi['4'] : 0;
        $value3 = isset($organisasi['3']) ? $organisasi['3'] : 0;
        $organisasi_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $organisasi['total'], 2, '.', '') . '%';
    
        //!manajerial
        $manajerial_index = [
            '1' => isset($manajerial['1']) ? $manajerial['1'] : 0,
            '2' => isset($manajerial['2']) ? $manajerial['2'] : 0,
            '3' => isset($manajerial['3']) ? $manajerial['3'] : 0,
            '4' => isset($manajerial['4']) ? $manajerial['4'] : 0,
            '5' => isset($manajerial['5']) ? $manajerial['5'] : 0,
        ];
        $manajerial_index['total'] = array_sum($manajerial_index);
        $manajerial_index['index'] = number_format($manajerial_index['total'] / $manajerial['total'], 2, '.', '');
        $value5 = isset($manajerial['5']) ? $manajerial['5'] : 0;
        $value4 = isset($manajerial['4']) ? $manajerial['4'] : 0;
        $value3 = isset($manajerial['3']) ? $manajerial['3'] : 0;
        $manajerial_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $manajerial['total'], 2, '.', '') . '%';
    
        //!inti
        $inti_index = [
            '1' => isset($inti['1']) ? $inti['1'] : 0,
            '2' => isset($inti['2']) ? $inti['2'] : 0,
            '3' => isset($inti['3']) ? $inti['3'] : 0,
            '4' => isset($inti['4']) ? $inti['4'] : 0,
            '5' => isset($inti['5']) ? $inti['5'] : 0,
        ];
        $inti_index['total'] = array_sum($inti_index);
        $inti_index['index'] = number_format($inti_index['total'] / $inti['total'], 2, '.', '');
        $value5 = isset($inti['5']) ? $inti['5'] : 0;
        $value4 = isset($inti['4']) ? $inti['4'] : 0;
        $value3 = isset($inti['3']) ? $inti['3'] : 0;
        $inti_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $inti['total'], 2, '.', '') . '%';
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
        $product_index['index'] = number_format($product_index['total'] / $product['total'], 2, '.', '');
        $value5 = isset($product['5']) ? $product['5'] : 0;
        $value4 = isset($product['4']) ? $product['4'] : 0;
        $value3 = isset($product['3']) ? $product['3'] : 0;
        $product_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $product['total'], 2, '.', '') . '%';
    
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
        $promosi_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $promosi['total'], 2, '.', '') . '%';
    
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
        $kualitas_produk_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $kualitas_produk['total'], 2, '.', '') . '%';
    
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
        $layanan_petugas_lapang_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $layanan_petugas_lapang['total'], 2, '.', '') . '%';
    
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
        $penanganan_komplain_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $penanganan_komplain['total'], 2, '.', '') . '%';
    
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
    
        $allowedKeysProduct = [
            'position_pov',
            'deep',
        ];
        $allowedKeysDistribusi = [
            'distribution_line',
            'line_power',
            'line_ability',
        ];
        $allowedKeysPemasaran = [
            'marketing_skill',
            'dev_skill',
        ];
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
        $allowedKeysManajerial = [
            'lead_quality',
            'management_ability',
        ];
        $allowedKeysInti = [
            'functional_ability',
            'measurement_ability',
            'movement_response',
            'response_to_change',
            'competition_ability',
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
    
        $product['total'] = array_sum($product);
        $distribusi['total'] = array_sum($distribusi);
        $pemasaran['total'] = array_sum($pemasaran);
        $operasional['total'] = array_sum($operasional);
        $riset['total'] = array_sum($riset);
        $keuangan['total'] = array_sum($keuangan);
        $organisasi['total'] = array_sum($organisasi);
        $manajerial['total'] = array_sum($manajerial);
        $inti['total'] = array_sum($inti);
    
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
        $product_index['index'] = number_format($product_index['total'] / $product['total'], 2, '.', '');
        $value5 = isset($product['5']) ? $product['5'] : 0;
        $value4 = isset($product['4']) ? $product['4'] : 0;
        $value3 = isset($product['3']) ? $product['3'] : 0;
        $product_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $product['total'], 2, '.', '') . '%';
    
        //!distribusi
        $distribusi_index = [
            '1' => isset($distribusi['1']) ? $distribusi['1'] : 0,
            '2' => isset($distribusi['2']) ? $distribusi['2'] : 0,
            '3' => isset($distribusi['3']) ? $distribusi['3'] : 0,
            '4' => isset($distribusi['4']) ? $distribusi['4'] : 0,
            '5' => isset($distribusi['5']) ? $distribusi['5'] : 0,
        ];
        $distribusi_index['total'] = array_sum($distribusi_index);
        $distribusi_index['index'] = number_format($distribusi_index['total'] / $distribusi['total'], 2, '.', '');
        $value5 = isset($distribusi['5']) ? $distribusi['5'] : 0;
        $value4 = isset($distribusi['4']) ? $distribusi['4'] : 0;
        $value3 = isset($distribusi['3']) ? $distribusi['3'] : 0;
        $distribusi_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $distribusi['total'], 2, '.', '') . '%';
    
        //!pemasaran
        $pemasaran_index = [
            '1' => isset($pemasaran['1']) ? $pemasaran['1'] : 0,
            '2' => isset($pemasaran['2']) ? $pemasaran['2'] : 0,
            '3' => isset($pemasaran['3']) ? $pemasaran['3'] : 0,
            '4' => isset($pemasaran['4']) ? $pemasaran['4'] : 0,
            '5' => isset($pemasaran['5']) ? $pemasaran['5'] : 0,
        ];
        $pemasaran_index['total'] = array_sum($pemasaran_index);
        $pemasaran_index['index'] = number_format($pemasaran_index['total'] / $pemasaran['total'], 2, '.', '');
        $value5 = isset($pemasaran['5']) ? $pemasaran['5'] : 0;
        $value4 = isset($pemasaran['4']) ? $pemasaran['4'] : 0;
        $value3 = isset($pemasaran['3']) ? $pemasaran['3'] : 0;
        $pemasaran_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $pemasaran['total'], 2, '.', '') . '%';
    
        //!operasional
        $operasional_index = [
            '1' => isset($operasional['1']) ? $operasional['1'] : 0,
            '2' => isset($operasional['2']) ? $operasional['2'] : 0,
            '3' => isset($operasional['3']) ? $operasional['3'] : 0,
            '4' => isset($operasional['4']) ? $operasional['4'] : 0,
            '5' => isset($operasional['5']) ? $operasional['5'] : 0,
        ];
        $operasional_index['total'] = array_sum($operasional_index);
        $operasional_index['index'] = number_format($operasional_index['total'] / $operasional['total'], 2, '.', '');
        $value5 = isset($operasional['5']) ? $operasional['5'] : 0;
        $value4 = isset($operasional['4']) ? $operasional['4'] : 0;
        $value3 = isset($operasional['3']) ? $operasional['3'] : 0;
        $operasional_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $operasional['total'], 2, '.', '') . '%';
    
        //!riset
        $riset_index = [
            '1' => isset($riset['1']) ? $riset['1'] : 0,
            '2' => isset($riset['2']) ? $riset['2'] : 0,
            '3' => isset($riset['3']) ? $riset['3'] : 0,
            '4' => isset($riset['4']) ? $riset['4'] : 0,
            '5' => isset($riset['5']) ? $riset['5'] : 0,
        ];
        $riset_index['total'] = array_sum($riset_index);
        $riset_index['index'] = number_format($riset_index['total'] / $riset['total'], 2, '.', '');
        $value5 = isset($riset['5']) ? $riset['5'] : 0;
        $value4 = isset($riset['4']) ? $riset['4'] : 0;
        $value3 = isset($riset['3']) ? $riset['3'] : 0;
        $riset_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $riset['total'], 2, '.', '') . '%';
    
        //!keuangan
        $keuangan_index = [
            '1' => isset($keuangan['1']) ? $keuangan['1'] : 0,
            '2' => isset($keuangan['2']) ? $keuangan['2'] : 0,
            '3' => isset($keuangan['3']) ? $keuangan['3'] : 0,
            '4' => isset($keuangan['4']) ? $keuangan['4'] : 0,
            '5' => isset($keuangan['5']) ? $keuangan['5'] : 0,
        ];
        $keuangan_index['total'] = array_sum($keuangan_index);
        $keuangan_index['index'] = number_format($keuangan_index['total'] / $keuangan['total'], 2, '.', '');
        $value5 = isset($keuangan['5']) ? $keuangan['5'] : 0;
        $value4 = isset($keuangan['4']) ? $keuangan['4'] : 0;
        $value3 = isset($keuangan['3']) ? $keuangan['3'] : 0;
        $keuangan_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $keuangan['total'], 2, '.', '') . '%';
    
        //!organisasi
        $organisasi_index = [
            '1' => isset($organisasi['1']) ? $organisasi['1'] : 0,
            '2' => isset($organisasi['2']) ? $organisasi['2'] : 0,
            '3' => isset($organisasi['3']) ? $organisasi['3'] : 0,
            '4' => isset($organisasi['4']) ? $organisasi['4'] : 0,
            '5' => isset($organisasi['5']) ? $organisasi['5'] : 0,
        ];
        $organisasi_index['total'] = array_sum($organisasi_index);
        $organisasi_index['index'] = number_format($organisasi_index['total'] / $organisasi['total'], 2, '.', '');
        $value5 = isset($organisasi['5']) ? $organisasi['5'] : 0;
        $value4 = isset($organisasi['4']) ? $organisasi['4'] : 0;
        $value3 = isset($organisasi['3']) ? $organisasi['3'] : 0;
        $organisasi_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $organisasi['total'], 2, '.', '') . '%';
    
        //!manajerial
        $manajerial_index = [
            '1' => isset($manajerial['1']) ? $manajerial['1'] : 0,
            '2' => isset($manajerial['2']) ? $manajerial['2'] : 0,
            '3' => isset($manajerial['3']) ? $manajerial['3'] : 0,
            '4' => isset($manajerial['4']) ? $manajerial['4'] : 0,
            '5' => isset($manajerial['5']) ? $manajerial['5'] : 0,
        ];
        $manajerial_index['total'] = array_sum($manajerial_index);
        $manajerial_index['index'] = number_format($manajerial_index['total'] / $manajerial['total'], 2, '.', '');
        $value5 = isset($manajerial['5']) ? $manajerial['5'] : 0;
        $value4 = isset($manajerial['4']) ? $manajerial['4'] : 0;
        $value3 = isset($manajerial['3']) ? $manajerial['3'] : 0;
        $manajerial_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $manajerial['total'], 2, '.', '') . '%';
    
        //!inti
        $inti_index = [
            '1' => isset($inti['1']) ? $inti['1'] : 0,
            '2' => isset($inti['2']) ? $inti['2'] : 0,
            '3' => isset($inti['3']) ? $inti['3'] : 0,
            '4' => isset($inti['4']) ? $inti['4'] : 0,
            '5' => isset($inti['5']) ? $inti['5'] : 0,
        ];
        $inti_index['total'] = array_sum($inti_index);
        $inti_index['index'] = number_format($inti_index['total'] / $inti['total'], 2, '.', '');
        $value5 = isset($inti['5']) ? $inti['5'] : 0;
        $value4 = isset($inti['4']) ? $inti['4'] : 0;
        $value3 = isset($inti['3']) ? $inti['3'] : 0;
        $inti_index['kepuasan'] = number_format(($value5 + $value4 + $value3) / $inti['total'], 2, '.', '') . '%';
        // dd($inti_index);
    
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
}
