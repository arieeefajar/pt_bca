<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardSurveyerController extends Controller
{
    public function index()
    {
        return view('surveyor.dashboard');
    }
}
