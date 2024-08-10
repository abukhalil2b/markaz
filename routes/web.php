<?php

use App\Http\Controllers\TempController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminDuaacateController;
use App\Http\Controllers\Admin\AdminDuaacateStudentController;
use App\Http\Controllers\Admin\AdminDuaacateStudentTaskController;
use App\Http\Controllers\Admin\AdminDuaacateTaskController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminStudentHasRecordDailyController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserRecorddailyController;
use App\Http\Controllers\Admin\AdminRecorddailyController;
use App\Http\Controllers\Admin\AdminStudentHasMissionController;

use App\Http\Controllers\AmountToPayController;
use App\Http\Controllers\DailyEvaluationController;
use App\Http\Controllers\FrontpageController;
use App\Http\Controllers\HesasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LastStudentMissionTaskController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\MissionHesasController;
use App\Http\Controllers\MissionTaskController;
use App\Http\Controllers\MonthlysubscribeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\RequestleaveController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StorednoteController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentHasDuaaController;
use App\Http\Controllers\StudentMissionController;
use App\Http\Controllers\StudentMissionTaskController;
use App\Http\Controllers\StudentUnderObservationController;
use App\Http\Controllers\SubscriptionfeeController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRecorddailyController;
use App\Http\Controllers\WarnController;
use App\Http\Controllers\WarningController;
use App\Http\Controllers\WorkperiodController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\MarkController as studentMarkController;
use App\Http\Controllers\Student\MonthlysubscribeController as studentMonthlysubscribeController;
use App\Http\Controllers\Student\NoteController as studentNoteController;
use App\Http\Controllers\Student\studentStudentMissionTaskController as studentStudentMissionTaskController;
use App\Http\Controllers\Student\studentDuaacateStudentTaskController as studentDuaacateStudentTaskController;
use App\Http\Controllers\Student\WarningController as studentWarningController;
use App\Http\Controllers\Student\StudentDashboardStudentController;
/*-------------------------------------------------------------------------
| HomeController
|--------------------------------------------------------------------------*/

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

Route::get('login_to_user_account/{user}', [HomeController::class, 'loginToUserAccount'])->name('logintouseraccount');

/*-------------------------------------------------------------------------
| UserController
|--------------------------------------------------------------------------*/
/* delete user */
Route::get('admin/user/delete/{user}', [UserController::class, 'delete'])->name('admin.user.delete');

Route::get('admin/user/show/{user}', [UserController::class, 'show'])
	->middleware(['userPermission:admin.user.show'])
	->name('admin.user.show');

Route::get('admin/profile', [UserController::class, 'adminProfile'])
	->name('admin.profile');

/* impersonate */
Route::get('enable_impersonate/{user}', [UserController::class, 'enableImpersonate'])
	->name('enable_impersonate');

Route::get('disable_impersonate', [UserController::class, 'disableImpersonate'])
	->name('disable_impersonate');

/*-------------------------------------------------------------------------
| RequestleaveController
|--------------------------------------------------------------------------*/
/* requestleave */
Route::get('requestleave/user_create_leave', [RequestleaveController::class, 'userCreateLeave'])
	->middleware('userPermission:requestleave')
	->name('requestleave.user_create_leave');

Route::get('admin/requestleave/index', [RequestleaveController::class, 'index'])
	->middleware('userPermission:view-requestleave')
	->name('admin.requestleave.index');

Route::get('admin/requestleave/update_status/{requestleave}/{status}', [RequestleaveController::class, 'updateStatus'])
	->name('admin.requestleave.update_status');

Route::post('requestleave/store', [RequestleaveController::class, 'store'])
	->name('requestleave.store');

Route::get('requestleave/destroy/{requestleave}', [RequestleaveController::class, 'destroy'])
	->name('requestleave.destroy');


/*-------------------------------------------------------------------------
| SemesterController
|--------------------------------------------------------------------------*/
/* semester */
Route::get('admin/semester/index', [SemesterController::class, 'index'])
	->middleware('userPermission:admin.semester.index')
	->name('admin.semester.index');

Route::post('admin/semester/store', [SemesterController::class, 'store'])
	->middleware('userPermission:admin.semester.store')
	->name('admin.semester.store');

Route::post('admin/semester/update/{semester}', [SemesterController::class, 'update'])
	->middleware('userPermission:admin.semester.update')
	->name('admin.semester.update');

Route::post('admin/semester/delete/{semester}', [SemesterController::class, 'delete'])
	->middleware('userPermission:admin.semester.delete')
	->name('admin.semester.delete');

Route::get('admin/semester/student/subscriptionfee/index/{semester}', [SemesterController::class, 'studentSubscriptionfeeIndex'])
	->middleware('userPermission:admin.subscriptionfee.index')
	->name('admin.semester.student.subscriptionfee.index');

Route::get('admin/student_amount_to_pay_edit/{student_amount_to_pay_id}', [SemesterController::class, 'studentAmountToPayEdit'])
	->middleware('userPermission:admin.student_amount_to_pay_update')
	->name('admin.student_amount_to_pay_edit');

Route::post('admin/student_amount_to_pay_update', [SemesterController::class, 'studentAmountToPayUpdate'])
	->middleware('userPermission:admin.student_amount_to_pay_update')
	->name('admin.student_amount_to_pay_update');

Route::post('admin/student_amount_to_pay_delete', [SemesterController::class, 'studentAmountToPayDelete'])
	->middleware('userPermission:admin.student_amount_to_pay_delete')
	->name('admin.student_amount_to_pay_delete');
/*-------------------------------------------------------------------------
| AmountToPayController
|--------------------------------------------------------------------------*/
/*--- amount_to_pay ---*/
Route::get('admin/semester/student/amount_to_pay/create', [AmountToPayController::class, 'create'])
	->name('admin.semester.student.amount_to_pay.create');

Route::post('admin/semester/student/amount_to_pay/store', [AmountToPayController::class, 'store'])
	->name('admin.semester.student.amount_to_pay.store');

Route::post('admin/semester/student/amount_to_pay/search/{semester}', [AmountToPayController::class, 'search'])
	->name('admin.semester.student.amount_to_pay.search');
/*-------------------------------------------------------------------------
| SubscriptionfeeController
|--------------------------------------------------------------------------*/
/* subscriptionfees */
Route::get('admin/subscriptionfee/index/{semester}/{student}', [SubscriptionfeeController::class, 'index'])
	->middleware('userPermission:admin.subscriptionfee.index')
	->name('admin.subscriptionfee.index');

Route::post('admin/subscriptionfee/store', [SubscriptionfeeController::class, 'store'])
	->middleware('userPermission:admin.subscriptionfee.store')
	->name('admin.subscriptionfee.store');

Route::post('admin/subscriptionfee/update/{subscriptionfee}', [SubscriptionfeeController::class, 'update'])
	->middleware('userPermission:admin.subscriptionfee.update')
	->name('admin.subscriptionfee.update');

Route::post('admin/subscriptionfee/delete/{subscriptionfee}', [SubscriptionfeeController::class, 'delete'])
	->middleware('userPermission:admin.subscriptionfee.delete')
	->name('admin.subscriptionfee.delete');

