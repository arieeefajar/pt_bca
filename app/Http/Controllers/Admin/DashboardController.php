<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailPenyimpanan;
use App\Models\Penyimpanan;
use App\Models\Customer;
use App\Models\Provinsi;
use App\Models\User;
use Carbon\Carbon;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function supperAdmin()
    {
        $dataJumlah = $this->dataForDashboard();
        return view('dashboard.supperAdmin', compact('dataJumlah'));
    }

    public function admin()
    {
        $dataJumlah = $this->dataForDashboard();
        return view('dashboard.admin', compact('dataJumlah'));
    }

    public function executive()
    {
        $dataJumlah = $this->dataForDashboard();
        $endPointApi = env('PYTHON_END_POINT') . 'ai';
        $dataArea = [];

        try {
            $dataAI = [Http::get($endPointApi)->json()['data']][0];

            foreach ($dataAI['potential_area_data'] as $value) {
                $dataArea[$value['location']['name']] = [];
            }

            foreach ($dataAI['retail_data'] as $valueAI) {
                foreach ($dataArea as $key => $valueArea) {
                    if ($key !== $valueAI['location']['name']) {
                        $dataArea[$valueAI['location']['name']] = [];
                    }
                }
            }

            // set data into data area
            foreach ($dataArea as $keyArea => $valueArea) {
                foreach ($dataAI['potential_area_data'] as $valueAI) {
                    if ($keyArea === $valueAI['location']['name']) {
                        $dataArea[$keyArea]['potential_area_data'] = $valueAI;
                    }
                }
            }
            foreach ($dataArea as $keyArea => $valueArea) {
                foreach ($dataAI['retail_data'] as $valueAI) {
                    if ($keyArea === $valueAI['location']['name']) {
                        $dataArea[$keyArea]['retail_data'] = $valueAI;
                    }
                }
            }

        } catch (\Throwable $th) {
            $dataArea = null;
        }

        return view('dashboard.executive', compact('dataJumlah', 'dataArea'));
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
        // Mendapatkan tanggal awal bulan ini
        $startDate =  Carbon::now()->startOfMonth()->format('Y-m-d') . ' 00:00:00';
        // Mendapatkan tanggal akhir bulan ini
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d') . ' 23:59:59';
        
        $dataPerusahaan = Customer::with('kota', 'kota.provinsi')->get();
        
        foreach ($dataPerusahaan as $key => $value) {
            $penyimpanan = Penyimpanan::with('surveyor')->whereBetween('created_at', [$startDate, $endDate])->where('customer_id', $value->id)->first();
            $detailPenyimpanan = DetailPenyimpanan::where('penyimpanan_id', $penyimpanan ? $penyimpanan->id : 'error')->first();
            if ($detailPenyimpanan) {
                if ($penyimpanan->status != 2) {
                    $dataPerusahaan[$key]->status = 1;
                    $dataPerusahaan[$key]->surveyor = $penyimpanan->surveyor->name;
                } else {
                    $dataPerusahaan[$key]->status = 2;
                    $dataPerusahaan[$key]->surveyor = $penyimpanan->surveyor->name;
                }
            }else{
                $dataPerusahaan[$key]->status = 3;
                $dataPerusahaan[$key]->surveyor = '-';
            }
        }
        return view('admin.dataTargetToko', compact('dataPerusahaan'));
    }

    public function dataSurveyToko()
    {
            // Mendapatkan tanggal awal bulan ini
        $startDate =  Carbon::now()->startOfMonth()->format('Y-m-d') . ' 00:00:00';
        // Mendapatkan tanggal akhir bulan ini
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d') . ' 23:59:59';
        
        $dataPerusahaan = Customer::with('kota', 'kota.provinsi')->get();
        
        foreach ($dataPerusahaan as $key => $value) {
            $penyimpanan = Penyimpanan::with('surveyor')->whereBetween('created_at', [$startDate, $endDate])->where('customer_id', $value->id)->first();
            $detailPenyimpanan = DetailPenyimpanan::where('penyimpanan_id', $penyimpanan ? $penyimpanan->id : 'error')->first();
            if ($detailPenyimpanan) {
                if ($penyimpanan->status != 2) {
                    $dataPerusahaan[$key]->status = 1;
                    $dataPerusahaan[$key]->surveyor = $penyimpanan->surveyor->name;
                } else {
                    $dataPerusahaan[$key]->status = 2;
                    $dataPerusahaan[$key]->surveyor = $penyimpanan->surveyor->name;
                }
            }else{
                $dataPerusahaan[$key]->status = 3;
                $dataPerusahaan[$key]->surveyor = '-';
            }
        }
        return view('admin.dataSurveyToko', compact('dataPerusahaan'));
    }

    public function profileAdmin()
    {
        return view('admin.profile');
    }

    function dataForDashboard(){
        // Mendapatkan tanggal awal bulan ini
        $startDate =  Carbon::now()->startOfMonth()->format('Y-m-d') . ' 00:00:00';
        // Mendapatkan tanggal akhir bulan ini
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d') . ' 23:59:59';

        $dataJumlah = [
            'surveyor' => User::where('role', 'user')->get()->count(),
            'executive' => User::where('role', 'executive')->get()->count(),
            'admin' => User::where('role', 'admin')->get()->count(),
            'targetToko' => Customer::all()->count(),

            'targetTokoBlmSelesai' => Customer::with('kota', 'kota.wilayah_survey', 'kota.wilayah_survey.surveyor', 'kota.provinsi', 'penyimpanan', 'penyimpanan.detail_penyimpanan')
            ->whereHas('penyimpanan', function ($query) use ($startDate, $endDate) {
                $query->where('status', 2)->whereBetween('created_at', [$startDate, $endDate]);
            })->has('penyimpanan.detail_penyimpanan')->get()->count(),
            
            'targetTokoSelesai' => Customer::join('penyimpanan', 'customer.id', '=', 'penyimpanan.customer_id')
                ->where('penyimpanan.status', 1)
                ->whereBetween('penyimpanan.created_at', [$startDate, $endDate])
                ->select('customer.nama')
                ->get()
                ->count(),
        ];

        return $dataJumlah;
    }
}
