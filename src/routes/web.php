<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RestController;
use App\Http\Controllers\AttendanceController;

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

// Route::get('/verify', [JobController::class, 'verify']);
Route::middleware('verified')->group(function () {
    Route::get('/', [JobController::class, 'index']);
    Route::post('/start', [JobController::class, 'start']);
    Route::post('/end', [JobController::class, 'end']);
    Route::post('/rest/start', [RestController::class, 'start']);
    Route::post('/rest/end', [RestController::class, 'end']);
    Route::get('/attendance',[AttendanceController::class, 'attendance']);
    Route::get('/attendance/yesterday',[AttendanceController::class, 'yesterday']);
    Route::get('/attendance/tomorrow',[AttendanceController::class, 'tomorrow']);
    Route::get('/attendance/user_list',[AttendanceController::class,'user_list']);
    Route::get('/attendance/user',[AttendanceController::class,'user']);
    Route::get('/attendance/user/last_month',[AttendanceController::class,'last_month']);
    Route::get('/attendance/user/next_month',[AttendanceController::class,'next_month']);

});
