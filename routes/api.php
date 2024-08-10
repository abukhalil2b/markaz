<?php

use App\Http\Controllers\api\ApiStudentAttendanceController;
use App\Http\Controllers\api\MissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});
//api for admin mission task

Route::post('admin/mission/task/store', [MissionController::class, 'store'])
// ->middleware('auth:sanctum')
	->name('api.admin.mission.task.store');

Route::middleware('auth:sanctum')->post('admin/mission/task/delete', [MissionController::class, 'delete'])
	->name('api.admin.mission.task.delete');

Route::middleware('auth:sanctum')->post('admin/student/mission_task_store', [MissionController::class, 'studentMissionTaskStore'])
	->name('api.admin.student.mission_task_store');

Route::post('admin/student/student_has_record_daily/update', [ApiStudentAttendanceController::class, 'update'])
	->middleware('auth:sanctum')
	->name('api.admin.student.student_has_record_daily.update');