<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'email'])->group(function () {

    Route::get('/route-1', function () {
        return 'Selamat Telah Masuk ke halaman setelah verifikasi email';
    });
});

Route::middleware(['auth', 'email', 'admin'])->group(function () {

    Route::get('/route-2', function () {
        return 'Selamat Datang Admin';
    });
});
