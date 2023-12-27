<?php


use App\Http\Controllers\CourseController;
use App\Http\Controllers\LocaleController;
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

// User system /register and /login (POST) /logout (GET)
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/admin/register', [UserController::class, 'adminRegister'])->middleware('auth')->middleware('verify')->middleware('admin')->name('admin.register');
Route::get('/admin/search', [UserController::class, 'adminSearch'])->middleware('auth')->middleware('verify')->middleware('admin')->name('admin.search');
Route::post('/admin/courses/create', [CourseController::class, 'store'])->middleware('auth')->middleware('verify')->middleware('admin')->name('admin.createCourse');
Route::get('admin/course/search', [CourseController::class, 'search'])->middleware('auth')->middleware('verify')->middleware('admin')->name('admin.searchCourse');
Route::post('admin/courses/edit/{id}', [CourseController::class, 'updateCourseTitle'])->middleware('auth')->middleware('verify')->middleware('admin')->name('admin.editCourse');
Route::post('admin/courses/content/add/{id}', [CourseController::class, 'storeContent'])->middleware('auth')->middleware('verify')->middleware('admin')->name('admin.addContent');
Route::post('admin/courses/content/edit/{id}/{contentId}', [CourseController::class, 'updateContent'])->middleware('auth')->middleware('verify')->middleware('admin')->name('admin.editContent');
Route::view('/admin/logs/404', 'admin.logs.404')->middleware('auth')->middleware('verify')->middleware('admin')->name('admin.logs.404');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/loginTest', [UserController::class, 'loginTest'])->name('loginTest');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Define the route for changing the locale
Route::get('/locale/{lang}', [LocaleController::class, 'changeLocale'])->name('changeLocale');

Route::group(['middleware' => 'setLocale'], function () {
    Route::view('/', 'landingPage')->name('landingPage');
    Route::view('/login', 'loginPage')->name('loginPage');
    Route::view('/privacy-policy', 'legal.privacy')->name('legal.privacy');
    Route::view('/terms-conditions', 'legal.terms')->name('legal.terms');
    Route::get('/courses', [CourseController::class, 'courseIndex'])->middleware('auth')->middleware('verify')->name('courses');
    Route::get('/courses/{courseId}/{contentId}', [CourseController::class, 'courseInfo'])->middleware('auth')->middleware('verify')->name('courseID'); // The view is in Course controller
    Route::view('/admin', 'admin')->middleware('auth')->middleware('verify')->middleware('admin')->name('admin');
    Route::view('/admin/users', 'admin.users')->middleware('auth')->middleware('verify')->middleware('admin')->name('admin.users');
    Route::view('/admin/courses', 'admin.courses')->middleware('auth')->middleware('verify')->middleware('admin')->name('admin.courses');
    Route::get('/admin/courses/edit/{courseId}', [CourseController::class, 'courseEditInfo'])->middleware('auth')->middleware('verify')->middleware('admin')->name('admin.coursesEdit');  // This view is in Course controller
    Route::get('/admin/courses/content/{courseId}', [CourseController::class, 'courseInfoContent'])->middleware('auth')->middleware('verify')->middleware('admin')->name('admin.coursesContent');
    Route::get('/admin/courses/content/add/{courseId}', [CourseController::class, 'courseInfoAddContent'])->middleware('auth')->middleware('verify')->middleware('admin')->name('admin.coursesAddContent');
    Route::get('/admin/courses/content/edit/{courseId}/{contentId}', [CourseController::class, 'courseEditContent'])->middleware('auth')->middleware('verify')->middleware('admin')->name('admin.coursesEditContent');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/courses');
    })->middleware(['auth', 'signed'])->name('verification.verify');
});
