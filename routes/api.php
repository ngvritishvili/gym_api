<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
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

    Route::post('step/settings', [SettingController::class, 'setupSteps']);
    Route::post('calorie/settings', [SettingController::class, 'setupCalories']);
    Route::get('settings', [SettingController::class, 'index']);

    Route::post('events/roll/{event}', [EventController::class, 'rollUser']);
    Route::post('events/roll/{event}/ticket', [EventController::class, 'getWinner']);
});

Route::apiResources([
    'countries' => CountryController::class,
]);
