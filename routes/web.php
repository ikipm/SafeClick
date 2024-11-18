<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

// User system routes
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/loginTest', [UserController::class, 'loginTest'])->name('loginTest');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/admin/news/create', [NewsController::class, 'store'])->middleware('auth')->middleware('verify')->middleware('admin')->name('admin.createNews');

// Admin routes with auth, verify and admin middleware.
Route::middleware(['auth', 'verify', 'admin'])->group(function () {
    Route::post('/admin/register', [UserController::class, 'adminRegister'])->name('admin.register');
    Route::get('/admin/search', [UserController::class, 'adminSearch'])->name('admin.search');
    Route::post('/admin/courses/create', [CourseController::class, 'store'])->name('admin.createCourse');
    Route::get('admin/course/search', [CourseController::class, 'search'])->name('admin.searchCourse');
    Route::post('admin/courses/edit/{id}', [CourseController::class, 'updateCourseTitle'])->name('admin.editCourse');
    Route::post('admin/courses/content/add/{id}', [CourseController::class, 'storeContent'])->name('admin.addContent');
    Route::post('admin/courses/content/edit/{id}/{contentId}', [CourseController::class, 'updateContent'])->name('admin.editContent');
    Route::view('/admin/logs/404', 'admin.logs.404')->name('admin.logs.404');
    Route::view('/admin/logs/guest', 'admin.logs.guest')->name('admin.logs.guest');
    Route::post('/admin/news/create', [NewsController::class, 'store'])->name('admin.createNews');
    Route::view('/admin', 'admin')->name('admin');
    Route::view('/admin/users', 'admin.users')->name('admin.users');
    Route::view('/admin/courses', 'admin.courses')->name('admin.courses');
    Route::get('/admin/courses/edit/{courseId}', [CourseController::class, 'courseEditInfo'])->name('admin.coursesEdit');
    Route::get('/admin/courses/content/{courseId}', [CourseController::class, 'courseInfoContent'])->name('admin.coursesContent');
    Route::get('/admin/courses/content/add/{courseId}', [CourseController::class, 'courseInfoAddContent'])->name('admin.coursesAddContent');
    Route::get('/admin/courses/content/edit/{courseId}/{contentId}', [CourseController::class, 'courseEditContent'])->name('admin.coursesEditContent');
    Route::view('/admin/news', 'admin.news')->name('admin.news');
});

// Change locale route
Route::get('/locale/{lang}', [LocaleController::class, 'changeLocale'])->name('changeLocale');

// Routes with setLocale middleware
Route::middleware('setLocale')->group(function () {
    Route::view('/', 'landingPage')->name('landingPage');
    Route::view('/login', 'loginPage')->name('loginPage');
    Route::view('/privacy-policy', 'legal.privacy')->name('legal.privacy');
    Route::view('/terms-conditions', 'legal.terms')->name('legal.terms');
    Route::get('/courses', [CourseController::class, 'courseIndex'])->middleware(['auth', 'verify'])->name('courses');
    Route::get('/courses/{courseId}/{contentId}', [CourseController::class, 'courseInfo'])->middleware(['auth', 'verify'])->name('courseID');
    Route::view('/user', 'user')->middleware(['auth', 'verify'])->name('user');
    Route::post('/join', [CourseController::class, 'joinCourse'])->middleware(['auth', 'verify'])->name('joinCourse');
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/courses');
    })->middleware(['auth', 'signed'])->name('verification.verify');
});