/*-------------------------------------------------------------------------
| MonthlysubscribeController
|--------------------------------------------------------------------------*/
/* monthlysubscribe */
Route::get('monthlysubscribe/student/{student}/details', [MonthlysubscribeController::class, 'monthlysubscribeStudentDetails'])
	->name('monthlysubscribe.student.details');


Route::post('monthlysubscribe/student/search/{recordmonthly}', [MonthlysubscribeController::class, 'monthlysubscribeStudentSearch'])
	->name('monthlysubscribe.student.search');

Route::post('monthlysubscribe/student/subscribe/{recordmonthly}', [MonthlysubscribeController::class, 'studentSubscribe'])
	->middleware('impersonate', 'userPermission:manage-monthlysubscribe')
	->name('monthlysubscribe.student.subscribe');

Route::get('monthlysubscribe/edit/{monthlysubscribeStudent}', [MonthlysubscribeController::class, 'monthlysubscribeEdit'])
	->middleware('impersonate', 'userPermission:manage-monthlysubscribe')
	->name('monthlysubscribe.edit');

Route::post('monthlysubscribe/{monthlysubscribeStudent}/update', [MonthlysubscribeController::class, 'monthlysubscribeUpdate'])
	->middleware('impersonate', 'userPermission:manage-monthlysubscribe')
	->name('monthlysubscribe.update');

Route::get('monthlysubscribe/{monthlysubscribeStudent}/delete', [MonthlysubscribeController::class, 'monthlysubscribeDelete'])
	->middleware('impersonate', 'userPermission:manage-monthlysubscribe')
	->name('monthlysubscribe.delete');

/*-------------------------------------------------------------------------
| AdminRecorddailyController
|--------------------------------------------------------------------------*/

Route::get('admin/recorddaily/index', [AdminRecorddailyController::class, 'index'])
	->name('admin.recorddaily.index');
/*-------------------------------------------------------------------------
| UserRecorddailyController
|--------------------------------------------------------------------------*/
/* user_record_daily */

Route::get('user_record_daily/create', [UserRecorddailyController::class, 'create'])
	->name('user_record_daily.create');

Route::post('user_record_daily/{userRecorddaily}/update', [UserRecorddailyController::class, 'update'])
	->name('user_record_daily.update');

Route::get('user_record_daily/moderator/index', [UserRecorddailyController::class, 'moderatorIndex'])
	->name('user_record_daily.moderator.index');

Route::get('user_record_daily/teacher/index', [UserRecorddailyController::class, 'teacherIndex'])
	->name('user_record_daily.teacher.index');

Route::get('user_record_daily/details/{user}', [UserRecorddailyController::class, 'details'])
	->name('user_record_daily.details');

Route::post('user_record_daily/update_moderator_seen', [UserRecorddailyController::class, 'updateModeratorSeen'])
	->name('user_record_daily.update_moderator_seen');

Route::get('user_record_daily/moderator_note/edit/{userRecorddailyId}', [UserRecorddailyController::class, 'editModeratorNote'])
	->name('user_record_daily.moderator_note.edit');

Route::post('user_record_daily/moderator_note/update/{userRecorddaily}', [UserRecorddailyController::class, 'updateModeratorNote'])
	->name('user_record_daily.moderator_note.update');

/*-------------------------------------------------------------------------
| AdminUserRecorddailyController
|--------------------------------------------------------------------------*/
/* user_record_daily */

Route::get('admin/user_record_daily/create/{user}', [AdminUserRecorddailyController::class, 'create'])
	->name('admin.user_record_daily.create');

Route::post('admin/user_record_daily/{userRecorddaily}/update', [AdminUserRecorddailyController::class, 'update'])
	->name('admin.user_record_daily.update');

/*-------------------------------------------------------------------------
| LevelController
|--------------------------------------------------------------------------*/
/* Admin Level */
Route::get('level/index', [LevelController::class, 'index'])
	->middleware('userPermission:view-level')
	->name('level.index');
Route::post('level/store', [LevelController::class, 'store'])
	->middleware('userPermission:add-edit-level')
	->name('level.store');
Route::get('level/{id}/edit', [LevelController::class, 'edit'])
	->middleware('userPermission:add-edit-level')
	->name('level.edit');
Route::post('level/update', [LevelController::class, 'update'])
	->middleware('userPermission:add-edit-level')
	->name('level.update');
Route::get('level/student/{level}', [LevelController::class, 'levelStudent'])
	->middleware('userPermission:view-level')
	->name('level.student');

/* Shift students to other level*/
Route::get('shift_student_to_other_level_create/{level}', [LevelController::class, 'shiftStudentToOtherLevelCreate'])
	->middleware('userPermission:student-transfer')
	->name('shift_student_to_other_level_create');

Route::post('shift_student_to_other_level_store', [LevelController::class, 'shiftStudentToOtherLevelStore'])
	->middleware('userPermission:student-transfer')
	->name('shift_student_to_other_level_store');

/* Admin User */
Route::group(['middleware' => 'auth'], function () {
	Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
});

Route::get('admin/user/edit/{user}', [AdminController::class, 'userEdit'])
	->middleware(['userPermission:edit-admin-user'])
	->name('admin.user.edit');

Route::post('admin/user/update/{user}', [AdminController::class, 'userUpdate'])
	->name('admin.user.update');

Route::get('admin/user/edit_password/{user}', [AdminController::class, 'userEditPassword'])
	->name('admin.user.edit_password');

Route::post('admin/user/update_password/{user}', [AdminController::class, 'userUpdatePassword'])
	->name('admin.user.update_password');

/* Admin User teacher shiflevel */
Route::get('admin/teacher/{teacher_id}/shiftlevel/create', [AdminController::class, 'teacherShiftlevelCreate'])
	->middleware(['userPermission:edit-admin-user'])
	->name('admin.teacher.shiftlevel.create');

Route::post('admin/teacher/shiftlevel/update', [AdminController::class, 'teacherShiftlevelUpdate'])
	->middleware(['userPermission:edit-admin-user'])
	->name('admin.teacher.shiftlevel.update');

/*-------------------------------------------------------------------------
| UserController
|--------------------------------------------------------------------------*/
Route::group(['middleware' => 'auth'], function () {

	/* Admin User admin */
	Route::get('admin/user/admin/index', [UserController::class, 'userAdminIndex'])
		->middleware(['userPermission:view-admin-user-index'])
		->name('admin.user.admin.index');

	/* Admin User male_teacher */
	Route::get('admin/user/male_teacher/index', [UserController::class, 'userMaleTeacherIndex'])
		->middleware('impersonate', 'userPermission:view-male-teacher')
		->name('admin.user.male_teacher.index');

	/* Admin User female_teacher */
	Route::get('admin/user/female_teacher/index', [UserController::class, 'userFemaleTeacherIndex'])
		->middleware('impersonate', 'userPermission:view-female-teacher')
		->name('admin.user.female_teacher.index');

	/* Admin User male_moderator */
	Route::get('admin/user/male_moderator/index', [UserController::class, 'userMaleModeratorIndex'])
		->middleware('userPermission:view-male-moderator')
		->name('admin.user.male_moderator.index');

	/* Admin User female_moderator */
	Route::get('admin/user/female_moderator/index', [UserController::class, 'userFemaleModeratorIndex'])
		->middleware('userPermission:view-female-moderator')
		->name('admin.user.female_moderator.index');
	/* Admin User*/

	Route::get('admin/user/create', [UserController::class, 'userCreate'])
		->middleware(['userPermission:create-user'])
		->name('admin.user.create');

	Route::post('admin/user/store', [UserController::class, 'userStore'])
		->middleware(['userPermission:create-user'])
		->name('admin.user.store');
});

