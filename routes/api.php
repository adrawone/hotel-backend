<?php

use App\Http\Controllers\Api\HotelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(HotelController::class)->group(function () {
    Route::get('/hotel', 'index');
    Route::post('/hotel', 'store');
    Route::get('/hotel/{id}', 'show');
    Route::put('/hotel/{id}', 'update');
    Route::delete('/hotel/{id}', 'destroy');
});
