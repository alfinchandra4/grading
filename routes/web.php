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
use App\Http\Controllers\AcademicsController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\GuestController;
use App\Models\Alumni;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('auth.login');
Route::post('/login', [AuthController::class, 'attempt']);
Route::get('/logout/{guard}', [AuthController::class, 'logout']);

Route::group(['middleware' => 'auth:student,lecturer,alumni,administrator,dean'], function () {

    Route::get('/dashboard', [AcademicsController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'actor'], function () {
        Route::get('{role}', [AcademicsController::class, 'actortype'])->name('actortype');
        Route::get('{role}/summary', [AcademicsController::class, 'summary'])->name('visual.summary');
        Route::get('{role}/line',    [AcademicsController::class, 'line'])->name('visual.line');
        Route::get('{role}/bar',     [AcademicsController::class, 'bar'])->name('visual.bar');
        Route::get('{role}/detail',  [AcademicsController::class, 'detail'])->name('visual.detail');
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

    Route::group(['prefix' => 'complain'], function () {
        Route::get('/', [AcademicsController::class, 'complain'])->name('complain');
        Route::post('/', [AcademicsController::class, 'complain_store'])->name('complain.store');
        Route::get('/list/{role}', [AcademicsController::class, 'complain_list'])->name('complain.list');
        Route::get('/{complain_id}', [AcademicsController::class, 'complain_detail'])->name('complain.detail');
        Route::get('/{complain_id}/remove', [AcademicsController::class, 'complain_remove'])->name('complain.remove');
        Route::get('/{complain_id}/received', [AcademicsController::class, 'complain_received'])->name('complain.received'); 
    });

    Route::get('/checkforms', [StudentController::class, 'checkforms']);
    Route::get('/clearforms', [StudentController::class, 'clearforms']);

});

Route::group(['prefix' => 'guest'], function () {

    Route::get('/dashboard', [GuestController::class, 'index'])->name('guest.dashboard');

    Route::group(['prefix' => 'actor'], function () {
        Route::get('{role}', [GuestController::class, 'actortype'])->name('guest.actortype');
        Route::get('{role}/summary', [GuestController::class, 'summary'])->name('guest.visual.summary');
        Route::get('{role}/line',    [GuestController::class, 'line'])->name('guest.visual.line');
        Route::get('{role}/bar',     [GuestController::class, 'bar'])->name('guest.visual.bar');
        Route::get('{role}/detail',  [GuestController::class, 'detail'])->name('guest.visual.detail');
    });
});

Route::get('/student-export', [ExcelController::class, 'student_export'])->name('student_export');
Route::get('/alumni-export',  [ExcelController::class, 'alumni_export'])->name('alumni_export');
Route::get('/lecturer-export', [ExcelController::class, 'lecturer_export'])->name('lecturer_export');

route::get('student', function() {
    return view('example.student');
});

Route::get('alumni', function () {
    return view('example.alumni');
});

Route::get('lecturer', function () {
    return view('example.lecturer');
});

Route::get('administrator', function () {
    return view('example.administrator');
});

Route::get('dean', function () {
    return view('example.dean');
});
