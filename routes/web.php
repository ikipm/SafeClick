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

$locales = ['cat', 'es', 'en'];

Route::prefix('{locale}')->group(function () use ($locales) {
    Route::view('/', 'landingPage')->name('landingPage')->middleware('setLocale');
    Route::view('/login', 'loginPage')->name('loginPage')->middleware('setLocale');
});

Route::get("/", function () {
    return redirect("cat");
});

Route::bind('locale', function ($value) use ($locales) {
    if (!in_array($value, $locales)) {
        abort(404);
    }
    return $value;
});
