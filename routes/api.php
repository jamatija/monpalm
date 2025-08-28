<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\VenueController as VenueV1;
use App\Http\Controllers\Api\V1\MunicipalityController as MunicipalityV1;
use App\Http\Controllers\Api\V1\VenueTypeController as VenueTypeV1;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function () {
    Route::apiResource('venues', VenueV1::class);
    Route::apiResource('municipalities', MunicipalityV1::class);
    Route::apiResource('venue-types', VenueTypeV1::class);
});
