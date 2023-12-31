<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\Customer;
use App\Models\DetailKuisioner;
use App\Models\DetailPenyimpanan;
use App\Models\Penyimpanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class KuisionerKekuatanKelemahanPesaing extends Controller
{
    public function index(Request $request, $api_id = null)
    {
        $idPenyimpanan = DetailPenyimpanan::getIdPenyimpanan($request);
        $k_kekuatan_kelemahan = DetailPenyimpanan::hasDetailPenyimpanan(
            $idPenyimpanan,
            'k_kekuatan_kelemahan'
        );

        $dataAnswer = null;

        // kika jawaban sudah ada dan ada api id
        if ($k_kekuatan_kelemahan && $api_id) {
            $endPointApi = env('PYTHON_END_POINT') . 'competitor-identifier/' . $api_id;
            try {
                $dataAnswer = (object) [Http::get($endPointApi)->json()['data']][0];
                return view('surveyor.kekuatanKelemahanPesaing',
                    compact('dataAnswer')
                );
            } catch (\Throwable $th) {
                alert()->error('Gagal', 'Sesalahan server, gagal menampilkan jawaban');
                return redirect()->route('menu.index');
            }
        }
        // ketika jawaban sudah ada dan user memaksa masuk lewat url
        elseif ($k_kekuatan_kelemahan) {
            toast('Form survey sudah diisikan', 'error')
                ->position('top')
                ->autoClose(3000);
            return redirect()->route('menu.index');
        } else {
            return view(
                'surveyor.kekuatanKelemahanPesaing',
                compact('dataAnswer')
            );
        }
    }

    public function store(Request $request)
    {
        $customMessages = [
            'required' => ':Harap lengkapi kuisioner.',
            'numeric' => ':attribute harus berupa angka.',
        ];

        $validator = Validator::make(
            $request->all(),
            [
                'position_pov' => 'required',
                'deep' => 'required',
                'distribution_line' => 'required',
                'line_power' => 'required',
                'line_ability' => 'required',
                'marketing_skill' => 'required',
                'dev_skill' => 'required',
                'advanced_tech' => 'required',
                'fasility_flexibility' => 'required',
                'scale_up_skill' => 'required',
                'material_cost' => 'required',
                'copyrights' => 'required',
                'rnd_ability' => 'required',
                'staff_skill' => 'required',
                'resource_access' => 'required',
                'cash_flow' => 'required',
                'capital_capacity' => 'required',
                'trust_management' => 'required',
                'vision_mission' => 'required',
                'consistency_organization_structure' => 'required',
                'lead_quality' => 'required',
                'management_ability' => 'required',
                'functional_ability' => 'required',
                'measurement_ability' => 'required',
                'movement_response' => 'required',
                'response_to_change' => 'required',
                'competition_ability' => 'required',
                'support_change' => 'required',
                'strengthening_ability' => 'required',
                'special_treatment' => 'required',
                // 'latitude' => 'required',
                // 'longitude' => 'required',
            ],
            $customMessages
        );

        if ($validator->fails()) {
            alert()->error('Gagal', $validator->messages()->all()[0]);
            return redirect()
                ->back()
                ->withInput();
        }

        $idPenyimpanan = DetailPenyimpanan::getIdPenyimpanan($request);
        $cekDetailPenyimpanan = DetailPenyimpanan::hasDetailPenyimpanan(
            $idPenyimpanan,
            'k_kekuatan_kelemahan'
        );

        // cek apakah sudah ada detail penyimpanan dengan jenis pertanyaan yang sama
        if ($cekDetailPenyimpanan) {
            alert()->warning('Gagal', 'Data form sudah ada');
            return redirect()->route('menu.index');
        }

        $endPointApi = env('PYTHON_END_POINT') . 'competitor-identifier';

        // latitude & longitude
        $koordinat = Customer::select('koordinat')
            ->where('id', $request->cookie('selectedTokoId'))
            ->first()->koordinat;
        $koordinat = explode(', ', $koordinat);

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
        $consistency_organization_structure = intval(
            $request->consistency_organization_structure
        );
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
        // $latitude = floatval($request->latitude);
        // $longitude = floatval($request->longitude);
        $latitude = floatval($koordinat[0]);
        $longitude = floatval($koordinat[1]);

        // post api
        try {
            $response = Http::post($endPointApi, [
                'surveyor' => Auth::user()->id,
                'location' => [
                    'latitude' => $latitude,
                    'longtitude' => $longitude,
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

            DetailPenyimpanan::create([
                'penyimpanan_id' => $idPenyimpanan,
                'pertanyaan' => 'k_kekuatan_kelemahan',
                'api_id' => $responJson['id'],
            ]);

            if (Penyimpanan::hasDonePenyimpanan($request)) {
                $penyimpanan = Penyimpanan::findOrFail($idPenyimpanan);
                $penyimpanan->status = '1';
                $penyimpanan->save();
            }

            alert()->success('Berhasil', 'Berhasil menambahkan kuisioner');
            return redirect()->route('menu.index');
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Sesalahan server, gagal menambahkan kuisioner');
            return redirect()->back()->withInput();
        }
    }
}
