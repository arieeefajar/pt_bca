<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyTokoController extends Controller
{
    public function index()
    {
        return view("surveyor.onlineSurveyStokToko");
    }
}
