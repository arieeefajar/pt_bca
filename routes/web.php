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
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\DashboardSurveyerController;
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

// guest routes
Route::group(['middleware' => ['guest']], function () {
    //login routes
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/', [LoginController::class, 'prosesLogin'])->name('prosesLogin');
    Route::match(['get', 'post'], '/keluar', [LoginController::class, 'logout'])->name('logout');
});

// auth routes
Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['access:supper-admin']], function () {
        Route::get('/', [DashboardController::class, 'supperAdmin']);

        //user routes
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('user.index');
            Route::post('/', [UserController::class, 'create'])->name('user.create');
            Route::post('/{id}', [UserController::class, 'update'])->name('user.update');
            Route::delete('{id}', [UserController::class, 'destroy'])->name('user.destroy');
        });

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
        Route::prefix('perusahaan')->group(function () {
            Route::get('/', [PerusahaanController::class, 'index']);
            Route::post('/store', [PerusahaanController::class, 'store']);
            Route::post('/update', [PerusahaanController::class, 'update']);
            Route::get('/destroy/{id}', [PerusahaanController::class, 'destroy']);
        });

        // posisi routes
        Route::prefix('posisi')->group(function () {
            Route::get('/', [PosisiController::class, 'index']);
            Route::post('/store', [PosisiController::class, 'store']);
            Route::post('/update', [PosisiController::class, 'update']);
            Route::get('/destroy/{id}', [PosisiController::class, 'destroy']);
        });

        // detail penyimpanan routes
        Route::get('penyimpanan', [PenyimpananController::class, 'index']);

        // penyimpanan routes
        Route::get('detail-penyimpanan', [DetailPenyimpananController::class, 'index']);

        // laporan routes
        Route::get('laporan', [LaporanController::class, 'index']);

    });

    Route::group(['middleware' => ['access:admin']], function () {
        Route::get('/', [DashboardController::class, 'admin']);
    });

    Route::group(['middleware' => ['access:executive']], function () {
        Route::get('executive-dashboard', [DashboardController::class, 'executive']);
    });

    Route::group(['middleware' => ['access:user']], function () {
        Route::get('/', [DashboardSurveyerController::class, 'index']);

        // kuisioner routes
        Route::get('kepuasan-pelanggan', [KuisionerController::class, 'kepuasanPelanggan']);
        Route::get('analisis-pesaing', [KuisionerController::class, 'analisisPesaing']);
        Route::get('kekuatan-dan-kelemahan-pesaing', [KuisionerController::class, 'kekuatanKelemahanPesaing']);

        //form survey
        Route::get('pesaing', [DashboardController::class, 'pesaing']);
        Route::get('potensi-lahan', [DashboardController::class, 'potensi']);
    });
});
