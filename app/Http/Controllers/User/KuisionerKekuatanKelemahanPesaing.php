<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\DetailKuisioner;
use App\Models\DetailPenyimpanan;
use App\Models\Penyimpanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class KuisionerKekuatanKelemahanPesaing extends Controller
{
    public function index(Request $request)
    {
        $model_detail_kuisioner = new DetailKuisioner();
        $dataPertanyaan = $model_detail_kuisioner->get_data_kuisioner('Kekuatan dan Kelemahan Pesaing');

        // dd($request->cookie('selectedTokoId'));

        return view('surveyor.kekuatanKelemahanPesaing', compact('dataPertanyaan'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $endPointApi = 'http://103.175.216.72/api/simi/competitor-identifier';

        // data answer
        $position_pov = intval($request->position_pov);
        $deep = intval($request->deep);
        $distribution_line = intval($request->distribution_line);
        $line_power = intval($request->line_power);
        $line_ability = intval($request->line_ability);
        $marketing_skill = intval($request->marketing_skill);
        $dev_skill = intval($request->dev_skill);
        $advanced_tech = intval($request->advanced_tech);
        $fasility_flexibility = intval($request->fasility_flexibility);
        $scale_up_skill = intval($request->scale_up_skill);
        $material_cost = intval($request->material_cost);
        $copyrights = intval($request->copyrights);
        $rnd_ability = intval($request->rnd_ability);
        $staff_skill = intval($request->staff_skill);
        $resource_access = intval($request->resource_access);
        $cash_flow = intval($request->cash_flow);
        $capital_capacity = intval($request->capital_capacity);
        $trust_management = intval($request->trust_management);
        $vision_mission = intval($request->vision_mission);
        $consistency_organization_structure = intval($request->consistency_organization_structure);
        $lead_quality = intval($request->lead_quality);
        $management_ability = intval($request->management_ability);
        $functional_ability = intval($request->functional_ability);
        $measurement_ability = intval($request->measurement_ability);
        $movement_response = intval($request->movement_response);
        $response_to_change = intval($request->response_to_change);
        $competition_ability = intval($request->competition_ability);
        $support_change = intval($request->support_change);
        $strengthening_ability = intval($request->strengthening_ability);
        $special_treatment = intval($request->special_treatment);
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
            'position_pov' => $position_pov,
            'deep' => $deep,
            'distribution_line' => $distribution_line,
            'line_power' => $line_power,
            'line_ability' => $line_ability,
            'marketing_skill' => $marketing_skill,
            'dev_skill' => $dev_skill,
            'advanced_tech' => $advanced_tech,
            'fasility_flexibility' => $fasility_flexibility,
            'scale_up_skill' => $scale_up_skill,
            'material_cost' => $material_cost,
            'copyrights' => $copyrights,
            'rnd_ability' => $rnd_ability,
            'staff_skill' => $staff_skill,
            'resource_access' => $resource_access,
            'cash_flow' => $cash_flow,
            'capital_capacity' => $capital_capacity,
            'trust_management' => $trust_management,
            'vision_mission' => $vision_mission,
            'consistency_organization_structure' => $consistency_organization_structure,
            'lead_quality' => $lead_quality,
            'management_ability' => $management_ability,
            'functional_ability' => $functional_ability,
            'measurement_ability' => $measurement_ability,
            'movement_response' => $movement_response,
            'response_to_change' => $response_to_change,
            'competition_ability' => $competition_ability,
            'support_change' => $support_change,
            'strengthening_ability' => $strengthening_ability,
            'special_treatment' => $special_treatment,
        ]);

        $responJson = $response->json();

        $idPenyimpanan = DetailPenyimpanan::getIdPenyimpanan();
        // dd($idPenyimpanan);
        DetailPenyimpanan::create([
            'penyimpanan_id' => $idPenyimpanan,
            'pertanyaan' => 'k_kekuatan_kelemahan',
            'api_id' => $responJson['id']
        ]);

        return redirect()->route('menu.index')->with('success', 'Data kuisioner berhasil di simpan');

    }
}
