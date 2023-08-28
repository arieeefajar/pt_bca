<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardSurveyerController extends Controller
{
    public function index()
    {
        $dataCustommer = User::getCustommer();
        return view('surveyor.dashboard', compact('dataCustommer'));
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
}