//student male CRUD
Route::get('admin/student/create', [AdminController::class, 'studentCreate'])
	->middleware('userPermission:crud-student')
	->name('admin.student.create');

Route::post('admin/student/store', [AdminController::class, 'studentStore'])
	->middleware('userPermission:crud-student')
	->name('admin.student.store');

//student female CRUD
Route::get('admin/student/female_edit/{student}', [AdminController::class, 'studentFemaleEdit'])
	->middleware(['genderPermission', 'userPermission:create-female-student'])
	->name('admin.student.female_edit');

Route::post('admin/student/female_update/{student}', [AdminController::class, 'studentFemaleUpdate'])
	->middleware('userPermission:create-female-student')
	->name('admin.student.female_update');

//level trans
Route::get('admin/student/trans/create/{student}', [AdminController::class, 'studentTransCreate'])
	->middleware(['genderPermission', 'userPermission:student-transfer'])
	->name('admin.student.trans.create');

Route::get('admin/student/trans/update/{student}/{workperiodId}/{levelId}', [AdminController::class, 'studentTransUpdate'])
	->middleware(['userPermission:student-transfer'])
	->name('admin.student.trans.update');

/* Admin Inactive Student */
Route::get('admin/student/inactive_student_index', [AdminController::class, 'inactiveStudentIndex'])
	->middleware('userPermission:manage-inactive-students')
	->name('admin.student.inactive_student_index');

/* Admin waiting approval Student */
Route::get('admin/student/waiting_approval_student_index', [AdminController::class, 'waitingApprovalStudentIndex'])
	->middleware('userPermission:manage-waiting_approval-students')
	->name('admin.student.waiting_approval_student_index');

Route::post('admin/student/approve', [AdminController::class, 'approvalStudent'])
	->middleware('userPermission:manage-waiting_approval-students')
	->name('admin.student.approve');

Route::get('admin/student/waiting_approval_student_show_delete_form', [AdminController::class, 'waitingApprovalStudentShowDeleteForm'])
	->middleware('userPermission:manage-waiting_approval-students')
	->name('admin.student.waiting_approval_student_show_delete_form');

Route::post('admin/student/waiting_approval_student_delete', [AdminController::class, 'waitingApprovalStudentDelete'])
	->middleware('userPermission:manage-waiting_approval-students')
	->name('admin.student.waiting_approval_student_delete');

/* Record  */
Route::get('days_of_student_absent/{student}', [AdminController::class, 'daysOfStudentAbsent'])
	->name('days_of_student_absent');

Route::get('admin/record/month/{month}/absent', [AdminController::class, 'recordMonthAbsent'])
	->name('admin.record.month.absent');

Route::post('register_student_as_persent/{recorddaily}', [AdminController::class, 'registerStudentAsPersent'])
	->name('register_student_as_persent');

Route::post('register_student_as_absent/{recorddaily}', [AdminController::class, 'registerStudentAsAbsent'])
	->name('register_student_as_absent');

/*-------------------------------------------------------------------------
| WorkperiodController
|--------------------------------------------------------------------------*/
/* work period*/
Route::get('workperiod/index', [WorkperiodController::class, 'index'])
	->middleware('userPermission:create_and_edit_workperiod')
	->name('workperiod.index');

Route::post('workperiod/store', [WorkperiodController::class, 'store'])
	->middleware('userPermission:create_and_edit_workperiod')
	->name('workperiod.store');

Route::get('workperiod/edit/{workperiod}', [WorkperiodController::class, 'edit'])
	->middleware('userPermission:create_and_edit_workperiod')
	->name('workperiod.edit');

Route::post('workperiod/update/{workperiod}', [WorkperiodController::class, 'update'])
	->middleware('userPermission:create_and_edit_workperiod')
	->name('workperiod.update');

Route::get('workperiod/destroy/{workperiod}', [WorkperiodController::class, 'destroy'])
	->middleware('userPermission:create_and_edit_workperiod')
	->name('workperiod.destroy');

Route::get('workperiod/level_index/{workperiod}', [WorkperiodController::class, 'workperiodLevelIndex'])
	->middleware('userPermission:create_and_edit_workperiod')
	->name('workperiod.level_index');

Route::post('workperiod/level_update/{workperiod}', [WorkperiodController::class, 'workperiodLevelUpdate'])
	->middleware('userPermission:create_and_edit_workperiod')
	->name('workperiod.level_update');

Route::get('workperiod/user_index/{workperiod}', [WorkperiodController::class, 'workperiodUserIndex'])
	->middleware('userPermission:create_and_edit_workperiod')
	->name('workperiod.user_index');

Route::post('workperiod/user_update/{workperiod}', [WorkperiodController::class, 'workperiodUserUpdate'])
	->middleware('userPermission:create_and_edit_workperiod')
	->name('workperiod.user_update');

Route::get('change_workperiod/{workperiod}', [WorkperiodController::class, 'changeWorkperiod'])
	->middleware('userPermission:change_workperiod')
	->name('change_workperiod');

Route::post('user_has_workperiod_permission/{user}/update', [WorkperiodController::class, 'userHasWorkperiodPermissionUpdate'])
	->middleware('userPermission:edit-user-workperiod-permission')
	->name('user_has_workperiod_permission.update');

/*-------------------------------------------------------------------------
| MarkController
|--------------------------------------------------------------------------*/


//order mark by tag
Route::get('mark/mark_orderby_tag', [MarkController::class, 'markOrderbyTag'])
	->name('mark.mark_orderby_tag');

Route::match(['get', 'post'], 'mark/mark_orderby_tag_details/{tag}', [MarkController::class, 'markOrderbyTagDetails'])
	->name('mark.mark_orderby_tag_details');

//mark delete
Route::get('mark/{mark}/delete', [MarkController::class, 'delete'])
	->middleware('impersonate', 'userPermission:student-manage-mark')
	->name('student.mark.delete');

/*-------------------------------------------------------------------------
| LastStudentMissionTaskController
|--------------------------------------------------------------------------*/
Route::get('admin/last_student_mission_task/choose_level', [LastStudentMissionTaskController::class, 'chooseLevel'])
	->name('admin.last_student_mission_task.choose_level');

Route::get('admin/last_student_mission_task/index/{level}', [LastStudentMissionTaskController::class, 'index'])
	->name('admin.last_student_mission_task.index');

