<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DetailPenyimpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class KuisionerKepuasanPelanggan extends Controller
{
    public function index()
    {
        return view('surveyor.kepuasanPelanggan');
    }

    public function store(Request $request)
    {
        dd($request->all());

        $idPenyimpanan = DetailPenyimpanan::getIdPenyimpanan($request);
        $cekDetailPenyimpanan = DetailPenyimpanan::hasDetailPenyimpanan($idPenyimpanan, 'k_kepuasan');

        // cek apakah sudah ada detail penyimpanan dengan jenis pertanyaan yang sama
        if ($cekDetailPenyimpanan) {
            return redirect()->route('menu.index')->with('error', 'Data Kuisioner sudah ada');
        }

        $endPointApi = 'http://103.175.216.72/api/simi/customer';

        // data answer
        $information = intval($request->information);
        $price_comparison = intval($request->price_comparison);
        $variety_previlege = intval($request->variety_previlege);
        $packaging_view = intval($request->packaging_view);
        $getting_easy = intval($request->getting_easy);
        $satisfaction = intval($request->satisfaction);
        $image_view = intval($request->image_view);
        $material_amount = intval($request->material_amount);
        $promotion_quantity = intval($request->promotion_quantity);
        $promotion_quality = intval($request->promotion_quality);
        $seed_purity = intval($request->seed_purity);
        $vigor = intval($request->vigor);
        $growing_power = intval($request->growing_power);
        $genetic_purity = intval($request->genetic_purity);
        $pest_resistance = intval($request->pest_resistance);
        $suitablelity_image_result = intval($request->suitablelity_image_result);
        $suitablelity_result_request = intval($request->suitablelity_result_request);
        $satisfaction_result = intval($request->satisfaction_result);
        $technical_ability = intval($request->technical_ability);
        $visit_intensity = intval($request->visit_intensity);
        $communication_intensity = intval($request->communication_intensity);
        $skill_credibility = intval($request->skill_credibility);
        $influence_of_officer = intval($request->influence_of_officer);
        $communication_skill = intval($request->communication_skill);
        $verification_speed = intval($request->verification_speed);
        $completion_speed = intval($request->completion_speed);
        $handling = intval($request->handling);

        $latitude = floatval($request->latitude);
        $longitude = floatval($request->longitude);

        // dd($latitude, $longitude);

        // post api
        $response = Http::post($endPointApi, [
            'surveyor' => Auth::user()->id,
            'location' => [
                "latitude" => $latitude,
                //number *
                "longtitude" => $longitude //number *
            ],
            "information" => $information,
            "price_comparison" => $price_comparison,
            "variety_previlege" => $variety_previlege,
            "packaging_view" => $packaging_view,
            "getting_easy" => $getting_easy,
            "satisfaction" => $satisfaction,
            "image_view" => $image_view,
            "material_amount" => $material_amount,
            "promotion_quantity" => $promotion_quantity,
            "promotion_quality" => $promotion_quality,
            "seed_purity" => $seed_purity,
            "vigor" => $vigor,
            "growing_power" => $growing_power,
            "genetic_purity" => $genetic_purity,
            "pest_resistance" => $pest_resistance,
            "suitablelity_image_result" => $suitablelity_image_result,
            "suitablelity_result_request" => $suitablelity_result_request,
            "satisfaction_result" => $satisfaction_result,
            "technical_ability" => $technical_ability,
            "visit_intensity" => $visit_intensity,
            "communication_intensity" => $communication_intensity,
            "skill_credibility" => $skill_credibility,
            "influence_of_officer" => $influence_of_officer,
            "communication_skill" => $communication_skill,
            "verification_speed" => $verification_speed,
            "completion_speed" => $completion_speed,
            "handling" => $handling
        ]);

        $responJson = $response->json();

        DetailPenyimpanan::create([
            'penyimpanan_id' => $idPenyimpanan,
            'pertanyaan' => 'k_kepuasan',
            'api_id' => $responJson['id']
        ]);

        return redirect()->route('menu.index')->with('success', 'Data kuisioner berhasil di simpan');
    }
}
