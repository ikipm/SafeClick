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

// Landing page
Route::get('/', function () {
    return view('/landingPage/cat');
});
Route::get('/es', function () {
    return view('/landingPage/es');
});
Route::get('/en', function () {
    return view('/landingPage/en');
});
