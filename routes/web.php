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

Route::post('/keluar', [LoginController::class, 'logout'])->name('logout');

// guest routes
Route::group(['middleware' => ['guest']], function () {
    //login routes
    Route::get('/', [LoginController::class, 'login'])->name('login');
    Route::post('/prosesLogin', [LoginController::class, 'prosesLogin'])->name('prosesLogin');
});

Route::prefix('super-admin')->middleware('auth', 'access:supper-admin')->name('superAdmin.index')->group(function () {
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

Route::prefix('admin')->middleware('auth', 'access:admin')->name('admin.index')->group(function () {
    Route::get('/', [DashboardController::class, 'admin']);
});

Route::prefix('executive')->middleware('auth', 'access:executive')->name('executive.index')->group(function () {
    Route::get('/', [DashboardController::class, 'executive']);
});

Route::prefix('surveyor')->middleware('auth', 'access:user')->name('surveyor.index')->group(function () {
    Route::get('/', [DashboardSurveyerController::class, 'index']);

    // kuisioner routes
    Route::get('kepuasan-pelanggan', [KuisionerController::class, 'kepuasanPelanggan'])->name('kepuasanPelanggan.index');
    Route::get('analisis-pesaing', [KuisionerController::class, 'analisisPesaing'])->name('analisisPesaing.index');
    Route::get('kekuatan-dan-kelemahan-pesaing', [KuisionerController::class, 'kekuatanKelemahanPesaing'])->name('KekuatanDanKelemahanPesaing.index');

    //form survey
    Route::get('pesaing', [DashboardController::class, 'pesaing'])->name('formPesaing.index');
    Route::get('potensi-lahan', [DashboardController::class, 'potensi'])->name('formPotensiLahan.index');
});
