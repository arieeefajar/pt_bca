<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DetailKuisionerController;
use App\Http\Controllers\Admin\DetailPenyimpananController;
use App\Http\Controllers\Admin\JenisKuisionerController;
use App\Http\Controllers\Admin\KuisionerController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PenyimpananController;
use App\Http\Controllers\Admin\PosisiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\JenisTanamanController;
use App\Http\Controllers\Admin\ProfileControllerAdmin;
use App\Http\Controllers\Admin\WilayahSurveyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController as ControllersProfileController;
use App\Http\Controllers\User\DashboardSurveyerController;
use App\Http\Controllers\User\FormPesaingController;
use App\Http\Controllers\User\FormPotensiLahanController;
use App\Http\Controllers\User\KuisionerKekuatanKelemahanPesaing;
use App\Http\Controllers\User\KuisionerKepuasanPelanggan;
use App\Http\Controllers\User\KuisionerSkalaPasarProduk;
use App\Http\Controllers\User\KuisonerAnalisisPesaingController;
use App\Http\Controllers\User\ProfileControllerSurveyor;
use App\Models\Provinsi;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
Route::get('/', [LoginController::class, 'login'])
    ->name('login')
    ->middleware('guest');
Route::post('/prosesLogin', [LoginController::class, 'prosesLogin'])
    ->name('prosesLogin')
    ->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/clear-selected-toko-cookie', [
    LoginController::class,
    'clearSelectedTokoCookie',
])->name('clearCookie');
Route::get('lupaPassword', [LoginController::class, 'lupaPassword'])->name(
    'lupaPassword'
);

// dashboard
Route::get('/super-admin-dashboard', [
    DashboardController::class,
    'supperAdmin',
])
    ->name('superAdmin.dashboard')
    ->middleware('auth', 'access:supper-admin');
Route::get('/admin-dashboard', [DashboardController::class, 'admin'])
    ->name('admin.dashboard')
    ->middleware('auth', 'access:admin');
Route::get('/executive-dashboard', [DashboardController::class, 'executive'])
    ->name('executive.dashboard')
    ->middleware('auth', 'access:executive');
Route::get('/surveyor-dashboard', [DashboardSurveyerController::class, 'index'])
    ->name('surveyor.dashboard')
    ->middleware('auth', 'access:user');

//tes route
Route::get('/tes', [DashboardController::class, 'tes'])->name('tes.index');
Route::get('/jawaban-kepuasan-pelanggan/{idDetail}/{apiId}', [
    DetailPenyimpananController::class,
    'jawaban_kepuasanPelanggan',
])->name('jawaban_kepuasanPelanggan.index');
Route::get('/jawaban-kekuatan-kelemahan/{idDetail}/{apiId}', [
    DetailPenyimpananController::class,
    'jawaban_kekuatanKelemahan',
])->name('jawaban_kekuatanKelemahan.index');
Route::get('/jawaban-analisis-pesaing/{idDetail}/{apiId}', [
    DetailPenyimpananController::class,
    'jawaban_analisisPesaing',
])->name('jawaban_analisisPesaing.index');
Route::get('/jawaban-potensi-lahan/{idDetail}/{apiId}', [
    DetailPenyimpananController::class,
    'jawaban_potensiLahan',
])->name('jawaban_potensiLahan.index');
Route::get('/jawaban-form-analisis-pesaing/{idDetail}/{apiId}', [
    DetailPenyimpananController::class,
    'jawaban_form_analisisPesaing',
])->name('jawaban_form_analisisPesaing.index');

