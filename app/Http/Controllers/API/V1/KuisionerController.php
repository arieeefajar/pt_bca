<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\DetailKuisioner;
use App\Models\JenisKuisioner;
use App\Models\Kuisioner;
use Illuminate\Http\Request;

class KuisionerController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $kuisioners = Kuisioner::with('jenisKuisioners.detailKuisioners')->get();
        return $this->singleDataSuccessResponse('Success retrieve data', $kuisioners);
    }
}
