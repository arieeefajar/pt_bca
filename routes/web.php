<?php

use App\Http\Controllers\Admin\ChatGptController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DetailKuisionerController;
use App\Http\Controllers\Admin\DetailPenyimpananController;
use App\Http\Controllers\Admin\JenisKuisionerController;
use App\Http\Controllers\Admin\KuisionerController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PenyimpananController;
use App\Http\Controllers\Admin\PosisiController;
use App\Http\Controllers\Admin\RegretionNonLinier;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\JenisTanamanController;
use App\Http\Controllers\Admin\ProfileControllerAdmin;
use App\Http\Controllers\Admin\WilayahSurveyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController as ControllersProfileController;
use App\Http\Controllers\regretionController;
use App\Http\Controllers\User\DashboardSurveyerController;
use App\Http\Controllers\User\FormPesaingController;
use App\Http\Controllers\User\FormPotensiLahanController;
use App\Http\Controllers\User\KuisionerKekuatanKelemahanPesaing;
use App\Http\Controllers\User\KuisionerKepuasanPelanggan;
use App\Http\Controllers\User\KuisionerSkalaPasarProduk;
use App\Http\Controllers\User\KuisonerAnalisisPesaingController;
use App\Http\Controllers\User\ProfileControllerSurveyor;
use App\Http\Controllers\User\SurveyTokoController;
use App\Models\CustomerProdev;
use App\Models\ProdevSales;
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

