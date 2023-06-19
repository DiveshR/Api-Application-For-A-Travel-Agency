<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\TravelController;
use App\Http\Controllers\Api\v1\TourController;
use App\Http\Controllers\Api\v1\Admin\TravelController as AdminTravelController;
use App\Http\Controllers\Api\v1\Admin\TourController as AdminTourController;
use App\Http\Controllers\Api\v1\Auth\AuthController;


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

Route::apiResource('v1/travels', TravelController::class);
Route::apiResource('v1/travels/{travel:slug}/tours', TourController::class);

Route::prefix('v1/admin')->middleware(['auth:sanctum','role:admin'])->group( function(){

    Route::apiResource('travels', AdminTravelController::class)->parameters(['travels' => 'travel:slug']);
    
    Route::apiResource('travels/{travel:slug}/tours', AdminTourController::class);

});

    Route::post('v1/auth/login', [AuthController::class,'login']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
