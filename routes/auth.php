<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;

use Illuminate\Support\Facades\Route;

/*------------------
| admin 
|------------------- 
*/
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');



/*------------------
| student 
|------------------- 
*/
Route::get('student/login', [AuthenticatedSessionController::class, 'studentCreate'])
    ->middleware('guest:student')
    ->name('student.login');

Route::post('student/login', [AuthenticatedSessionController::class, 'studentStore'])
    ->middleware('guest:student');

Route::post('student/logout', [AuthenticatedSessionController::class, 'destroyStudent'])
    ->middleware('auth:student')
    ->name('student.logout');
