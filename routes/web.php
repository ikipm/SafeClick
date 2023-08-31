<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LocaleController;
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

// User system /register and /login (POST) /logout (GET)
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/admin/register', [UserController::class, 'adminRegister'])->middleware('admin')->name('admin.register');
Route::get('/admin/search', [UserController::class, 'adminSearch'])->middleware('admin')->name('admin.search');
Route::post('/admin/courses/create', [CourseController::class, 'store'])->name('admin.createCourse');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Define the route for changing the locale
Route::get('/locale/{lang}', [LocaleController::class, 'changeLocale'])->name('changeLocale');

Route::group(['middleware' => 'setLocale'], function () {
    Route::view('/', 'landingPage')->name('landingPage');
    Route::view('/login', 'loginPage')->name('loginPage');
    Route::view('/courses', 'courses')->middleware('auth')->name('courses');
    Route::get('/courses/{courseId}', [CourseController::class, 'courseInfo'])->middleware('auth')->name('courseID'); // The view is in Course controller
    Route::view('/admin', 'admin')->middleware('admin')->name('admin');
    Route::view('/admin/users', 'admin.users')->middleware('admin')->name('admin.users');
    Route::view('/admin/courses', 'admin.courses')->middleware('admin')->name('admin.courses');
});
