<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\VenueController as VenueV1;
use App\Http\Controllers\Api\V1\MunicipalityController as MunicipalityV1;
use App\Http\Controllers\Api\V1\VenueTypeController as VenueTypeV1;
use App\Http\Controllers\Api\V1\HighlightController as HighlightV1;
use App\Http\Controllers\Api\V1\AuthController as AuthV1;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthV1::class, 'register']);
Route::post('/login', [AuthV1::class, 'login'])->name('login'); 
Route::post('/logout', [AuthV1::class, 'logout'])->middleware('auth:sanctum');

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::apiResource('venues', VenueV1::class);
    Route::apiResource('municipalities', MunicipalityV1::class);
    Route::apiResource('venue-types', VenueTypeV1::class);
    Route::apiResource('highlights', HighlightV1::class);
});