// route only super admin & admin
Route::middleware(['auth', 'superAndAdmin'])->group(function () {
    //user routes
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::post('/', [UserController::class, 'create'])->name(
            'user.create'
        );
        Route::post('/{id}', [UserController::class, 'update'])->name(
            'user.update'
        );
        Route::delete('{id}', [UserController::class, 'destroy'])->name(
            'user.destroy'
        );
    });

    //jenis kuisioner routes
    Route::prefix('jenis-kuisioner')->group(function () {
        Route::get('/', [JenisKuisionerController::class, 'index'])->name(
            'jenisKuisioner.index'
        );
        Route::post('/store', [JenisKuisionerController::class, 'store'])->name(
            'jenisKuisioner.create'
        );
        Route::post('/update', [
            JenisKuisionerController::class,
            'update',
        ])->name('jenisKuisioner.update');
        Route::get('/destroy/{id}', [
            JenisKuisionerController::class,
            'destroy',
        ])->name('jenisKuisioner.destroy');
    });

    // kuisioner routes
    Route::prefix('kuisioner')->group(function () {
        Route::get('/', [KuisionerController::class, 'index'])->name(
            'kuisioner.index'
        );
        Route::post('/store', [KuisionerController::class, 'store'])->name(
            'kuisioner.create'
        );
        Route::post('/update', [KuisionerController::class, 'update'])->name(
            'kuisioner.update'
        );
        Route::get('/destroy/{id}', [
            KuisionerController::class,
            'destroy',
        ])->name('kuisioner.destroy');
    });

    // detail kuisioner routes
    Route::prefix('detail-kuisioner')->group(function () {
        Route::get('/', [DetailKuisionerController::class, 'index'])->name(
            'detailKuisioner.index'
        );
        Route::post('/store', [
            DetailKuisionerController::class,
            'store',
        ])->name('detailKuisioner.create');
        Route::post('/update', [
            DetailKuisionerController::class,
            'update',
        ])->name('detailKuisioner.update');
        Route::get('/destroy/{id}', [
            DetailKuisionerController::class,
            'destroy',
        ])->name('detailKuisioner.destroy');
    });

    // customer routes
    Route::prefix('customer')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name(
            'customer.index'
        );
        Route::post('/', [CustomerController::class, 'store'])->name(
            'customer.create'
        );
        Route::post('/{id}', [CustomerController::class, 'update'])->name(
            'customer.update'
        );
        Route::delete('{id}', [CustomerController::class, 'destroy'])->name(
            'customer.destroy'
        );
    });

    // posisi routes
    Route::prefix('posisi')->group(function () {
        Route::get('/', [PosisiController::class, 'index'])->name(
            'posisi.index'
        );
        Route::post('/store', [PosisiController::class, 'store'])->name(
            'posisi.create'
        );
        Route::post('/update', [PosisiController::class, 'update'])->name(
            'posisi.update'
        );
        Route::get('/destroy/{id}', [PosisiController::class, 'destroy'])->name(
            'posisi.destroy'
        );
    });

    //product routes
    Route::prefix('produk')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name(
            'product.index'
        );
        Route::post('/', [ProductController::class, 'store'])->name(
            'product.create'
        );
        Route::post('/{id}', [ProductController::class, 'update'])->name(
            'product.update'
        );
        Route::delete('{id}', [ProductController::class, 'destroy'])->name(
            'product.destroy'
        );
    });

    //jenis tamanan routes
    Route::prefix('jenisTanaman')->group(function () {
        Route::get('/', [JenisTanamanController::class, 'index'])->name(
            'jenisTanaman.index'
        );
        Route::post('/', [JenisTanamanController::class, 'store'])->name(
            'jenisTanaman.create'
        );
        Route::post('/{id}', [JenisTanamanController::class, 'update'])->name(
            'jenisTanaman.update'
        );
        Route::delete('{id}', [JenisTanamanController::class, 'destroy'])->name(
            'jenisTanaman.destroy'
        );
    });

    //set wilayah surveyor
    Route::prefix('dataSurveyor')->group(function () {
        Route::get('/', [WilayahSurveyController::class, 'index'])->name(
            'dataSurveyor.index'
        );
        Route::post('/{id}', [WilayahSurveyController::class, 'store'])->name(
            'dataSurveyor.create'
        );
    });

    //jumlah executive route
    Route::get('dataExecutive', [
        DashboardController::class,
        'dataExecutive',
    ])->name('dataExecutive.index');

    //jumlah admin route
    Route::get('dataAdmin', [DashboardController::class, 'dataAdmin'])->name(
        'dataAdmin.index'
    );

    //jumlah target toko route
    Route::get('dataTargetToko', [
        DashboardController::class,
        'dataTargetToko',
    ])->name('dataTargetToko.index');

    //jumlah target toko route
    Route::get('dataSurveyToko', [
        DashboardController::class,
        'dataSurveyToko',
    ])->name('dataSurveyToko.index');

    // detail penyimpanan routes
    Route::get('penyimpanan', [PenyimpananController::class, 'index'])->name(
        'penyimpanan.index'
    );

    // penyimpanan routes
    Route::get('detail-penyimpanan/{id}', [
        DetailPenyimpananController::class,
        'index',
    ])->name('detailPenyimpanan.index');

    // laporan routes
    Route::get('laporan', [LaporanController::class, 'index'])->name(
        'laporan.index'
    );

    //Profile
    Route::prefix('profileAdmin')->group(function () {
        Route::get('/', [ProfileControllerAdmin::class, 'index'])->name(
            'profile.index'
        );
        Route::post('/profile/{id}', [
            ProfileControllerAdmin::class,
            'update',
        ])->name('profile.update');
        Route::post('/password/{id}', [
            ProfileControllerAdmin::class,
            'ubahPassword',
        ])->name('password.update');
    });

    // get data wilayah
    Route::get('getKota/{id}', [CustomerController::class, 'getKota'])->name(
        'getkota'
    );
    Route::get('getKecamatan/{id}', [
        CustomerController::class,
        'getKecamatan',
    ])->name('getkecamatan');
    Route::get('getKelurahan/{id}', [
        CustomerController::class,
        'getKelurahan',
    ])->name('getkelurahan');

    Route::get('getAllLocation/{id_kota}', [
        CustomerController::class,
        'getProvinsi',
    ])->name('getAllLocation');
});

