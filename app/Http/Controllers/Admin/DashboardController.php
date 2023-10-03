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
        $dataJumlah = [
            'surveyor' => User::where('role', 'user')->get()->count(),
            'executive' => User::where('role', 'executive')->get()->count(),
            'admin' => User::where('role', 'admin')->get()->count(),
            'targetToko' => Customer::all()->count(),
            'surveyToko' => Customer::join('penyimpanan', 'customer.id', '=', 'penyimpanan.customer_id')
                ->where('penyimpanan.status', 1)
                ->select('customer.nama')
                ->get()->count(),
        ];

        return view('dashboard.supperAdmin', compact('dataJumlah'));
    }

    public function admin()
    {
        $dataJumlah = [
            'surveyor' => User::where('role', 'user')->get()->count(),
            'executive' => User::where('role', 'executive')->get()->count(),
            'admin' => User::where('role', 'admin')->get()->count(),
            'targetToko' => Customer::all()->count(),
            'surveyToko' => Customer::join('penyimpanan', 'customer.id', '=', 'penyimpanan.customer_id')
                ->where('penyimpanan.status', 1)
                ->select('customer.nama')
                ->get()->count(),
        ];
        return view('dashboard.admin', compact('dataJumlah'));
    }

    public function executive()
    {
        $dataJumlah = [
            'surveyor' => User::where('role', 'user')->get()->count(),
            'executive' => User::where('role', 'executive')->get()->count(),
            'admin' => User::where('role', 'admin')->get()->count(),
            'targetToko' => Customer::all()->count(),
            'surveyToko' => Customer::join('penyimpanan', 'customer.id', '=', 'penyimpanan.customer_id')
                ->where('penyimpanan.status', 1)
                ->select('customer.nama')
                ->get()->count(),
        ];
        return view('dashboard.executive', compact('dataJumlah'));
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
        $dataPerusahaan = Customer::join('wilayah', 'customer.wilayah_id', '=', 'wilayah.id')
            ->select('customer.id', 'customer.nama', 'customer.jenis', 'customer.provinsi', 'customer.kota', 'wilayah.nama AS wilayah_nama')
            ->get();
        return view('admin.dataTargetToko', compact('dataPerusahaan'));
    }

    public function dataSurveyToko()
    {
        $dataPerusahaan = Customer::join('penyimpanan', 'customer.id', '=', 'penyimpanan.customer_id')
            ->join('wilayah', 'customer.wilayah_id', '=', 'wilayah.id')
            ->where('penyimpanan.status', 1)
            ->select('customer.id', 'customer.nama', 'customer.jenis', 'customer.provinsi', 'customer.kota', 'wilayah.nama AS wilayah_nama')
            ->get();
        return view('admin.dataSurveyToko', compact('dataPerusahaan'));
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

    public function profileAdmin()
    {
        return view('admin.profile');
    }

    public function tes()
    {
        return view('layout1.tes');
    }
}