/*-------------------------------------------------------------------------
| StudentController
|--------------------------------------------------------------------------*/
Route::get('admin/student/mark/index/{student}', [StudentController::class, 'studentMarkIndex'])
	->name('admin.student.mark.index');

Route::get('admin/student/mark/create/{student}', [StudentController::class, 'studentMarkCreate'])
	->name('admin.student.mark.create');

Route::post('student/mark/store', [StudentController::class, 'studentMarkStore'])
	->name('student.mark.store');

Route::get('student/mark/create/{student}/{tag}/{point}', [StudentController::class, 'studentMarkAddPointByTag'])
	->middleware(['impersonate', 'genderPermission'])
	->name('student.mark.addpointbytag');
/*  end of Student Mark */

/*      all students    */
Route::get('student/show_all_students', [StudentController::class, 'showAllStudents'])
	->middleware('userPermission:show-all-students')
	->name('student.show_all_students');

Route::post('student/show_all_students', [StudentController::class, 'searchAllStudents'])
	->middleware('userPermission:search-all-students')
	->name('student.search_all_students');

Route::match(['get', 'post'], 'admin/student/index', [StudentController::class, 'index'])
	->name('admin.student.index');

Route::get('admin/student/edit/{student}', [StudentController::class, 'studentEdit'])
	->middleware(['genderPermission', 'userPermission:crud-student'])
	->name('admin.student.edit');

Route::post('admin/student/update/{student}', [StudentController::class, 'studentUpdate'])
	->middleware('userPermission:crud-student')
	->name('admin.student.update');

/*-------------------------------------------------------------------------
| PermissionController
|--------------------------------------------------------------------------*/
/* Role Permission */
Route::get('role/index', [PermissionController::class, 'roleIndex'])
	->middleware(['userPermission:update-permission'])
	->name('role.index');

Route::get('role/permission/index/{id}', [PermissionController::class, 'rolePermissionIndex'])
	->middleware(['userPermission:update-permission'])
	->name('role.permission.index');

Route::post('role/permission/store', [PermissionController::class, 'rolePermissionStore'])
	->middleware(['userPermission:update-permission'])
	->name('role.permission.store');

/*-------------------------------------------------------------------------
| RecordController
|--------------------------------------------------------------------------*/
Route::get('remove_student_from_recorddaily/{studentHasRecordDaily}', [RecordController::class, 'removeStudentFromRecorddaily'])
	->middleware(['userPermission:record-manage'])
	->name('remove_student_from_recorddaily');

Route::get('admin/record/daily/{recorddaily}/tobedelete', [RecordController::class, 'recordDailyTobeDelete'])
	->middleware(['userPermission:record-manage'])
	->name('admin.record.daily.tobedelete');

Route::get('admin/record/daily/{recorddaily}/delete', [RecordController::class, 'recordDailyDelete'])
	->middleware(['userPermission:record-manage'])
	->name('admin.record.daily.delete');

Route::get('admin/record/daily/create/{workperiod}', [RecordController::class, 'recordDailyCreate'])
	->middleware(['userPermission:record-manage'])
	->name('admin.record.daily.create');

Route::get('admin/record/daily/index/{year?}', [RecordController::class, 'recordDailyIndex'])
	->middleware(['userPermission:admin.record.daily.index'])
	->name('admin.record.daily.index');

Route::post('admin/record/daily/delete_all', [RecordController::class, 'recordDailyDeleteAll'])
	->middleware(['userPermission:admin.record.daily.index'])
	->name('admin.record.daily.delete_all');

Route::post('admin/record/daily/store/{workperiod}', [RecordController::class, 'recordDailyStore'])
	->middleware(['userPermission:record-manage'])
	->name('admin.record.daily.store');

Route::get('record/day/index/{recorddaily}', [RecordController::class, 'recordDayIndex'])
	->name('record.day.index');

Route::get('record/day/{id}/edit', [RecordController::class, 'recordDayEdit'])
	->name('record.day.edit');
Route::post('record/day/update', [RecordController::class, 'recordDayUpdate'])
	->name('record.day.update');

//search for student late

Route::match(['get', 'post'], 'record/daily/late_search', [RecordController::class, 'lateSearch'])
	->name('admin.record.daily.late_search');

//search for student absent

Route::match(['get', 'post'], 'record/daily/absent_search', [RecordController::class, 'absentSearch'])
	->name('admin.record.daily.absent_search');

/*-------------------------------------------------------------------------
| NoteController
|--------------------------------------------------------------------------*/
Route::get('admin/note/delete/{note}', [NoteController::class, 'delete'])
	->name('admin.note.delete');

Route::get('admin/note/index', [NoteController::class, 'index'])
	->name('admin.note.index');

Route::get('admin/note/show/{note}', [NoteController::class, 'show'])
	->name('admin.note.show');

Route::get('admin/note/edit/{note}', [NoteController::class, 'edit'])
	->name('admin.note.edit');

Route::post('admin/note/update/{note}', [NoteController::class, 'update'])
	->name('admin.note.update');

/*-------------------------------------------------------------------------
| StudentController
|--------------------------------------------------------------------------*/
Route::get('admin/student/note/index/{student}', [StudentController::class, 'studentNoteIndex'])
	->name('admin.student.note.index');

Route::get('admin/student/note/create/{student}', [StudentController::class, 'studentNoteCreate'])
	->name('admin.student.note.create');

Route::post('admin/student/note/store/{student}', [StudentController::class, 'studentNoteStore'])
	->name('admin.student.note.store');

Route::get('admin/student/note/delete/{note}', [StudentController::class, 'studentNoteDelete'])
	->name('admin.student.note.delete');

Route::get('admin/student/note/edit/{note}', [StudentController::class, 'studentNoteEdit'])
	->name('admin.student.note.edit');

Route::post('admin/student/note/update/{note}', [StudentController::class, 'studentNoteUpdate'])
	->name('admin.student.note.update');

Route::post('student/week_days/update/{student}', [StudentController::class, 'weekDaysUpdate'])
	->name('student.week_days.update');

//student attendance
Route::get('student/attendance/student_index/{recorddaily}', [StudentController::class, 'attendanceStudentIndex'])
	->name('student.attendance.student_index');

/*-------------------------------------------------------------------------
| AdminStudentController
|--------------------------------------------------------------------------*/
Route::get('admin/student/studyday/index/{student}', [AdminStudentController::class, 'studyDayIndex'])
	->name('admin.student.studyday.index');

/*-------------------------------------------------------------------------
| MissionHesasController
|--------------------------------------------------------------------------*/
/*---- mission_hesas  --*/
Route::get('admin/student/mission_hesas/history/{student}', [MissionHesasController::class, 'studentMissionHesasHistory'])
	->name('admin.student.mission_hesas.history');

Route::get('admin/student/mission_hesas/index/{student}', [MissionHesasController::class, 'studentMissionHesasIndex'])
	->name('admin.student.mission_hesas.index');

