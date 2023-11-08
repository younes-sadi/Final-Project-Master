<?php

use App\Http\Controllers\DevicesController;
use App\Http\Controllers\ParametreController;
use App\Http\Controllers\SensorDataController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('parametre/',[ParametreController::class,'index']);
Route::post('data/',[SensorDataController::class,'store']);
Route::post('device/',[DevicesController::class,'store']);
// Route::post(device/)
// Route::put('device/{devices}',[DevicesController::class,'update']);
