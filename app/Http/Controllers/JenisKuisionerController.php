<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JenisKuisionerController extends Controller
{
    public function index(){
        return view('admin.jenisKuisioner');
    }
}