Route::get('admin/student/mission_hesas/index_test/{student}', [MissionHesasController::class, 'studentMissionHesasIndexTest'])
	->name('admin.student.mission_hesas.index_test');

Route::get('admin/student/mission_hesas/create/{student}/{mission}', [MissionHesasController::class, 'studentMissionHesasCreate'])
	->middleware(['userPermission:manage-mission'])
	->name('admin.student.mission_hesas.create');

Route::post('admin/student/mission_hesas/store', [MissionHesasController::class, 'studentMissionHesasStore'])
	->middleware(['userPermission:manage-mission'])
	->name('admin.student.mission_hesas.store');

Route::get('admin/student/mission_hesas/delete/{studentHasMission}', [MissionHesasController::class, 'delete'])
	->name('admin.student.mission_hesas.delete');

Route::get('admin/student/mission_hesas/edit/{studentHasMission}', [MissionHesasController::class, 'edit'])
	->name('admin.student.mission_hesas.edit');

Route::post('admin/student/mission_hesas/update/{studentHasMission}', [MissionHesasController::class, 'update'])
	->name('admin.student.mission_hesas.update');


/*-------------------------------------------------------------------------
| DailyEvaluationController
|--------------------------------------------------------------------------*/
/*daily_evaluations*/
Route::get('admin/student/daily_evaluations/add_student/{studentHasMission}/{student_id}', [DailyEvaluationController::class, 'addStudent'])
	->name('admin.student.daily_evaluations.add_student');


Route::get('admin/student/daily_evaluations/dashboard', [DailyEvaluationController::class, 'dashboard'])
	->name('admin.student.daily_evaluations.dashboard');

Route::get('admin/student/daily_evaluations/index', [DailyEvaluationController::class, 'index'])
	->name('admin.student.daily_evaluations.index');

Route::get('admin/student/daily_evaluations/truncate', [DailyEvaluationController::class, 'truncate'])
	->name('admin.student.daily_evaluations.truncate');

Route::get('admin/student/daily_evaluations/hesas_show/{daily_evaluation_id}', [DailyEvaluationController::class, 'hesas_show'])
	->name('admin.student.daily_evaluations.hesas_show');

Route::get('admin/student/daily_evaluations/hesas_remove/{daily_evaluation_id}', [DailyEvaluationController::class, 'hesas_remove'])
	->name('admin.student.daily_evaluations.hesas_remove');

/*-------------------------------------------------------------------------
| WarningController
|--------------------------------------------------------------------------*/
Route::get('admin/warning/student_index', [WarningController::class, 'studentIndex'])
	->name('admin.warning.student_index');

Route::get('admin/student/warning/index/{student}', [WarningController::class, 'index'])
	->name('admin.student.warning.index');

Route::get('admin/student/warning/create/{student}/{level}', [WarningController::class, 'create'])
	->middleware(['warningpermission'])
	->name('admin.student.warning.create');

Route::post('admin/student/warning/store', [WarningController::class, 'store'])
	->middleware(['impersonate'])
	->name('admin.student.warning.store');

Route::get('admin/student/warning/delete/{warning}', [WarningController::class, 'delete'])
	->middleware(['impersonate'])
	->name('admin.student.warning.delete');

Route::get('admin/student/dashboard/{student}', [StudentController::class, 'dashboard'])
	->name('admin.student.dashboard');


Route::get('admin/student/show/{student}', [StudentController::class, 'show'])
	->name('admin.student.show');
/*-------------------------------------------------------------------------
| StudentUnderObservationController
|--------------------------------------------------------------------------*/
Route::get('admin/student/set_under_observation/{student}', [StudentUnderObservationController::class, 'setUnderObservation'])
	->name('admin.student.set_under_observation');

Route::get('admin/student/remove_under_observation/{student}', [StudentUnderObservationController::class, 'removeUnderObservation'])
	->name('admin.student.remove_under_observation');


/*-------------------------------------------------------------------------
| StudentMissionTaskController
|--------------------------------------------------------------------------*/
Route::get('admin/student/mission/task/show/{studentMissionTask}', [StudentMissionTaskController::class, 'show'])
	->name('admin.student.mission.task.show');

Route::post('admin/student/mission/task/update/{studentMissionTask}', [StudentMissionTaskController::class, 'update'])
	->name('admin.student.mission.task.update');

Route::post('admin/student/mission/task/delete/{studentMissionTask}', [StudentMissionTaskController::class, 'delete'])
	->name('admin.student.mission.task.delete');

// free text
Route::get('admin/student/mission/task/update_free_text/{studentMissionTask}', [StudentMissionTaskController::class, 'updateFreeText'])
	->name('admin.student.mission.task.update_free_text');

// pass reading
Route::get('admin/student/mission/task/update_pass_reading/{studentMissionTask}/{status}', [StudentMissionTaskController::class, 'updatePassReading'])
	->name('admin.student.mission.task.update_pass_reading');

Route::match(['GET', 'POST'], 'admin/student_mission_task/count', [StudentMissionTaskController::class, 'studentMissionTaskCount'])
	->name('admin.student_mission_task.count');

/*-------------------------------------------------------------------------
| MissionTaskController
|--------------------------------------------------------------------------*/
//admin student mission task
Route::get('admin/student/task/dashboard/{studentMission}', [MissionTaskController::class, 'dashboard'])
	->name('admin.student.task.dashboard');

Route::get('admin/student/task/quran/{studentMissionTask}', [MissionTaskController::class, 'quran'])
	->name('admin.student.task.quran');

Route::post('admin/student/task/store', [MissionTaskController::class, 'store'])
	->name('admin.student.task.store');

Route::get('admin/student/mission/task/create_new/{studentMissionTask}', [MissionTaskController::class, 'createNew'])
	->name('admin.student.mission.task.create_new');

Route::post('admin/student/mission/task/store_new/{studentMissionTask}', [MissionTaskController::class, 'storeNew'])
	->name('admin.student.mission.task.store_new');

Route::get('admin/student/mission/task/half_done_edit/{studentMissionTask}', [MissionTaskController::class, 'halfDoneEdit'])
	->name('admin.student.mission.task.half_done_edit');

Route::post('admin/student/mission/task/half_done_update/{studentMissionTask}', [MissionTaskController::class, 'halfDoneUpdate'])
	->name('admin.student.mission.task.half_done_update');

Route::get('admin/student/mission/create/{student}/{mission}', [MissionTaskController::class, 'studentMissionCreate'])
	->name('admin.student.mission.create');

/*-------------------------------------------------------------------------
| StudentMissionController
|--------------------------------------------------------------------------*/
Route::get('admin/student_mission/toggle_done/{studentMission}', [StudentMissionController::class, 'toggleDone'])
	->middleware(['userPermission:manage-mission'])
	->name('admin.student_mission.toggle_done');

Route::get('admin/student_mission/show/{studentMission}', [StudentMissionController::class, 'show'])
	->name('admin.student_mission.show');

Route::get('admin/student_mission/delete/{studentMission}', [StudentMissionController::class, 'destroy'])
	->middleware(['userPermission:manage-mission'])
	->name('admin.student_mission.delete');

