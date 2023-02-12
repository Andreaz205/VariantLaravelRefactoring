<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/products', [\App\Http\Controllers\Product\ProductController::class, 'store']);

Route::post('/products/{product}/variants', [\App\Http\Controllers\Variant\VariantController::class, 'store']);

Route::post('/products/variants/{variant}/options', [\App\Http\Controllers\Option\OptionController::class, 'store']);
