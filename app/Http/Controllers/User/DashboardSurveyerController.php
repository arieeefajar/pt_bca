<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardSurveyerController extends Controller
{
    public function index()
    {
        // Auth::logout();
        return view('surveyor.dashboard');
    }
}