/*-------------------------------------------------------------------------
| AdminStudentHasMissionController
|--------------------------------------------------------------------------*/
Route::group(['middleware' => 'auth'], function () {

	Route::get('admin/student_has_mission/approved/index', [AdminStudentHasMissionController::class, 'approvedIndex'])
		->middleware(['userPermission:hesas-review-approve'])
		->name('admin.student_has_mission.approved.index');

});

/*-------------------------------------------------------------------------
| MissionController
|--------------------------------------------------------------------------*/
//admin student mission
Route::get('admin/student/mission/index/{student}', [MissionController::class, 'studentMissionIndex'])
	->name('admin.student.mission.index');

Route::get('admin/student/mission/history/{student}', [MissionController::class, 'studentMissionHistory'])
	->name('admin.student.mission.history');

Route::get('admin/student/mission/index_test/{student}', [MissionController::class, 'studentMissionIndexTest'])
	->name('admin.student.mission.index_test');

//admin mission
Route::get('admin/mission/create', [MissionController::class, 'create'])
	->name('admin.mission.create');

Route::get('admin/mission/order_edit/{mission}', [MissionController::class, 'orderEdit'])
	->name('admin.mission.order_edit');

Route::post('admin/mission/order_update', [MissionController::class, 'orderUpdate'])
	->name('admin.mission.order_update');

Route::get('admin/mission/reorder/{mission}', [MissionController::class, 'reOrder'])
	->name('admin.mission.reorder');

Route::get('admin/mission/edit/add_new/{missionTask}', [MissionController::class, 'addNew'])
	->name('admin.mission.edit.add_new');

Route::get('admin/mission/print/{mission}', [MissionController::class, 'print'])
	->name('admin.mission.print');

Route::get('admin/mission/print_all_active_asc', [MissionController::class, 'printAllActiveASC'])
	->name('admin.mission.print_all_active_asc');

Route::get('admin/mission/task/{mission}/one_surat', [MissionController::class, 'taskOneSurat'])
	->name('admin.mission.task.one_surat');

Route::get('admin/mission/task/{mission}/surat_to_surat', [MissionController::class, 'taskSuratToSurat'])
	->name('admin.mission.task.surat_to_surat');

Route::get('admin/mission/task/{mission}/aya_to_aya', [MissionController::class, 'taskAyaToAya'])
	->name('admin.mission.task.aya_to_aya');

Route::get('admin/mission/task/{mission}/free_text', [MissionController::class, 'taskFreeText'])
	->name('admin.mission.task.free_text');


//student has mission


/*-------------------------------------------------------------------------
| HesasController
|--------------------------------------------------------------------------*/
/* -- mission hesas --*/
Route::get('student/hesas_review_waiting_approval', [HesasController::class, 'reviewWaitingApproval'])
	->middleware('userPermission:hesas-review-approve')
	->name('student.hesas_review_waiting_approval');

Route::get('student/hesas_review_not_done', [HesasController::class, 'reviewNotDone'])
	->name('student.hesas_review_not_done');

Route::post('student/hesas_review_approve', [HesasController::class, 'reviewApprove'])
	->middleware('userPermission:hesas-review-approve')
	->name('student.hesas_review_approve');

Route::get('student/hesas_review_create/{studentHasMission}', [HesasController::class, 'reviewCreate'])
	->name('student.hesas_review_create');
Route::post('student/hesas_review_store/{studentHasMission}', [HesasController::class, 'reviewStore'])
	->name('student.hesas_review_store');

/*-------------------------------------------------------------------------
| QuranController
|--------------------------------------------------------------------------*/
Route::get('quran/ayas/{sowar_id}/{ayafrom}/{ayato}', [QuranController::class, 'quranAyas'])
	->name('quran.ayas');

/* End Onesowar  */

require __DIR__ . '/auth.php';

/*-------------------------------------------------------------------------
| WarnController
|--------------------------------------------------------------------------*/
Route::get('admin/warn/dashboard', [WarnController::class, 'dashboard'])
	->middleware('userPermission:admin.warn.dashboard')
	->name('admin.warn.dashboard');

Route::get('admin/warnabsent/truncate', [WarnController::class, 'warnabsentTruncate'])
	->middleware('userPermission:admin.warnabsent.truncate')
	->name('admin.warnabsent.truncate');

Route::get('admin/warnlate/truncate', [WarnController::class, 'warnlateTruncate'])
	->middleware('userPermission:admin.warnlate.truncate')
	->name('admin.warnlate.truncate');

/*-------------------------------------------------------------------------
| WarnController
|--------------------------------------------------------------------------*/
Route::get('warn/female_index', [WarnController::class, 'femaleIndex'])
	->name('warn.female_index');

Route::get('warn/edit/{student}', [WarnController::class, 'edit'])
	->name('warn.edit');

Route::get('warn/absent_update/{warnabsent}', [WarnController::class, 'absentUpdate'])
	->name('warn.absent_update');

Route::get('warn/absent_clear/{student}', [WarnController::class, 'absentClear'])
	->name('warn.absent_clear');

// warn - late
Route::get('warn/late_update/{warnlate}', [WarnController::class, 'lateUpdate'])->name('warn.late_update');
Route::get('warn/late_clear/{student}', [WarnController::class, 'lateClear'])->name('warn.late_clear');

/*-------------------------------------------------------------------------
| SuggestionController
|--------------------------------------------------------------------------*/
// suggestions cate
Route::get('suggestioncate/{suggestioncate}/show', [SuggestionController::class, 'suggestioncateShow'])
	->middleware(['userPermission:suggestioncate-admin'])
	->name('suggestioncate.show');

Route::get('suggestioncate/index', [SuggestionController::class, 'suggestioncateIndex'])
	->middleware(['userPermission:suggestioncate-view'])
	->name('suggestioncate.index');

Route::get('suggestioncate/create', [SuggestionController::class, 'suggestioncateCreate'])
	->middleware('userPermission:suggestioncate-admin')
	->name('suggestioncate.create');

Route::post('suggestioncate/store', [SuggestionController::class, 'suggestioncateStore'])
	->middleware('userPermission:suggestioncate-admin')
	->name('suggestioncate.store');

Route::get('suggestioncate/{suggestioncate}/edit', [SuggestionController::class, 'suggestioncateEdit'])
	->middleware('userPermission:suggestioncate-admin')
	->name('suggestioncate.edit');

Route::post('suggestioncate/{suggestioncate}/update', [SuggestionController::class, 'suggestioncateUpdate'])
	->middleware('userPermission:suggestioncate-admin')
	->name('suggestioncate.update');

// suggestions
Route::get('suggestion/index/{suggestioncate}', [SuggestionController::class, 'suggestionIndex'])
	->middleware(['userPermission:suggestioncate-view'])
	->name('suggestion.index');

Route::get('suggestion/{suggestioncate}/create', [SuggestionController::class, 'suggestionCreate'])
	->middleware(['userPermission:suggestioncate-view'])
	->name('suggestion.create');

