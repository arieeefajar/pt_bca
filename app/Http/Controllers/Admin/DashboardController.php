<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyimpanan;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function supperAdmin()
    {
        // Auth::logout();
        return view('dashboard.supperAdmin');
    }

    public function admin()
    {
        return view('dashboard.admin');
    }

    public function executive()
    {
        return view('dashboard.executive');
    }

    public function listTargetToko()
    {
        $dataPerusahaan = Customer::all();
        return view('surveyor.listTargetToko', compact('dataPerusahaan'));
    }

    public function listHasilSurvey()
    {
        $dataPerusahaan = Customer::all();
        return view('surveyor.listHasilSurvey', compact('dataPerusahaan'));
    }
}
