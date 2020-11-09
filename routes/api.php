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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Auth')->group(function () {
    Route::post('register', 'RegisterController');

    Route::post('verification', 'VerificationController');

    Route::post('regenerate-otp', 'RegenerateOtpController');

    Route::post('update-password', 'UpdatePasswordController');

    Route::post('login', 'LoginController');

    Route::post('logout', 'LogoutController');
});

Route::namespace('Profile')->middleware('auth:api')->group(function () {
    Route::get('profile/get-profile', 'GetProfileController');

    Route::post('profile/update-profile', 'UpdateProfileController');
});