Route::post('suggestion/store', [SuggestionController::class, 'suggestionStore'])
	->middleware(['userPermission:suggestioncate-view'])
	->name('suggestion.store');

Route::get('suggestion/{suggestion}/edit', [SuggestionController::class, 'suggestionEdit'])
	->middleware(['userPermission:suggestioncate-view'])
	->name('suggestion.edit');

Route::post('suggestion/{suggestion}/update', [SuggestionController::class, 'suggestionUpdate'])
	->middleware(['userPermission:suggestioncate-view'])
	->name('suggestion.update');

Route::get('suggestion/{suggestion}/destroy', [SuggestionController::class, 'suggestionDestroy'])
	->middleware(['userPermission:suggestioncate-view'])
	->name('suggestion.destroy');

// replay
Route::get('suggestion/{suggestion}/replay/index', [SuggestionController::class, 'suggestionReplayIndex'])
	->middleware(['userPermission:suggestioncate-view'])
	->name('suggestion.replay.index');

Route::post('suggestion/replay/store', [SuggestionController::class, 'suggestionReplayStore'])
	->middleware(['userPermission:suggestioncate-view'])
	->name('suggestion.replay.store');

Route::get('suggestion/{suggestion}/replay/edit', [SuggestionController::class, 'suggestionReplayEdit'])
	->middleware(['userPermission:suggestioncate-view'])
	->name('suggestion.replay.edit');

Route::post('suggestion/{suggestion}/replay/update', [SuggestionController::class, 'suggestionReplayUpdate'])
	->middleware(['userPermission:suggestioncate-view'])
	->name('suggestion.replay.update');

// suggestions permission
Route::post('suggestionpermission/{suggestioncate}/store', [SuggestionController::class, 'suggestionpermissionStore'])
	->middleware(['userPermission:suggestioncate-view'])
	->name('suggestionpermission.store');

Route::get('suggestionpermission/{user}/{suggestioncate}/delete', [SuggestionController::class, 'suggestionpermissionDelete'])
	->middleware(['userPermission:suggestioncate-admin', 'userPermission:suggestioncate-view'])
	->name('suggestionpermission.delete');

/*-------------------------------------------------------------------------
| StorednoteController
|--------------------------------------------------------------------------*/
// storednote
Route::get('storednote/create', [StorednoteController::class, 'create'])
	->middleware('auth')
	->name('storednote.create');

Route::get('storednote/delete/{storednote}', [StorednoteController::class, 'delete'])
	->middleware('auth')
	->name('storednote.delete');

Route::post('storednote/store', [StorednoteController::class, 'store'])
	->middleware('auth')
	->name('storednote.store');
/*-------------------------------------------------------------------------
| MessageController
|--------------------------------------------------------------------------*/
// message
Route::group(['prefix' => 'message', 'middleware' => 'auth'], function () {

	Route::get('index', [MessageController::class, 'index'])
		->name('message.index');

	Route::get('create', [MessageController::class, 'create'])
		->name('message.create');

	Route::get('replay_create/{message}', [MessageController::class, 'replayCreate'])
		->name('message.replay_create');

	Route::post('store', [MessageController::class, 'store'])
		->name('message.store');

	Route::post('replay_store', [MessageController::class, 'replayStore'])
		->name('message.replay_store');

	Route::get('receiver/index', [MessageController::class, 'receiverIndex'])
		->name('message.receiver.index');

	Route::get('receiver/permission/{user}/index', [MessageController::class, 'receiverPermissionIndex'])
		->name('message.receiver.permission.index');

	Route::post('receiver/permission/{user}/update', [MessageController::class, 'receiverPermissionUpdate'])
		->name('message.receiver.permission.update');

	Route::get('edit/{message}', [MessageController::class, 'edit'])
		->name('message.edit');

	Route::post('update/{message}', [MessageController::class, 'update'])
		->name('message.update');
});

/*-------------------------------------------------------------------------
| studentStudentController
|--------------------------------------------------------------------------*/
Route::group(['middleware' => 'auth:student'], function () {

	Route::get('student/dashboard', [StudentDashboardStudentController::class, 'dashboard'])->name('student.dashboard');

	Route::get('student/dashboard/absence_details', [StudentDashboardStudentController::class, 'absenceTimesDetails'])
		->name('student.dashboard.absence_details');
});

Route::group(['middleware' => 'auth:student'], function () {

	/*-------------------------------------------------------------------------
	| StudentDashboardStudentController
*/
	Route::get('student/dashboard/duaa/show/{studentHasDuaa}', [StudentDashboardStudentController::class, 'showDuaa'])->name('student.dashboard.duaa.show');
});

/*-------------------------------------------------------------------------
| studentStudentMissionTaskController
|--------------------------------------------------------------------------*/
Route::group(['prefix' => 'student', 'middleware' => 'auth:student'], function () {

	Route::get('dashboard/student_mission_task/index/{studentMission}', [studentStudentMissionTaskController::class, 'studentMissionTaskIndex'])
		->name('student.dashboard.student_mission_task.index');
});

Route::group(['prefix' => 'student', 'middleware' => 'auth:student'], function () {
	Route::get('mission/task/show/{studentMissionTask}', [studentStudentMissionTaskController::class, 'show'])
		->name('student.mission.task.show');
});



/*-------------------------------------------------------------------------
| studentMarkController
|--------------------------------------------------------------------------*/
Route::group(['prefix' => 'student', 'middleware' => 'auth:student'], function () {
	Route::get('mark/index', [studentMarkController::class, 'index'])
		->name('student.mark.index');

	Route::get('mark/index', [studentMarkController::class, 'index'])
		->name('student.mark.index');
});

/*-------------------------------------------------------------------------
| studentNoteController
|--------------------------------------------------------------------------*/
Route::group(['prefix' => 'student', 'middleware' => 'auth:student'], function () {
	Route::get('note/index', [studentNoteController::class, 'index'])
		->name('student.note.index');
});

/*-------------------------------------------------------------------------
| studentWarningController
|--------------------------------------------------------------------------*/
Route::group(['prefix' => 'student', 'middleware' => 'auth:student'], function () {
	Route::get('warning/index', [studentWarningController::class, 'index'])
		->name('student.warning.index');

	Route::get('warning/absence_warn', [studentWarningController::class, 'absenceWarn'])
		->name('student.warning.absence_warn');
});

/*-------------------------------------------------------------------------
| studentMonthlysubscribeController
|--------------------------------------------------------------------------*/
Route::group(['prefix' => 'student', 'middleware' => 'auth:student'], function () {
	Route::get('monthlysubscribe/index', [studentMonthlysubscribeController::class, 'index'])
		->name('student.monthlysubscribe.index');
});

