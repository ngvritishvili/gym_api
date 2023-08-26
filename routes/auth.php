<?php

use App\Http\Controllers\Auth\AuthController;
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

//Socialite
Route::post('/auth/social/callback',[AuthController::class,'socialCallback']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:api');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware(['signed'])->name('verification.verify');
//    Route::post('/phone/verify/{user_id}/{code}', [AuthController::class, 'verifyPhone']);
    Route::post('/forgot-password', [AuthController::class, 'passwordReset']);
    Route::post('/email/reset-password', [AuthController::class, 'updatePasswordFromLink'])->name('password.reset');
//    Route::post('/phone/reset-password', [AuthController::class, 'updatePasswordFromPhone']);
//    Route::post('/phone/check-otp', [AuthController::class, 'checkOtp']);
//    Route::post('/phone/resend-otp', [AuthController::class, 'sendPhoneResetCode']);
});
