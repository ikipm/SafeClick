<?php

use App\Http\Controllers\UserController;
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

// Locales permitted
$locales = ['cat', 'es', 'en'];

// User system /register and /login (POST) /logout (GET)
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// When accessing to /, redirect to /cat
Route::redirect('/', '/cat');

// Pages using locale
Route::group(['prefix' => '{locale}', 'middleware' => 'setLocale'], function () use ($locales) {
    Route::view('/', 'landingPage')->name('landingPage');
    Route::view('/login', 'loginPage')->name('loginPage');
    Route::view('/courses', 'courses')->middleware('auth')->name('courses');
});

// If there is a locale not valid, return 404
Route::bind('locale', function ($value) use ($locales) {
    if (!in_array($value, $locales)) {
        abort(404);
    }
    return $value;
});