/*-------------------------------------------------------------------------
| AdminDuaacateController
|--------------------------------------------------------------------------*/
Route::group(['middleware' => 'auth'], function () {

	Route::get('admin/duaacate/dashboard', [AdminDuaacateController::class, 'dashboard'])
		->name('admin.duaacate.dashboard');

	Route::post('admin/duaacate/parent_store', [AdminDuaacateController::class, 'parentStore'])
		->name('admin.duaacate.parent_store');

	Route::post('admin/duaacate/parent_update', [AdminDuaacateController::class, 'parentUpdate'])
		->name('admin.duaacate.parent_update');

	Route::post('admin/duaacate/child_store', [AdminDuaacateController::class, 'childStore'])
		->name('admin.duaacate.child_store');

	Route::post('admin/duaacate/child_update', [AdminDuaacateController::class, 'childUpdate'])
		->name('admin.duaacate.child_update');

	Route::get('admin/student/duaacate/dashboard/{student}', [AdminDuaacateController::class, 'studentDuaacateDashboard'])
		->name('admin.student.duaacate.dashboard');
});

/*-------------------------------------------------------------------------
| AdminDuaacateStudentTaskController
|--------------------------------------------------------------------------*/
Route::group(['middleware' => 'auth'], function () {

	Route::get('admin/duaacate_student_task/dashboard/{duaacate_student_id}', [AdminDuaacateStudentTaskController::class, 'dashboard'])
		->name('admin.duaacate_student_task.dashboard');

	Route::post('admin/duaacate_student_task/store', [AdminDuaacateStudentTaskController::class, 'store'])
		->name('admin.duaacate_student_task.store');

	Route::get('admin/duaacate_student_task/show/{duaacate_student_task_id}', [AdminDuaacateStudentTaskController::class, 'show'])
		->name('admin.duaacate_student_task.show');

	Route::get('admin/duaacate_student_task/delete/{duaacate_student_task_id}', [AdminDuaacateStudentTaskController::class, 'delete'])
		->name('admin.duaacate_student_task.delete');

	Route::match(['GET', 'POST'], 'admin/duaacate_student_task/count', [AdminDuaacateStudentTaskController::class, 'duaacateStudentTaskCount'])
		->name('admin.duaacate_student_task.count');
});

/*-------------------------------------------------------------------------
| AdminDuaacateStudentController
|--------------------------------------------------------------------------*/
Route::group(['middleware' => 'auth'], function () {

	Route::get('admin/duaacate_student/show/{duaacate_student_id}', [AdminDuaacateStudentController::class, 'show'])
		->name('admin.duaacate_student.show');

	Route::post('admin/duaacate_student/store', [AdminDuaacateStudentController::class, 'store'])
		->name('admin.duaacate_student.store');

	Route::get('admin/duaacate_student/toggle_done/{duaacate_student_id}', [AdminDuaacateStudentController::class, 'toggleDone'])
		->name('admin.duaacate_student.toggle_done');

	Route::get('admin/duaacate_student/history/{student_id}', [AdminDuaacateStudentController::class, 'duaacate_student_history'])
		->name('admin.duaacate_student.history');

	Route::post('admin/duaacate_student/delete', [AdminDuaacateStudentController::class, 'destroy'])
		->name('admin.duaacate_student.delete');
});

/*-------------------------------------------------------------------------
| AdminDuaacateTaskController
|--------------------------------------------------------------------------*/
Route::group(['middleware' => 'auth'], function () {

	Route::get('admin/duaacate/task/index/{duaacate}', [AdminDuaacateTaskController::class, 'index'])
		->name('admin.duaacate.task.index');

	Route::post('admin/duaacate/task/store', [AdminDuaacateTaskController::class, 'store'])
		->name('admin.duaacate.task.store');

	Route::get('admin/duaacate/task/show/{duaacate_task_id}', [AdminDuaacateTaskController::class, 'show'])
		->name('admin.duaacate.task.show');

	Route::post('admin/duaacate/task/update/{duaacate_task_id}', [AdminDuaacateTaskController::class, 'update'])
		->name('admin.duaacate.task.update');

	Route::get('admin/duaacate/task/delete/{duaacate_task_id}', [AdminDuaacateTaskController::class, 'delete'])
		->name('admin.duaacate.task.delete');

	Route::get('admin/student/duaacate/task/index/{duaacate}/{student}', [AdminDuaacateTaskController::class, 'studentDuaacateTaskIndex'])
		->name('admin.student.duaacate.task.index');

	Route::get('admin/student/duaacate/task/show/{duaacate_task_id}/{student}', [AdminDuaacateTaskController::class, 'studentDuaacateTaskShow'])
		->name('admin.student.duaacate.task.show');
});

/*-------------------------------------------------------------------------
| StudentHasDuaaController
|--------------------------------------------------------------------------*/
Route::group(['middleware' => 'auth'], function () {

	Route::get('student_has_duaa/done_create/{studentHasDuaa}', [StudentHasDuaaController::class, 'doneCreate'])
		->name('student_has_duaa.done_create');

	Route::post('student_has_duaa/update/{studentHasDuaa}', [StudentHasDuaaController::class, 'update'])
		->name('student_has_duaa.update');
});

/*-------------------------------------------------------------------------
| studentDuaacateStudentTaskController
|--------------------------------------------------------------------------*/
Route::group(['prefix' => 'student', 'middleware' => 'auth:student'], function () {
	Route::get('dashboard/duaacate_student_task/index/{duaacate_student_id}', [studentDuaacateStudentTaskController::class, 'index'])
		->name('student.dashboard.duaacate_student_task.index');

	Route::get('dashboard/duaacate_student_task/show/{duaacate_task_id}', [studentDuaacateStudentTaskController::class, 'show'])
		->name('student.dashboard.duaacate_student_task.show');
});

/*-------------------------------------------------------------------------
| student_has_record_daily
|--------------------------------------------------------------------------*/
Route::get('admim/student_has_record_daily/absent_excuse_create/{student_has_record_daily_id}', [AdminStudentHasRecordDailyController::class, 'absent_excuse_create'])
	->name('admim.student_has_record_daily.absent_excuse_create');

Route::post('admim/student_has_record_daily/absent_excuse_store', [AdminStudentHasRecordDailyController::class, 'absent_excuse_store'])
	->name('admim.student_has_record_daily.absent_excuse_store');

/*-------------------------------------------------------------------------
| frontpage
|--------------------------------------------------------------------------*/
Route::get('admin/frontpage/show', [FrontpageController::class, 'show'])
	->name('admin.frontpage.show');

Route::post('admin/frontpage/store', [FrontpageController::class, 'store'])
	->middleware('userPermission:admin.frontpage.store')
	->name('admin.frontpage.store');

/*-------------------------------------------------------------------------
| TEMP
|--------------------------------------------------------------------------*/

Route::get('male_student_mission_tasks', [TempController::class, 'male_student_mission_tasks'])
	->name('male_student_mission_tasks');

Route::get('female_student_mission_tasks', [TempController::class, 'female_student_mission_tasks'])
	->name('female_student_mission_tasks');

Route::get('all_male_student', [TempController::class, 'allMaleStudent'])
	->name('all_male_student');

Route::get('all_female_student', [TempController::class, 'allFemaleStudent'])
	->name('all_female_student');

Route::get('duaa', [TempController::class, 'duaa'])
	->name('duaa');
