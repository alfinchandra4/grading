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
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StatsController;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('auth.login');
Route::post('/login', [AuthController::class, 'attempt']);
Route::get('/logout/{guard}', [AuthController::class, 'logout']);

Route::group(['prefix' => 'student', 'middleware' => 'auth:student'], function () {

    Route::get('/', [StudentController::class, 'index'])->name('student.index');

    Route::group(['prefix' => 'actor'], function () {
        Route::get('{role}', [StudentController::class, 'actortype'])->name('student.actortype');
        Route::get('{role}/summary', [StudentController::class, 'summary'])->name('student.actor.visual.summary');
        Route::get('{role}/line',    [StudentController::class, 'line'])->name('student.actor.visual.line');
        Route::get('{role}/bar',     [StudentController::class, 'bar'])->name('student.actor.visual.bar');
        Route::get('{role}/detail',  [StudentController::class, 'detail'])->name('student.actor.visual.detail');
    });

    Route::get('/forms/{category_id}', [StudentController::class, 'forms'])->name('student.forms');
    Route::post('/forms', [StudentController::class, 'formstore'])->name('student.form.store');
    Route::get('/checkforms', [StudentController::class, 'checkforms']);
    Route::get('/clearforms', [StudentController::class, 'clearforms']);

});
