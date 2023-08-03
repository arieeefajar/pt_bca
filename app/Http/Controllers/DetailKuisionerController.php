<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailKuisionerController extends Controller
{
    public function index()
    {
        return view('admin.detailKuisioner');
    }
}
