<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\JenisTanamanController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\WilayahController;
use App\Http\Controllers\Admin\WilayahSurveyController;
use App\Http\Controllers\KuisionerController;
use App\Http\Controllers\User\SurveyTokoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('customer')->group(function(){
    Route::get('/', [CustomerController::class, 'index']);
    Route::post('/store', [CustomerController::class, 'store']);
});

Route::prefix('jenis_tanaman')->group(function(){
    Route::post('/store', [JenisTanamanController::class, 'store']);
    Route::post('/update', [JenisTanamanController::class, 'update']);
    Route::get('/destroy/{id}', [JenisTanamanController::class, 'destroy']);
});

Route::prefix('produk')->group(function(){
    Route::post('/store', [ProductController::class, 'store']);
    Route::post('/update', [ProductController::class, 'update']);
    Route::get('/destroy/{id}', [ProductController::class, 'destroy']);
});

Route::prefix('wilayah')->group(function(){
    Route::get('/', [WilayahController::class, 'index']);
    Route::post('/store', [WilayahController::class, 'store']);
    Route::post('/update', [WilayahController::class, 'update']);
    Route::get('/destroy/{id}', [WilayahController::class, 'destroy']);
});

Route::prefix('wilayah_survey')->group(function(){
    Route::get('/', [WilayahSurveyController::class, 'index']);
    Route::post('/store', [WilayahSurveyController::class, 'store']);
    Route::post('/update', [WilayahSurveyController::class, 'update']);
    Route::get('/destroy/{id}', [WilayahSurveyController::class, 'destroy']);
});

Route::prefix('add-data')->group(function () {
    Route::post('/nama-benih', [SurveyTokoController::class,'add_nama_benih']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