Route::middleware(['prevent-back-history'])->group(function () {

	//login routes
	Route::get('/', [LoginController::class, 'login'])->name('login')->middleware('guest');
	Route::get('/login/survey', [LoginController::class, 'login'])->name('loginToko')->middleware('guest');

	Route::post('/prosesLogin', [LoginController::class, 'prosesLogin'])->name('prosesLogin')->middleware('guest');
	Route::post('/prosesLogin/survey', [LoginController::class, 'prosesLoginSurvey'])->name('prosesLoginSurvey')->middleware('guest');

	Route::prefix('register/survey')->group(function () {
		Route::get('/', [LoginController::class, 'register'])->name('register');
		Route::post('/', [LoginController::class, 'register_store']);
	});

	Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

	Route::post('/clear-selected-toko-cookie', [LoginController::class, 'clearSelectedTokoCookie'])->name('clearCookie');
	Route::get('lupaPassword', [LoginController::class, 'lupaPassword'])->name('lupaPassword');

	//profile
	Route::get('/profile', [ProfileControllerAdmin::class, 'index'])->name('profile')->middleware('auth');
	Route::post('/profile-update/{id}', [ProfileControllerAdmin::class, 'update'])->name('profile.update')->middleware('auth');
	Route::post('/password-update/{id}', [ProfileControllerAdmin::class, 'ubahPassword'])->name('password.update')->middleware('auth');

	// dashboard
	Route::get('/super-admin-dashboard', [DashboardController::class, 'supperAdmin'])->name('superAdmin.dashboard')->middleware('auth', 'access:supper-admin');
	Route::get('/admin-dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard')->middleware('auth', 'access:admin');
	Route::get('/executive-dashboard', [DashboardController::class, 'executive'])->name('executive.dashboard')->middleware('auth', 'access:executive');
	Route::get('/surveyor-dashboard', [DashboardSurveyerController::class, 'index',])->name('surveyor.dashboard')->middleware('auth', 'access:user');

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
			Route::post('/store', [JenisKuisionerController::class, 'store',])->name('jenisKuisioner.create');
			Route::post('/update', [JenisKuisionerController::class, 'update',])->name('jenisKuisioner.update');
			Route::get('/destroy/{id}', [JenisKuisionerController::class, 'destroy',])->name('jenisKuisioner.destroy');
		});

		// kuisioner routes
		Route::prefix('kuisioner')->group(function () {
			Route::get('/', [KuisionerController::class, 'index'])->name(
				'kuisioner.index'
			);
			Route::post('/store', [KuisionerController::class, 'store'])->name(
				'kuisioner.create'
			);
			Route::post('/update', [
				KuisionerController::class,
				'update',
			])->name('kuisioner.update');
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
			Route::get('/destroy/{id}', [
				PosisiController::class,
				'destroy',
			])->name('posisi.destroy');
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
			Route::post('/{id}', [
				JenisTanamanController::class,
				'update',
			])->name('jenisTanaman.update');
			Route::delete('{id}', [
				JenisTanamanController::class,
				'destroy',
			])->name('jenisTanaman.destroy');
		});

		//set wilayah surveyor
		Route::prefix('dataSurveyor')->group(function () {
			Route::get('/', [WilayahSurveyController::class, 'index'])->name(
				'dataSurveyor.index'
			);
			Route::post('/{id}', [
				WilayahSurveyController::class,
				'store',
			])->name('dataSurveyor.create');
			Route::delete('{id}', [
				WilayahSurveyController::class,
				'destroy',
			])->name('dataSurveyor.delete');
		});

		//penyimpana rote berdasarkan kategori
		Route::prefix('penyimpanan')->group(function () {
			Route::get('byToko', [PenyimpananController::class, 'index'])->name('byToko.index');

			Route::get('Kepuasan_Pelanggan', [PenyimpananController::class, 'kepuasanPelanggan'])->name('Kepuasan_Pelanggan.index');
			Route::get('Analisis_Pesaing', [PenyimpananController::class, 'analisisPesaing'])->name('Analisis_Pesaing.index');
			Route::get('Kekuatan_Kelemahan_Pesaing', [PenyimpananController::class, 'kekuatanKelemahan',])->name('Kekuatan_Kelemahan_Pesaing.index');
			Route::get('Skala_Pasar_Produk', [PenyimpananController::class, 'skalaPasarProduk'])->name('Skala_Pasar_Produk.index');
			Route::get('Potensi_Lahan', [PenyimpananController::class, 'potensiLahan'])->name('Potensi_Lahan.index');
			Route::get('Survey_Pesaing', [PenyimpananController::class, 'surveyPesaing'])->name('Survey_Pesaing.index');
		});

		//jumlah executive route
		Route::get('dataExecutive', [
			DashboardController::class,
			'dataExecutive',
		])->name('dataExecutive.index');

		//jumlah admin route
		Route::get('dataAdmin', [
			DashboardController::class,
			'dataAdmin',
		])->name('dataAdmin.index');

		// penyimpanan routes
		Route::get('detail-penyimpanan/{id}', [
			DetailPenyimpananController::class,
			'index',
		])->name('detailPenyimpanan.index');

		// detail penyimpanan routes
		Route::get('/jawaban-kepuasan-pelanggan/{idDetail?}/{apiId?}', [
			DetailPenyimpananController::class,
			'jawaban_kepuasanPelanggan',
		])->name('jawaban_kepuasanPelanggan.index');
		Route::get('/jawaban-analisis-pesaing/{idDetail?}/{apiId?}', [
			DetailPenyimpananController::class,
			'jawaban_analisisPesaing',
		])->name('jawaban_analisisPesaing.index');
		Route::get('/jawaban-kekuatan-kelemahan/{idDetail?}/{apiId?}', [
			DetailPenyimpananController::class,
			'jawaban_kekuatanKelemahan',
		])->name('jawaban_kekuatanKelemahan.index');
		Route::get('/jawaban-skala-pasar/{idDetail?}/{apiId?}', [
			DetailPenyimpananController::class,
			'jawaban_skala_pasar',
		])->name('jawaban_skala_pasar.index');
		Route::get('/jawaban-potensi-lahan/{idDetail?}/{apiId?}', [
			DetailPenyimpananController::class,
			'jawaban_potensiLahan',
		])->name('jawaban_potensiLahan.index');
		Route::get('/jawaban-form-analisis-pesaing/{idDetail?}/{apiId?}', [
			DetailPenyimpananController::class,
			'jawaban_form_analisisPesaing',
		])->name('jawaban_form_analisisPesaing.index');

		// get data wilayah
		Route::get('getKota/{id}', [
			CustomerController::class,
			'getKota',
		])->name('getkota');
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

	// route only executive
	Route::middleware(['auth', 'access:executive'])->group(function () {

		// laporan routes
		Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
		Route::get('laporan/{type}', [LaporanController::class, 'jawaban_kuisioner'])->name('laporan.jawaban');
		Route::get('laporanKota', [LaporanController::class, 'laporanKota',])->name('laporan.kota');
		Route::get('marketInsight', [LaporanController::class, 'marketInsight'])->name('market.insight');
		Route::get('competitiveInsight', [LaporanController::class, 'competitiveInsight'])->name('competitive.insight');


		// laporan perdaerah
		Route::get('laporanDaerah/{daerah}', [LaporanController::class, 'laporanDaerah'])->name('laporan.daerah');
		Route::get('marketInsightDaerah/{daerah}', [LaporanController::class, 'marketInsightDaerah'])->name('laporan.marketInsightDaerah');
		Route::get('competitiveInsight/{daerah}', [LaporanController::class, 'competitiveInsightDaerah'])->name('laporan.competitiveInsight');

		// jumlah survey toko route
		Route::get('dataSurveyToko', [DashboardController::class, 'dataSurveyToko'])->name('dataSurveyToko.index');

		// get data ai maps
		Route::get('getMapsAi', [DashboardController::class, 'getDataMaps'])->name('getMapsAi');

		// get pertanyaan kepuasan daerah
		Route::get('getPertanyaanKepuasan/{category}/{area}', [LaporanController::class, 'getPertanyaanKepuasan',])->name('getPertanyaanKepuasan');
		Route::get('getPertanyaanKepuasanByRespondents/{category}/{area}', [LaporanController::class, 'getPertanyaanKepuasanByRespondents'])->name('getPertanyaanKepuasanByRespondents');

		// get pertanyaan kepuasan all
		Route::get('getPertanyaanKepuasanAll/{category}', [LaporanController::class, 'getPertanyaanKepuasanAll',])->name('getPertanyaanKepuasanAll');
		Route::get('getPertanyaanKepuasanByRespondentsAll/{category}', [LaporanController::class, 'getPertanyaanKepuasanByRespondentsAll'])->name('getPertanyaanKepuasanByRespondentsAll');

		// get pertanyaan kekuatan kelemahan daerah
		Route::get('getPertanyaanKekuatanKelemahan/{category}/{area}', [LaporanController::class, 'getPertanyaanKekuatanKelemahan'])->name('getPertanyaanKekuatanKelemahan');
		Route::get('getPertanyaanKekuatanKelemahanByRespondents/{category}/{area}', [LaporanController::class, 'getPertanyaanKekuatanKelemahanByRespondents'])->name('getPertanyaanKekuatanKelemahanByRespondents');

		// get pertanyaan kekuatan kelemahan daerah all
		Route::get('getPertanyaanKekuatanKelemahanAll/{category}', [LaporanController::class, 'getPertanyaanKekuatanKelemahanAll'])->name('getPertanyaanKekuatanKelemahanAll');
		Route::get('getPertanyaanKekuatanKelemahanByRespondentsAll/{category}', [LaporanController::class, 'getPertanyaanKekuatanKelemahanByRespondentsAll'])->name('getPertanyaanKekuatanKelemahanByRespondentsAll');

		// get pertanyaan kuisioner analisis pesaing all
		Route::get('laporanAnalisisPesaingAll/{category?}', [LaporanController::class, 'getPertanyaanAnalisisPesaingAll']);
		Route::get('laporanAnalisisPesaingByRespondentsAll/{category?}', [LaporanController::class, 'getPertanyaanAnalisisPesaingByRespondentsAll']);

		Route::get('getRetail/{area}/{filter?}', [LaporanController::class, 'getRetailDataDaerah']);
		Route::get('getPotentionalArea/{area}/{filter?}', [LaporanController::class, 'getPotentionalAreaDaerah']);

		Route::get('getCityWordCount', [LaporanController::class, 'getKotaWordCount']);
		Route::get('getJenisTanaman', [LaporanController::class, 'getJenisTanamanRegresi']);

		Route::get('text-process/regretion', [regretionController::class, 'dataProcessing']);

		Route::post('/get-gpt', [ChatGptController::class, 'index']);

		Route::get('regretion-non-linier/{category?}', [RegretionNonLinier::class, 'index']);
		Route::get('/getPerbandinganProduk/{year}/{city}', [LaporanController::class, 'getPerbandinganProduct']);
	});

	// route other than surveyor
	Route::middleware(['auth', 'nonSurveyor'])->group(function () {
		Route::get('dataTargetToko', [DashboardController::class, 'dataTargetToko'])->name('dataTargetToko.index');
		Route::get('dataSurveyToko', [DashboardController::class, 'dataSurveyToko'])->name('dataSurveyToko.index');
	});

	// route only surveyour
	Route::middleware(['auth', 'surveyor'])->group(function () {
		//menu routes
		Route::get('menu', [DashboardSurveyerController::class, 'menu'])->name('menu.index');
		Route::get('set-store', [DashboardSurveyerController::class, 'setStore'])->name('surveyor.setStore');

		// kuisioner routes
		Route::middleware(['kuisionerRoleAccess'])->group(function () {
			// kuisioner kepusan pelanggan
			Route::prefix('kepuasan-pelanggan')->group(function () {
				Route::get('/{api_id?}', [KuisionerKepuasanPelanggan::class, 'index'])->name('kepuasanPelanggan.index');
				Route::post('/store', [KuisionerKepuasanPelanggan::class, 'store'])->name('kepuasanPelanggan.create');
			});

			// kuisioner analisis pesaing
			Route::prefix('analisis-pesaing')->group(function () {
				Route::get('/{api_id?}', [KuisonerAnalisisPesaingController::class, 'index'])->name('analisisPesaing.index');
				Route::post('/store', [KuisonerAnalisisPesaingController::class, 'store'])->name('analisisPesaing.create');
			});

			// kuisioner kekuatan dan kelemahan pesaing
			Route::prefix('kekuatan-dan-kelemahan-pesaing')->group(function () {
				Route::get('/{api_id?}', [KuisionerKekuatanKelemahanPesaing::class, 'index'])->name('KekuatanDanKelemahanPesaing.index');
				Route::post('/store', [KuisionerKekuatanKelemahanPesaing::class, 'store'])->name('KekuatanDanKelemahanPesaing.create');
			});

			// kuisioner skala pasar produk
			Route::prefix('skala-pasar-produk')->group(function () {
				Route::get('/{api_id?}', [KuisionerSkalaPasarProduk::class, 'index'])->name('SkalaPasarProduk.index');
				Route::post('/', [KuisionerSkalaPasarProduk::class, 'store'])->name('SkalaPasarProduk.create');
			});

			//form survey
			Route::prefix('pesaing')->group(function () {
				Route::get('/{api_id?}', [FormPesaingController::class, 'index'])->name('formPesaing.index');
				Route::post('/', [FormPesaingController::class, 'store'])->name('formPesaing.create');
			});

			// form pesaing
			Route::prefix('potensi-lahan')->group(function () {
				Route::get('/{api_id?}', [FormPotensiLahanController::class, 'index'])->name('formPotensiLahan.index');
				Route::post('/store', [FormPotensiLahanController::class, 'store'])->name('formPotensiLahan.create');
			});
		});

		// Data List Target Toko
		route::get('listTargetToko', [DashboardSurveyerController::class, 'listTargetToko'])->name('listTargetToko.index');
		// Data List Hasil Survey
		route::get('listHasilSurvey', [DashboardSurveyerController::class, 'listHasilSurvey'])->name('listHasilSurvey.index');
	});

	// route only toko
	Route::middleware(['onlySurveyToko'])->group(function () {
		Route::get('survey_toko', [SurveyTokoController::class, 'index'])->name('survey_toko.index');

		// get data
		Route::prefix('get-data')->group(function () {
			Route::get('/produk-benih/{jenis}', [SurveyTokoController::class, 'get_product_benih']);
			Route::get('/jenis-benih/{id_produk_benih}', [SurveyTokoController::class, 'get_jenis_benih']);
			Route::get('/nama-benih/{id_jenis_benih}', [SurveyTokoController::class, 'get_nama_produk']);
			Route::get('/produsen-benih', [SurveyTokoController::class, 'get_produsen_benih']);
		});

		// add data
		Route::prefix('add-data')->group(function () {
			Route::post('/other_4_table', [SurveyTokoController::class, 'add_other_4_table']);
			Route::post('/other_3_table', [SurveyTokoController::class, 'add_other_3_table']);
			Route::post('/other_2_table', [SurveyTokoController::class, 'add_other_2_table']);
			Route::post('/other_1_table', [SurveyTokoController::class, 'add_other_1_table']);

			Route::post('/submit', [SurveyTokoController::class, 'submit']);
			Route::post('/nama-benih', [SurveyTokoController::class, 'add_nama_benih']);
		});
	});

	Route::get('tes-regretion/{category?}', [regretionController::class, 'index']);

});

Route::get('tes-Data', function () {
	return response()->json(CustomerProdev::all());
});
