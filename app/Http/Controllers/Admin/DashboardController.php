<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyimpanan;
use App\Models\Customer;
use App\Models\Provinsi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function supperAdmin()
    {
        // Mendapatkan tanggal awal bulan ini
        $startDate =
            Carbon::now()
                ->startOfMonth()
                ->format('Y-m-d') . ' 00:00:00';
        // Mendapatkan tanggal akhir bulan ini
        $endDate =
            Carbon::now()
                ->endOfMonth()
                ->format('Y-m-d') . ' 23:59:59';

        $dataJumlah = [
            'surveyor' => User::where('role', 'user')
                ->get()
                ->count(),
            'executive' => User::where('role', 'executive')
                ->get()
                ->count(),
            'admin' => User::where('role', 'admin')
                ->get()
                ->count(),
            'targetToko' => Customer::all()->count(),
            'surveyToko' => Customer::join(
                'penyimpanan',
                'customer.id',
                '=',
                'penyimpanan.customer_id'
            )
                ->where('penyimpanan.status', 1)
                ->whereBetween('penyimpanan.created_at', [$startDate, $endDate])
                ->select('customer.nama')
                ->get()
                ->count(),
        ];

        return view('dashboard.supperAdmin', compact('dataJumlah'));
    }

    public function admin()
    {
        $dataJumlah = [
            'surveyor' => User::where('role', 'user')
                ->get()
                ->count(),
            'executive' => User::where('role', 'executive')
                ->get()
                ->count(),
            'admin' => User::where('role', 'admin')
                ->get()
                ->count(),
            'targetToko' => Customer::all()->count(),
            'surveyToko' => Customer::join(
                'penyimpanan',
                'customer.id',
                '=',
                'penyimpanan.customer_id'
            )
                ->where('penyimpanan.status', 1)
                ->select('customer.nama')
                ->get()
                ->count(),
        ];
        return view('dashboard.admin', compact('dataJumlah'));
    }

    public function executive()
    {
        $dataJumlah = [
            'surveyor' => User::where('role', 'user')
                ->get()
                ->count(),
            'executive' => User::where('role', 'executive')
                ->get()
                ->count(),
            'admin' => User::where('role', 'admin')
                ->get()
                ->count(),
            'targetToko' => Customer::all()->count(),
            'surveyToko' => Customer::join(
                'penyimpanan',
                'customer.id',
                '=',
                'penyimpanan.customer_id'
            )
                ->where('penyimpanan.status', 1)
                ->select('customer.nama')
                ->get()
                ->count(),
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
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.dataExecutive', compact('users'));
    }

    public function dataAdmin()
    {
        $users = User::whereIn('role', ['admin'])
            ->orderBy('created_at', 'asc')
            ->get();
        return view('admin.dataAdmin', compact('users'));
    }

    public function dataTargetToko()
    {
        $dataPerusahaan = Customer::join(
            'kota',
            'customer.kota_id',
            '=',
            'kota.id'
        )
            ->join('provinsi', 'kota.provinsi_id', '=', 'provinsi.id')
            ->select(
                'customer.id',
                'customer.nama',
                'customer.jenis',
                'provinsi.nama AS provinsi',
                'kota.nama AS kota'
            )
            ->get();
        return view('admin.dataTargetToko', compact('dataPerusahaan'));
    }

    public function dataSurveyToko()
    {
        // Mendapatkan tanggal awal bulan ini
        $startDate =
            Carbon::now()
                ->startOfMonth()
                ->format('Y-m-d') . ' 00:00:00';
        // Mendapatkan tanggal akhir bulan ini
        $endDate =
            Carbon::now()
                ->endOfMonth()
                ->format('Y-m-d') . ' 23:59:59';

        $dataPerusahaan = Customer::join(
            'penyimpanan',
            'customer.id',
            '=',
            'penyimpanan.customer_id'
        )
            ->join('kota', 'customer.kota_id', '=', 'kota.id')
            ->join('provinsi', 'kota.provinsi_id', '=', 'provinsi.id')
            ->where('penyimpanan.status', 1)
            ->whereBetween('penyimpanan.created_at', [$startDate, $endDate])
            ->select(
                'customer.id',
                'customer.nama',
                'customer.jenis',
                'provinsi.nama AS provinsi',
                'kota.nama AS kota'
            )
            ->get();
        return view('admin.dataSurveyToko', compact('dataPerusahaan'));
    }

    public function listTargetToko()
    {
        $dataPerusahaan = Customer::with('kota', 'kota.provinsi')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('surveyor.listTargetToko', compact('dataPerusahaan'));
    }

    public function listHasilSurvey()
    {

        // Mendapatkan tanggal awal bulan ini
        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d').' 00:00:00';

        // Mendapatkan tanggal akhir bulan ini
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d').' 23:59:59';
        
        $dataPerusahaan = Customer::join(
            'penyimpanan',
            'customer.id',
            '=',
            'penyimpanan.customer_id'
        )
            ->join('kota', 'customer.kota_id', '=', 'kota.id')
            ->join('provinsi', 'kota.provinsi_id', '=', 'provinsi.id')
            ->where('penyimpanan.surveyor_id', Auth::user()->id)
            ->whereBetween('penyimpanan.created_at', [$startDate, $endDate])
            ->select(
                'customer.nama',
                'customer.jenis',
                'provinsi.nama AS provinsi',
                'kota.nama AS kota'
            )
            ->get();
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
