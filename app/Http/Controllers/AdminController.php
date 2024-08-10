<?php

namespace App\Http\Controllers;

use App\Helper\Helperfunction;
use App\Models\Level;
use App\Models\Mission;
use App\Models\Recorddaily;
use App\Models\Student;
use App\Models\StudentHasRecordDaily;
use App\Models\User;
use App\Models\UserRecorddaily;
use App\Models\Workperiod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	protected function getLogedUser()
	{
		return auth()->user();
	}

	public function daysOfStudentAbsent(Student $student)
	{

		$workperiod = Helperfunction::getUserWorkperiod();

		// return $workperiod;
		$withoutExcuseStudentRecords = StudentHasRecordDaily::where([
			'student_id' => $student->id,
			'present_time' => NULL,
			'with_excuse' => 0,
		])->join('recorddailies', 'student_has_record_daily.recorddaily_id', '=', 'recorddailies.id')
			->select('recorddailies.title', 'student_has_record_daily.recorddaily_id', 'student_has_record_daily.note')
			->get();


		$withExcuseStudentRecords = StudentHasRecordDaily::where([
			'student_id' => $student->id,
			'present_time' => NULL,
			'with_excuse' => 1,
		])->join('recorddailies', 'student_has_record_daily.recorddaily_id', '=', 'recorddailies.id')
			->select('recorddailies.title', 'student_has_record_daily.recorddaily_id', 'student_has_record_daily.note')
			->get();

		return view('admin.student.days_of_student_absent', compact('withoutExcuseStudentRecords', 'withExcuseStudentRecords', 'student', 'workperiod'));
	}

	/* User*/

	public function userEditPassword(User $user)
	{
		if ($user->id == 1) {
			abort(403);
		}
		return view('admin.user.edit_password', compact('user'));
	}

	public function userUpdatePassword(Request $request, User $user)
	{
		if ($user->email !== $request->email) {
			$request->validate(['password' => 'required']);
		}

		// return $request->all();

		$user->update([
			'password' => Hash::make($request->password),
			'plain_password' => $request->password,
		]);

		if ($user->user_type == 'male_teacher') {
			return redirect()->route('admin.user.male_teacher.index')
				->with(['message' => 'تم التحديث', 'status' => 'success']);
		} elseif ($user->user_type == 'male_moderator') {
			return redirect()->route('admin.user.male_moderator.index')
				->with(['message' => 'تم التحديث', 'status' => 'success']);
		} elseif ($user->user_type == 'female_teacher') {
			return redirect()->route('admin.user.female_teacher.index')
				->with(['message' => 'تم التحديث', 'status' => 'success']);
		} elseif ($user->user_type == 'female_moderator') {
			return redirect()->route('admin.user.female_moderator.index')
				->with(['message' => 'تم التحديث', 'status' => 'success']);
		}
		return redirect()->route('admin.user.admin.index')
			->with(['message' => 'تم التحديث', 'status' => 'success']);
	}

	public function userEdit(User $user)
	{
		if ($user->id == 1) {
			abort(403);
		}
		$workperiods = Workperiod::all();
		return view('admin.user.edit', compact('user', 'workperiods'));
	}

	public function userUpdate(Request $request, User $user)
	{


		if ($user->id == 1) {
			abort(403, 'this user cannot be updated');
		}

		if ($user->user_type == 'male_moderator' || $request->user_type == 'male_teacher') {
			$request['gender'] = 'm';
		} elseif ($user->user_type == 'female_moderator' || $request->user_type == 'female_teacher') {
			$request['gender'] = 'f';
		}

		if ($user->user_type == 'admin') {
			$request['user_type'] = 'admin';
		}

		if ($user->user_type !== $request->user_type) {

			switch ($request->user_type) {
				case 'male_moderator':
					$user->roles()->sync(2);
					break;

				case 'male_teacher':
					$user->roles()->sync(4);
					break;

				case 'female_moderator':
					$user->roles()->sync(3);
					break;

				case 'female_teacher':
					$user->roles()->sync(5);
					break;
			}
		}

		$user->update([
			'national_id' => $request->national_id,
			'first_name' => $request->first_name,
			'second_name' => $request->second_name,
			'third_name' => $request->third_name,
			'last_name' => $request->last_name,
			'full_name' => $request->full_name,
			'phone' => $request->phone,
			'user_type' => $request->user_type,
			'active' => $request->active,
			'note' => $request->note,
			'workperiod_id' => $request->workperiod_id
		]);

		if ($user->user_type == 'male_teacher') {
			return redirect()->route('admin.user.male_teacher.index')
				->with(['message' => 'تم التحديث', 'status' => 'success']);
		} elseif ($user->user_type == 'male_moderator') {
			return redirect()->route('admin.user.male_moderator.index')
				->with(['message' => 'تم التحديث', 'status' => 'success']);
		} elseif ($user->user_type == 'female_teacher') {
			return redirect()->route('admin.user.female_teacher.index')
				->with(['message' => 'تم التحديث', 'status' => 'success']);
		} elseif ($user->user_type == 'female_moderator') {
			return redirect()->route('admin.user.female_moderator.index')
				->with(['message' => 'تم التحديث', 'status' => 'success']);
		}
		return redirect()->route('admin.user.admin.index')
			->with(['message' => 'تم التحديث', 'status' => 'success']);
	}

	public function recordMonthAbsent($month)
	{
		$userWorkperiod = Helperfunction::getUserWorkperiod();

		$loggedUser = auth()->user();
		if ($loggedUser->user_type != 'admin') {
			if ($loggedUser->user_type == 'male_moderator') {
				$absents = StudentHasRecordDaily::groupBy('student_id', 'students.full_name')
					->select('student_id', 'students.full_name', DB::raw('count(student_id) as absent_times'))
					->leftjoin('students', 'student_has_record_daily.student_id', 'students.id')
					->where(['month' => $month, 'present' => 0, 'gender' => 'm', 'students.workperiod_id' => $userWorkperiod->id])
					->orderby('absent_times', 'desc')
					->get();
			} else {
				$absents = StudentHasRecordDaily::groupBy('student_id', 'students.full_name')
					->select('student_id', 'students.full_name', DB::raw('count(student_id) as absent_times'))
					->leftjoin('students', 'student_has_record_daily.student_id', 'students.id')
					->where(['month' => $month, 'present' => 0, 'gender' => 'f'])
					->orderby('absent_times', 'desc')
					->get();
			}
		} else {
			$absents = StudentHasRecordDaily::groupBy('student_id', 'students.full_name')
				->select('student_id', 'students.full_name', DB::raw('count(student_id) as absent_times'))
				->leftjoin('students', 'student_has_record_daily.student_id', 'students.id')
				->where(['month' => $month, 'present' => 0, 'students.workperiod_id' => $userWorkperiod->id])
				->orderby('absent_times', 'desc')
				->get();
		}

		return view('record.month.absent', compact('absents', 'month'));
	}


	public function adminRecordDailyStore(Request $request)
	{
		$this->validate($request, [
			'levels' => 'required',
		]);

		$levels = $request->levels;
		if (count($levels) == 0) {
			abort(403);
		}

		$time = time();
		$thisDay = date('D', $time);
		$thisYear = date('Y', $time);
		$thisMonth = date('m', $time);
		$students = Student::where('status', 'active')
			->whereIn('level_id', $levels)->get();

		$recordDaily = Recorddaily::create(
			[
				'create_student_list' => $request->addStudentToList == 'add' ? 1 : 0,
				'title' => $request->title,
				'day' => $thisDay,
			]
		);

		if ($request->addStudentToList == 'add') {

			foreach ($students as $student) {
				StudentHasRecordDaily::create(['year' => $thisYear, 'month' => $thisMonth, 'recorddaily_id' => $recordDaily->id, 'student_id' => $student->id, 'level_id' => $student->level_id]);
			}
		}

		return redirect()->route('dashboard');
	}

	/* inactive */
	public function inactiveStudentIndex()
	{
		$userWorkperiod = Helperfunction::getUserWorkperiod();

		$whereFields = ['status' => 'disabled', 'workperiod_id' => $userWorkperiod->id];

		$loggedUser = auth()->user();

		//teacher
		if ($loggedUser->user_type == 'male_teacher' || $loggedUser->user_type == 'female_teacher') {
			$whereFields = ['status' => 'disabled', 'workperiod_id' => $userWorkperiod->id, 'level_id' => $loggedUser->level_id];
		}

		$students = Student::where($whereFields)
			->with('workperiod')
			->get();

		return view('admin.student.inactive_index', compact('students'));
	}

	/* waiting approval */
	public function waitingApprovalStudentIndex()
	{
		$students = Student::where(['status' => 'waitingApproval'])
			->get();
		return view('admin.student.waiting_approval', compact('students'));
	}

	public function approvalStudent(Request $request)
	{
		// return $request->all();
		if ($request->ids) {
			Student::whereIn('id', $request->ids)
				->update(['status' => 'active']);
			return back()->with(['status' => 'success', 'message' => 'تم']);
		}
		abort(404, 'لم يتم تحديد طالب');
	}

	public function waitingApprovalStudentShowDeleteForm()
	{
		$students = Student::where(['status' => 'waitingApproval'])
			->get();
		return view('admin.student.waiting_approval_delete', compact('students'));
	}

	public function waitingApprovalStudentDelete(Request $request)
	{
		// return $request->all();
		if ($request->ids) {
			Student::whereIn('id', $request->ids)
				->delete();
			return back()->with(['status' => 'success', 'message' => 'تم']);
		}
		abort(404, 'لم يتم تحديد طالب');
	}

	public function studentTransCreate(Student $student)
	{
		$userWorkperiodsIds = auth()->user()->userHasWorkperiods()->pluck('user_has_workperiod.workperiod_id');
		$workperiods = Workperiod::whereHas('userHasWorkperiods', function ($q) use ($userWorkperiodsIds) {
			$q->whereIn('user_has_workperiod.workperiod_id', $userWorkperiodsIds);
		})->get();
		// return $workperiods;
		return view('admin.student.trans.create', compact('workperiods', 'student'));
	}

	public function studentTransUpdate(Student $student, $workperiodId, $levelId)
	{
		$student->update(['level_id' => $levelId, 'workperiod_id' => $workperiodId]);

		return back()->with(['status' => 'success', 'message' => 'تم']);
	}

	public function teacherShiftlevelCreate($teacher_id)
	{
		$teacher = User::find($teacher_id);

		$levels = Level::all();

		return view('admin.user.shiftlevel.create', compact('levels', 'teacher'));
	}

	public function teacherShiftlevelUpdate(Request $request)
	{
		// return $request->all();
		$user = User::findOrFail($request->teacher_id);

		$user->update(['level_id' => $request->level_id]);

		if ($user->gender == 'm') {
			return redirect()->route('admin.user.male_teacher.index');
		} else {
			return redirect()->route('admin.user.female_teacher.index');
		}
	}

	public function studentCreate()
	{

		$userWorkperiod = Helperfunction::getUserWorkperiod();

		$levels = $userWorkperiod->levelHasWorkperiods()->get();

		return view('admin.student.create', compact('levels', 'userWorkperiod'));
	}

	public function studentStore(Request $request)
	{
		// return $request->all();

		$this->validate($request, [
			'first_name' => 'required',
			'second_name' => 'required',
			'third_name' => 'required',
			'last_name' => 'required',
			'national_id' => 'required',
		]);


		$study_days = $request->study_days == 'op1' ? '["Sun","Tue","Thu"]' : '["Mon","Wed","Thu"]';

		// $today = date('Y-m-d');
		// $diff = date_diff(date_create($request->dob), date_create($today));
		// $request['age'] =$diff->format('%y');

		$first_name = $request->first_name;
		$second_name = $request->second_name;
		$third_name = $request->third_name;
		$last_name = $request->last_name;

		$gender = auth()->user()->gender;

		$workperiod_id = auth()->user()->workperiod_id;

		$level_id = $request->level_id;

		$bin = ' بن ';

		if ($gender == 'f') {
			$bin = ' بنت ';
		}

		$password = 555;

		$full_name = $first_name . $bin . $second_name . ' بن ' . $third_name . ' ' . $last_name;

		$student = Student::create([
			'national_id' => $request->national_id,
			'first_name' => $first_name,
			'second_name' => $second_name,
			'third_name' => $third_name,
			'last_name' => $last_name,
			'full_name' => $full_name,
			'gender' => $gender,
			'workperiod_id' => $workperiod_id,
			'level_id' => $level_id,
			'password' => $password,
			'study_days' => $study_days,
		]);

		return redirect()->route('admin.student.dashboard', ['student' => $student->id])
			->with(['status' => 'success', 'message' => 'تم']);
	}


	public function userLoginCreate()
	{
		return view('admin.user.login');
	}
	public function userLogin(Request $request)
	{
	}
	public function userLogout(Request $request)
	{
		Auth()->guard()->logout();
		return redirect()->route('welcome');
	}

	/* level */

	public function registerStudentAsPersent(Request $request, Recorddaily $recorddaily)
	{
		// return $request->all();
		$ids = $request->absents;
		if (!$ids) {
			die('<h1><center>لايوجد طلاب</center></h1>');
		}

		$late = 0;
		if ($request->late) {
			$late = 1;
		}

		StudentHasRecordDaily::where('recorddaily_id', $recorddaily->id)
			->whereIn('student_id', $ids)
			->update(['present_time' => time(), 'islate' => $late]);

		return redirect()->route(
			'record.day.index',
			['recorddaily' => $recorddaily->id]
		);
	}

	public function registerStudentAsAbsent(Request $request, Recorddaily $recorddaily)
	{

		$ids = $request->absents;
		if ($ids) {
			StudentHasRecordDaily::where('recorddaily_id', $recorddaily->id)
				->whereIn('student_id', $ids)
				->update(['present_time' => NULL]);

			return back();
		}
		die('<h1><center>لايوجد طلاب</center></h1>');
	}
}
