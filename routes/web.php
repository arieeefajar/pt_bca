<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DetailKuisionerController;
use App\Http\Controllers\Admin\DetailPenyimpananController;
use App\Http\Controllers\Admin\JenisKuisionerController;
use App\Http\Controllers\Admin\KuisionerController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PenyimpananController;
use App\Http\Controllers\Admin\PerusahaanController;
use App\Http\Controllers\Admin\PosisiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\TestApi;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\DashboardSurveyerController;
use App\Http\Controllers\User\KuisionerKekuatanKelemahanPesaing;
use App\Http\Controllers\User\KuisonerAnalisisPesaingController;
use Illuminate\Support\Facades\Route;

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

// Route::get('callApi', [TestApi::class, 'getDataKompetitorAnalys']);

//login routes
Route::get('/', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/prosesLogin', [LoginController::class, 'prosesLogin'])->name('prosesLogin')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// dashboard
Route::get('/super-admin-dashboard', [DashboardController::class, 'supperAdmin'])->name('superAdmin.dashboard')->middleware('auth', 'access:supper-admin');
Route::get('/admin-dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard')->middleware('auth', 'access:admin');
Route::get('/executive-dashboard', [DashboardController::class, 'executive'])->name('executive.dashboard')->middleware('auth', 'access:executive');
Route::get('/surveyor-dashboard', [DashboardSurveyerController::class, 'index'])->name('surveyor.dashboard')->middleware('auth', 'access:user');

// route only super admin & admin
Route::middleware(['auth', 'superAndAdmin'])->group(function () {

    //user routes
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::post('/', [UserController::class, 'create'])->name('user.create');
        Route::post('/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });

    //jenis kuisioner routes
    Route::prefix('jenis-kuisioner')->group(function () {
        Route::get('/', [JenisKuisionerController::class, 'index'])->name('jenisKuisioner.index');
        Route::post('/store', [JenisKuisionerController::class, 'store'])->name('jenisKuisioner.create');
        Route::post('/update', [JenisKuisionerController::class, 'update'])->name('jenisKuisioner.update');
        Route::get('/destroy/{id}', [JenisKuisionerController::class, 'destroy'])->name('jenisKuisioner.destroy');
    });

    // kuisioner routes
    Route::prefix('kuisioner')->group(function () {
        Route::get('/', [KuisionerController::class, 'index'])->name('kuisioner.index');
        Route::post('/store', [KuisionerController::class, 'store'])->name('kuisioner.create');
        Route::post('/update', [KuisionerController::class, 'update'])->name('kuisioner.update');
        Route::get('/destroy/{id}', [KuisionerController::class, 'destroy'])->name('kuisioner.destroy');
    });

    // detail kuisioner routes
    Route::prefix('detail-kuisioner')->group(function () {
        Route::get('/', [DetailKuisionerController::class, 'index'])->name('detailKuisioner.index');
        Route::post('/store', [DetailKuisionerController::class, 'store'])->name('detailKuisioner.create');
        Route::post('/update', [DetailKuisionerController::class, 'update'])->name('detailKuisioner.update');
        Route::get('/destroy/{id}', [DetailKuisionerController::class, 'destroy'])->name('detailKuisioner.destroy');
    });

    // perusahaan routes
    Route::prefix('perusahaan')->group(function () {
        Route::get('/', [PerusahaanController::class, 'index'])->name('perusahaan.index');
        Route::post('/store', [PerusahaanController::class, 'store'])->name('perusahaan.create');
        Route::post('/update', [PerusahaanController::class, 'update'])->name('perusahaan.update');
        Route::get('/destroy/{id}', [PerusahaanController::class, 'destroy'])->name('perusahaan.destroy');
    });

    // posisi routes
    Route::prefix('posisi')->group(function () {
        Route::get('/', [PosisiController::class, 'index'])->name('posisi.index');
        Route::post('/store', [PosisiController::class, 'store'])->name('posisi.create');
        Route::post('/update', [PosisiController::class, 'update'])->name('posisi.update');
        Route::get('/destroy/{id}', [PosisiController::class, 'destroy'])->name('posisi.destroy');
    });

    // detail penyimpanan routes
    Route::get('penyimpanan', [PenyimpananController::class, 'index'])->name('penyimpanan.index');

    // penyimpanan routes
    Route::get('detail-penyimpanan', [DetailPenyimpananController::class, 'index'])->name('detailPenyimpanan.index');

    // laporan routes
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
});

// route only surveyour
Route::middleware(['auth', 'surveyor'])->group(function () {

    // kuisioner kepusan pelanggan
    Route::get('kepuasan-pelanggan', [KuisionerController::class, 'kepuasanPelanggan'])->name('kepuasanPelanggan.index');

    // kuisioner analisis pesaing
    Route::prefix('analisis-pesaing')->group(function () {
        Route::get('/', [KuisonerAnalisisPesaingController::class, 'index'])->name('analisisPesaing.index');
        Route::post('/store', [KuisonerAnalisisPesaingController::class, 'store'])->name('analisisPesaing.create');
    });

    // kuisioner kekuatan dan kelemahan pesaing
    Route::prefix('kekuatan-dan-kelemahan-pesaing')->group(function () {
        Route::get('/', [KuisionerKekuatanKelemahanPesaing::class, 'index'])->name('KekuatanDanKelemahanPesaing.index');
        Route::post('/store', [KuisionerKekuatanKelemahanPesaing::class, 'store'])->name('KekuatanDanKelemahanPesaing.create');
    });

    //form survey
    Route::get('pesaing', [DashboardController::class, 'pesaing'])->name('formPesaing.index');
    Route::get('potensi-lahan', [DashboardController::class, 'potensi'])->name('formPotensiLahan.index');
});
