<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProductController;
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


Route::group(['middleware' => ['auth:api']], function () {
    Route::apiResources([
        'products' => ProductController::class,
        'events' => EventController::class,
    ]);
});

Route::apiResources([
    'countries' => CountryController::class,
]);
