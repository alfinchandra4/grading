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

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AcademicsCotroller;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\LecturerController;
use App\Models\Alumni;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('auth.login');
Route::post('/login', [AuthController::class, 'attempt']);
Route::get('/logout/{guard}', [AuthController::class, 'logout']);

Route::group(['middleware' => 'auth:student,lecturer,alumni'], function () {

    Route::get('/dashboard', [AcademicsCotroller::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'actor'], function () {
        Route::get('{role}', [AcademicsCotroller::class, 'actortype'])->name('actortype');
        Route::get('{role}/summary', [AcademicsCotroller::class, 'summary'])->name('visual.summary');
        Route::get('{role}/line',    [AcademicsCotroller::class, 'line'])->name('visual.line');
        Route::get('{role}/bar',     [AcademicsCotroller::class, 'bar'])->name('visual.bar');
        Route::get('{role}/detail',  [AcademicsCotroller::class, 'detail'])->name('visual.detail');
    });

    Route::group(['prefix' => 'student'], function () {
        Route::get('/forms/{category_id}', [StudentController::class, 'forms'])->name('student.forms');
        Route::post('/forms', [StudentController::class, 'formstore'])->name('student.form.store');        

        Route::get('/profile', [StudentController::class, 'profile'])->name('student.profile');
        Route::put('/profile', [StudentController::class, 'profilestore'])->name('student.profile.store');
    });

    Route::group(['prefix' => 'lecturer'], function () {
        Route::get('/forms/{category_id}', [LecturerController::class, 'forms'])->name('lecturer.forms');
        Route::post('/forms', [LecturerController::class, 'formstore'])->name('lecturer.form.store');        

        Route::get('/profile', [LecturerController::class, 'profile'])->name('lecturer.profile');
        Route::put('/profile', [LecturerController::class, 'profilestore'])->name('lecturer.profile.store');
    });

    Route::group(['prefix' => 'alumni'], function () {
        Route::get('/forms/{category_id}', [AlumniController::class, 'forms'])->name('alumni.forms');
        Route::post('/forms', [AlumniController::class, 'formstore'])->name('alumni.form.store');        

        Route::get('/profile', [AlumniController::class, 'profile'])->name('alumni.profile');
        Route::put('/profile', [AlumniController::class, 'profilestore'])->name('alumni.profile.store');
    });

    Route::get('/complain', [AcademicsCotroller::class, 'complain'])->name('complain');

    Route::get('/checkforms', [StudentController::class, 'checkforms']);
    Route::get('/clearforms', [StudentController::class, 'clearforms']);

});

route::get('mhs', function() {
    return view('example.student');
});

Route::get('alumni', function () {
    return view('example.alumni');
});

Route::get('dosen', function () {
    return view('example.lecturer');
});
