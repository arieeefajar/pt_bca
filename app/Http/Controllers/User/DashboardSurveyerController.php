<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
class DashboardSurveyerController extends Controller
{
    public function index()
    {
        return view('surveyor.dashboard');
    }
}