// route only surveyour
Route::middleware(['auth', 'surveyor'])->group(function () {
    //menu routes
    Route::get('menu', [DashboardSurveyerController::class, 'menu'])->name(
        'menu.index'
    );
    Route::get('set-store', [
        DashboardSurveyerController::class,
        'setStore',
    ])->name('surveyor.setStore');

    // kuisioner routes
    // kuisioner kepusan pelanggan
    Route::prefix('kepuasan-pelanggan')->group(function () {
        Route::get('/', [KuisionerKepuasanPelanggan::class, 'index'])->name(
            'kepuasanPelanggan.index'
        );
        Route::post('/store', [
            KuisionerKepuasanPelanggan::class,
            'store',
        ])->name('kepuasanPelanggan.create');
    });

    // kuisioner analisis pesaing
    Route::prefix('analisis-pesaing')->group(function () {
        Route::get('/', [
            KuisonerAnalisisPesaingController::class,
            'index',
        ])->name('analisisPesaing.index');
        Route::post('/store', [
            KuisonerAnalisisPesaingController::class,
            'store',
        ])->name('analisisPesaing.create');
    });

    // kuisioner kekuatan dan kelemahan pesaing
    Route::prefix('kekuatan-dan-kelemahan-pesaing')->group(function () {
        Route::get('/', [
            KuisionerKekuatanKelemahanPesaing::class,
            'index',
        ])->name('KekuatanDanKelemahanPesaing.index');
        Route::post('/store', [
            KuisionerKekuatanKelemahanPesaing::class,
            'store',
        ])->name('KekuatanDanKelemahanPesaing.create');
    });

    // kuisioner skala pasar produk
    Route::prefix('skala-pasar-produk')->group(function () {
        Route::get('/', [KuisionerSkalaPasarProduk::class, 'index'])->name(
            'SkalaPasarProduk.index'
        );
        Route::post('/', [KuisionerSkalaPasarProduk::class, 'store'])->name(
            'SkalaPasarProduk.create'
        );
    });

    //form survey
    Route::prefix('pesaing')->group(function () {
        Route::get('/', [FormPesaingController::class, 'index'])->name(
            'formPesaing.index'
        );
        Route::post('/', [FormPesaingController::class, 'store'])->name(
            'formPesaing.create'
        );
    });

    // form pesaing
    Route::prefix('potensi-lahan')->group(function () {
        Route::get('/', [FormPotensiLahanController::class, 'index'])->name(
            'formPotensiLahan.index'
        );
        Route::post('/store', [
            FormPotensiLahanController::class,
            'store',
        ])->name('formPotensiLahan.create');
    });

    // Data List Target Toko
    route::get('listTargetToko', [
        DashboardController::class,
        'listTargetToko',
    ])->name('listTargetToko.index');

    // Data List Hasil Survey
    route::get('listHasilSurvey', [
        DashboardController::class,
        'listHasilSurvey',
    ])->name('listHasilSurvey.index');

    // Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileControllerSurveyor::class, 'index'])->name(
            'profile.Surveyor'
        );
        Route::post('/profile/{id}', [
            ProfileControllerSurveyor::class,
            'profileUpdate',
        ])->name('profile.Update');
        Route::post('/password/{id}', [
            ProfileControllerSurveyor::class,
            'ubahPassword',
        ])->name('password.Update');
    });
});

Route::get('/testingAnu', function () {
    $pathJson = base_path('database/seeders/dataJson/pegawai.json');
    $readJson = file_get_contents($pathJson);
    $jsonData = [json_decode($readJson, true)];

    dd($jsonData[0]['employees']);
    foreach ($jsonData[0]['employees'] as $provinsi) {
        dd($provinsi['NIP']);
    }
});
