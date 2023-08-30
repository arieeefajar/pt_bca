<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyimpanan;
use App\Models\Customer;
use App\Models\User;
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

    public function dataSurveyor()
    {
        $users = User::whereIn('role', ['user'])
            ->orderBy('role', 'asc')
            ->get();
        return view('admin.dataSurveyor', compact('users'));
    }

    public function dataExecutive()
    {
        $users = User::whereIn('role', ['executive'])
            ->orderBy('role', 'asc')
            ->get();
        return view('admin.dataExecutive', compact('users'));
    }

    public function dataAdmin()
    {
        $users = User::whereIn('role', ['admin'])
            ->orderBy('role', 'asc')
            ->get();
        return view('admin.dataAdmin', compact('users'));
    }

    public function dataTargetToko()
    {
        $dataPerusahaan = Customer::all();
        return view('admin.dataTargetToko', compact('dataPerusahaan'));
    }

    public function dataSurveyToko()
    {
        $dataPerusahaan = Customer::all();
        return view('admin.dataSurveyToko', compact('dataPerusahaan'));
    }
}
