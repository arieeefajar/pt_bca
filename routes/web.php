<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailKuisionerController;
use App\Http\Controllers\DetailPenyimpananController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JenisKuisionerController;
use App\Http\Controllers\KuisionerController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenyimpananController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PosisiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//login routes
Route::get('/', [LoginController::class, 'login']);

//dashboard routes
Route::get('dashboard', [DashboardController::class, 'index']);

//user routes
Route::get('user', [UserController::class, 'index']);

//jenis kuisioner routes
Route::get('jenis-kuisioner', [JenisKuisionerController::class, 'index']);

// kuisioner routes
Route::get('kuisioner', [KuisionerController::class, 'index']);

// detail kuisioner routes
Route::get('detail-kuisioner', [DetailKuisionerController::class, 'index']);

// perusahaan routes
Route::get('perusahaan', [PerusahaanController::class, 'index']);

// posisi routes
Route::get('posisi', [PosisiController::class, 'index']);

// penyimpanan routes
Route::get('penyimpanan', [PenyimpananController::class, 'index']);

// penyimpanan routes
Route::get('detail-penyimpanan', [DetailPenyimpananController::class, 'index']);

// laporan routes
Route::get('laporan', [LaporanController::class, 'index']);

// Route::group(['middleware' => 'admin'], function() {
//     //dashboard routes
//     Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });
