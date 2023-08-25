<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\JenisTanamanController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\KuisionerController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
