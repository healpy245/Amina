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

Route::apiResource('categories', App\Http\Controllers\CategoryController::class);
Route::apiResource('dresses', App\Http\Controllers\DressController::class);
Route::apiResource('clients', App\Http\Controllers\ClientController::class);
Route::apiResource('appointments', App\Http\Controllers\AppointmentController::class);
Route::apiResource('contracts', App\Http\Controllers\ContractController::class);
Route::apiResource('payments', App\Http\Controllers\PaymentController::class); 