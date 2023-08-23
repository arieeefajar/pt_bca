<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyimpanan;
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

    public function surveyor()
    {
        return view('surveyor.dashboard');
    }

    public function pesaing()
    {
        return view('surveyor.pesaing');
    }

    public function potensi()
    {
        return view('surveyor.potensiLahan');
    }

    public function menu()
    {
        return view('surveyor.menu');
    }

    public function setStore(Request $request)
    {
        $store = $request->input('store');
        return redirect()->route('menu.index')->withCookie(cookie('selectedTokoId', $store, 1440));
    }

    public function tes()
    {
        return view('layout1.tes');
    }
}
