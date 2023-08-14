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
use App\Http\Controllers\SadminController;
use App\Http\Controllers\SdashboardController;

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
Route::post('/', [LoginController::class, 'prosesLogin'])->name('prosesLogin');
Route::match(['get', 'post'],  '/keluar', [LoginController::class, 'logout'])->name('logout');

//dashboard routes
Route::get('supper-dashboard', [DashboardController::class, 'supperAdmin']);
Route::get('admin-dashboard', [DashboardController::class, 'admin']);
Route::get('executive-dashboard', [DashboardController::class, 'executive']);
Route::get('surveyor-dashboard', [DashboardController::class, 'surveyor']);

// surveyor routes
// kepuasan pelanggan routes
Route::get('kepuasan-pelanggan', [KuisionerController::class, 'kepuasanPelanggan']);
Route::get('analisis-pesaing', [KuisionerController::class, 'analisisPesaing']);
Route::get('kekuatan-dan-kelemahan-pesaing', [KuisionerController::class, 'kekuatanKelemahanPesaing']);

//user routes
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::post('/user', [UserController::class, 'create'])->name('user.create');
Route::post('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

//jenis kuisioner routes
Route::prefix('jenis-kuisioner')->group(function () {
    Route::get('/', [JenisKuisionerController::class, 'index']);
    Route::post('/store', [JenisKuisionerController::class, 'store']);
    Route::post('/update', [JenisKuisionerController::class, 'update']);
    Route::get('/destroy/{id}', [JenisKuisionerController::class, 'destroy']);
});

// kuisioner routes
Route::prefix('kuisioner')->group(function () {
    Route::get('/', [KuisionerController::class, 'index']);
    Route::post('/store', [KuisionerController::class, 'store']);
    Route::post('/update', [KuisionerController::class, 'update']);
    Route::get('/destroy/{id}', [KuisionerController::class, 'destroy']);
});

// detail kuisioner routes
Route::prefix('detail-kuisioner')->group(function () {
    Route::get('/', [DetailKuisionerController::class, 'index']);
    Route::post('/store', [DetailKuisionerController::class, 'store']);
    Route::post('/update', [DetailKuisionerController::class, 'update']);
    Route::get('/destroy/{id}', [DetailKuisionerController::class, 'destroy']);
});

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

//form survey
Route::get('pesaing', [DashboardController::class, 'pesaing']);
Route::get('potensi-lahan', [DashboardController::class, 'potensi']);

// Route::group(['middleware' => ['auth', 'supper-admin']], function () {

//     //user route
//     Route::get('user', [UserController::class, 'index'])->name('user.index');
//     Route::post('/user', [UserController::class, 'create'])->name('user.create');
// });
