<?php

namespace App\Http\Controllers;

use App\Helper\Helperfunction;
use App\Models\Level;
use App\Models\Recorddaily;
use App\Models\Student;
use App\Models\StudentHasRecordDaily;
use App\Models\User;
use App\Models\UserRecorddaily;
use App\Models\Workperiod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecordController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function recordDayEdit($id)
	{

		$studentHasRecordDaily = StudentHasRecordDaily::find($id);

		return view('record.day.edit', compact('studentHasRecordDaily'));
	}

	public function recordDayUpdate(Request $request)
	{
		// return $request->all();

		$studentHasRecordDaily = StudentHasRecordDaily::findOrFail($request->id);

		// return  $studentHasRecordDaily;

		$update = [];

		// 0 => student is absent
		if ($request->present_time == 0) {

			if ($request->with_excuse == 0) {
				$request->validate(['note' => 'required']);
			}

			$update['with_excuse'] = $request->with_excuse;
			$update['note'] = $request->note;
			$update['present_time'] = NULL;
			$update['islate'] = 0;
		} else {

			$update['with_excuse'] = 0;
			$update['note'] = NULL;
			$update['present_time'] = $request->present_time;
			$update['islate'] = $request->islate;
		}

		StudentHasRecordDaily::where('id', $request->id)
			->update($update);

		return redirect()->route('admin.student.dashboard', $studentHasRecordDaily->student_id);
	}

	// admin.record.day.male_index

	public function recordDayIndex(Recorddaily $recorddaily)
	{

		$loggedUser = auth()->user();

		$where = [
			'recorddaily_id' => $recorddaily->id,
		];

		if ($loggedUser->user_type == 'male_teacher' || $loggedUser->user_type == 'female_teacher') {
			$where = [
				'recorddaily_id' => $recorddaily->id,
				'student_has_record_daily.level_id' => $loggedUser->level_id
			];
		}

		$title = 'تاريخ السجل: ' . $recorddaily->created_at->toDateString();

		$presents = StudentHasRecordDaily::where($where)
			->whereNotNull('present_time')
			->select(
				'full_name',
				'student_id',
				'present_time',
				'levels.title as teacher_room',
				'students.gender',
				'student_has_record_daily.id',
				'student_has_record_daily.note',
				'islate'
			)->leftjoin('students', 'student_has_record_daily.student_id', 'students.id')
			->leftjoin('levels', 'student_has_record_daily.level_id', 'levels.id')
			->orderby('levels.id', 'ASC')
			->orderby('full_name', 'ASC')
			->get();

		$absents = StudentHasRecordDaily::where($where)
			->whereNull('present_time')
			->select(
				'full_name',
				'student_id',
				'levels.title as teacher_room',
				'students.gender',
				'student_has_record_daily.id',
				'student_has_record_daily.note',
				'islate'
			)->leftjoin('students', 'student_has_record_daily.student_id', 'students.id')
			->leftjoin('levels', 'student_has_record_daily.level_id', 'levels.id')
			->orderby('levels.id', 'ASC')
			->orderby('full_name', 'ASC')
			->get();

		return view('record.day.index', compact('presents', 'absents', 'recorddaily', 'title'));
	}

	public function recordMonthAbsent($month)
	{

		$loggedUser = auth()->user();
		if ($loggedUser->user_type != 'admin') {
			if ($loggedUser->user_type == 'male_moderator') {
				$absents = StudentHasRecordDaily::groupBy('student_id', 'students.full_name')
					->select('student_id', 'students.full_name', DB::raw('count(student_id) as absent_times'))
					->leftjoin('students', 'student_has_record_daily.student_id', 'students.id')
					->where(['month' => $month, 'present_time' => null, 'students.gender' => 'm'])
					->orderby('absent_times', 'DESC')
					->get();
			} else {
				$absents = StudentHasRecordDaily::groupBy('student_id', 'students.full_name')
					->select('student_id', 'students.full_name', DB::raw('count(student_id) as absent_times'))
					->leftjoin('students', 'student_has_record_daily.student_id', 'students.id')
					->where(['month' => $month, 'present_time' => null, 'students.gender' => 'f'])
					->orderby('absent_times', 'DESC')
					->get();
			}
		} else {
			$absents = StudentHasRecordDaily::groupBy('student_id', 'students.full_name')
				->select('student_id', 'students.full_name', DB::raw('count(student_id) as absent_times'))
				->leftjoin('students', 'student_has_record_daily.student_id', 'students.id')
				->where(['month' => $month, 'present_time' => null, 'students.gender' => 'f'])
				->orderby('absent_times', 'DESC')
				->get();
		}

		return view('record.month.absent', compact('absents', 'month'));
	}

	public function recordDailyCreate(Workperiod $workperiod)
	{

		$recorddailies = Recorddaily::where('workperiod_id', $workperiod->id)
			->orderby('id', 'DESC')->limit(3)->get();

		$levels = $workperiod->levelHasWorkperiods()->get();

		$alreadyOpened = Recorddaily::where('workperiod_id', $workperiod->id)
			->whereDate('created_at', date('Y-m-d'))->first();

		$users = DB::table('user_has_workperiod')
			->select('users.id', 'users.full_name')
			->join('users', 'user_has_workperiod.user_id', '=', 'users.id')
			->where([
				'users.active' => 1,
				'user_has_workperiod.workperiod_id' => $workperiod->id
			])
			->whereNot('users.user_type', 'admin')
			->get();


		return view('admin.record.daily.create', compact('recorddailies', 'workperiod', 'levels', 'alreadyOpened', 'users'));
	}

	public function recordDailyIndex($year = '')
	{

		$createdAtDates = Recorddaily::select(DB::Raw('DISTINCT YEAR(created_at) as year'))->get();

		if ($year) {
			$recorddailies = Recorddaily::latest('id')
				->with('workperiod')
				->whereYear('created_at', $year)
				->get();
		} else {
			$recorddailies = Recorddaily::latest('id')
				->with('workperiod')
				->get();
		}

		return view('admin.record.daily.index', compact('recorddailies', 'createdAtDates'));
	}

	public function recordDailyDeleteAll(Request $request)
	{

		$ids = $request->recorddailys;

		if ($ids) {

			UserRecorddaily::whereIn('recorddaily_id', $ids)->delete();
			DB::table('student_has_record_daily')->whereIn('recorddaily_id', $ids)->delete();
			Recorddaily::whereIn('id', $ids)->delete();

			return back();
		}

		abort(404);
	}

	public function getUserNeedToBeStoreInRecorddaily()
	{
		$userWorkperiod = Helperfunction::getUserWorkperiod();
		return User::whereNotIn('id', [1, 8])
			->where('workperiod_id', $userWorkperiod->id)
			->get();
	}
	public function getLevelNeedToBeStoreInRecorddaily()
	{
		return Level::where('id', '>', 1)
			->get();
	}

	public function recordDailyTobeDelete(Recorddaily $recorddaily)
	{
		return view('admin.record.daily.tobedelete', compact('recorddaily'));
	}

	public function recordDailyDelete(Recorddaily $recorddaily)
	{
		$recorddaily->delete();

		StudentHasRecordDaily::where('recorddaily_id', $recorddaily->id)->delete();

		UserRecorddaily::where('recorddaily_id', $recorddaily->id)->delete();

		return redirect()->route('dashboard');
	}


	public function lateSearch(Request $request)
	{
		if ($request->method() == 'POST') {
			$request->validate([
				'datefrom' => 'required',
				'dateto' => 'required'
			]);

			// return $request->all();
			$datefrom = $request->datefrom;

			$dateto = $request->dateto;

			$userWorkperiod = Helperfunction::getUserWorkperiod();

			$loggedUser = auth()->user();

			$level_id = null;

			if ($loggedUser->user_type == 'male_teacher' || $loggedUser->user_type == 'female_teacher') {
				$level_id = $loggedUser->level_id;
			}

			if ($datefrom == $dateto) {

				$searchDate = 'مفتاح البحث ' . $datefrom . ' ' . $userWorkperiod->title;

				$students = $this->getLateStudents($datefrom, null, $userWorkperiod, $level_id);
			} else {

				$searchDate = 'مفتاح البحث من ' . $datefrom . ' إلى ' . $dateto . ' ' . $userWorkperiod->title;

				$students = $this->getLateStudents($datefrom, $dateto, $userWorkperiod, $level_id);
			}
		} else {
			$students = [];
			
			$searchDate = '';
		}


		return view('admin.record.daily.late_search', compact('students', 'searchDate'));
	}



	public function absentSearch(Request $request)
	{

		if ($request->method() == 'POST') {
			$request->validate([
				'datefrom' => 'required',
				'dateto' => 'required'
			]);

			// return $request->all();
			$datefrom = $request->datefrom;

			$dateto = $request->dateto;

			$userWorkperiod = Helperfunction::getUserWorkperiod();

			$loggedUser = auth()->user();

			$level_id = null;

			if ($loggedUser->user_type == 'male_teacher' || $loggedUser->user_type == 'female_teacher') {
				$level_id = $loggedUser->level_id;
			}

			if ($datefrom == $dateto) {

				$searchDate = 'مفتاح البحث ' . $datefrom . ' ' . $userWorkperiod->title;

				$students = $this->getApsentStudents($datefrom, null, $userWorkperiod, $level_id);
			} else {

				$searchDate = 'مفتاح البحث من ' . $datefrom . ' إلى ' . $dateto . ' ' . $userWorkperiod->title;

				$students = $this->getApsentStudents($datefrom, $dateto, $userWorkperiod, $level_id);
			}
		} else {
			$students = [];
			$searchDate = '';
		}

		return view('admin.record.daily.absent_search', compact('students', 'searchDate'));
	}


	public function recordDailyStore(Request $request, Workperiod $workperiod)
	{
		// return $workperiod;
		// return $request->all();
		$levels = $request->levels ? $request->levels : [];
		$userIds = $request->userIds;

		//if no user is selected
		if (!$userIds) {
			$userIds = User::where('workperiod_id', $workperiod->id)
				->where('user_type', '<>', 'admin')
				->pluck('id');
			// abort(403,'يجب إختيار الطاقم الإداري');
		}

		// if daily record is duplicated
		$today = Carbon::now()->toDateString();
		$lastRecordday = Recorddaily::where('workperiod_id', $workperiod->id)->first();
		if ($lastRecordday) {
			$createdAt = $lastRecordday->created_at->toDateString();
			if ($today == $createdAt) {
				abort(403, 'تم فتح السجل سابقا');
			}
		}

		$time = time();
		$thisDay = date('D', $time);
		$thisYear = date('Y', $time);
		$thisMonth = date('m', $time);

		// get student by level and workperiod
		$students = Student::where(['status' => 'active'])
			->whereIn('level_id', $levels)
			->get();

		if (!$request->ignore_workperiod) {

			//filter student by workperiod
			$students = $students->filter(function ($student) use ($workperiod) {
				return $student->workperiod_id == $workperiod->id;
			});
		}

		// create new daily record
		$recordDaily = Recorddaily::create(
			[
				'workperiod_id' => $workperiod->id,
				'title' => $request->title,
				'day' => $thisDay,
				'gender' => $workperiod->gender,
			]
		);

		if (!$request->ignore_day) {

			//filter student by study days: check each student if he study in this day (today).
			$students = $students->filter(function ($student) use ($thisDay) {
				return $student->checkHasWeekDay($thisDay);
			});
		}

		//add student to record
		foreach ($students as $student) {
			StudentHasRecordDaily::create([
				'year' => $thisYear,
				'month' => $thisMonth,
				'recorddaily_id' => $recordDaily->id,
				'student_id' => $student->id,
				'gender' => $student->gender,
				'level_id' => $student->level_id,
			]);
		}

		$users = User::whereIn('id', $userIds)->get();
		foreach ($users as $user) {

			if ($user->user_type == 'male_moderator' || $user->user_type == 'female_moderator') {
				$shouldBePresentAt = $workperiod->moderator_should_be_present_at;
			}
			if ($user->user_type == 'male_teacher' || $user->user_type == 'female_teacher') {
				$shouldBePresentAt = $workperiod->teacher_should_be_present_at;
			}

			UserRecorddaily::create([
				'recorddaily_id' => $recordDaily->id,
				'user_id' => $user->id,
				'gender' => $user->gender,
				'should_be_present_at' => $shouldBePresentAt,
			]);
		}

		return redirect()->route('dashboard');
	}

	public function removeStudentFromRecorddaily(StudentHasRecordDaily $studentHasRecordDaily)
	{
		$studentHasRecordDaily->delete();
		return redirect()->back()->with(['status' => 'success', 'message' => 'تم']);
	}


	/*---  absent  ---*/
	private function getApsentStudents($datefrom, $dateto, $userWorkperiod, $level_id)
	{

		if ($level_id) {
			$where = ['students.workperiod_id' => $userWorkperiod->id, 'students.level_id' => $level_id];
		} else {
			$where = ['students.workperiod_id' => $userWorkperiod->id];
		}

		$load = StudentHasRecordDaily::where(['present_time' => null])
			->join('students', 'student_has_record_daily.student_id', 'students.id')
			->where($where)
			->groupBy('student_has_record_daily.student_id', 'students.full_name')
			->select(
				'students.full_name',
				'student_has_record_daily.student_id',
				DB::raw("SUM(IF(student_has_record_daily.with_excuse = 0 , 1, 0)) as absent_without_excuse"),
				DB::raw("SUM(IF(student_has_record_daily.with_excuse = 1, 1, 0)) as absent_with_excuse")
			)
			->orderby('absent_without_excuse', 'desc');

		if ($dateto == null) {
			$load->whereDate('student_has_record_daily.updated_at', $datefrom);
		} else {
			$load->whereBetween('student_has_record_daily.updated_at', [$datefrom, $dateto]);
		}

		return $load->get();
	}

	/*---  late  ---*/
	private function getLateStudents($datefrom, $dateto, $userWorkperiod, $level_id)
	{

		if ($level_id) {
			$where = ['students.workperiod_id' => $userWorkperiod->id, 'students.level_id' => $level_id];
		} else {
			$where = ['students.workperiod_id' => $userWorkperiod->id];
		}

		$load = StudentHasRecordDaily::where('islate', 1)
			->whereNotNull('present_time')
			->join('students', 'student_has_record_daily.student_id', 'students.id')
			->where($where)
			->groupBy('student_has_record_daily.student_id')
			->select('student_has_record_daily.student_id', 'students.full_name', DB::raw("sum(islate) as lateTimes"))
			->orderby('lateTimes', 'desc');

		if ($dateto == null) {
			$load->whereDate('student_has_record_daily.updated_at', $datefrom);
		} else {
			$load->whereBetween('student_has_record_daily.updated_at', [$datefrom, $dateto]);
		}

		return $load->get();
	}
}
