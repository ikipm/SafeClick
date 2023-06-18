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

// Catalan
Route::get('/', function () {
    return view('landingPage/cat');
});
Route::get('login/', function() {
    return view('loginPage/cat');
});

// Spanish
Route::group(['prefix' => 'es'], function() {
    Route::get('/', function () {
        return view('landingPage/es');
    });
    Route::get('login/', function() {
        return view('loginPage/es');
    });
});

// English
Route::group(['prefix' => 'en'], function() {
    Route::get('/', function () {
        return view('landingPage/en');
    });
    Route::get('login/', function() {
        return view('loginPage/en');
    });
});