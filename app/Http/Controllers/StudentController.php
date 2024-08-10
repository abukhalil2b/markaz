<?php

namespace App\Http\Controllers;

use App\Helper\Helperfunction;
use App\Models\Mark;
use App\Models\Mission;
use App\Models\Note;
use App\Models\Recorddaily;
use App\Models\Recordmonthly;
use App\Models\Student;
use App\Models\StudentHasMission;
use App\Models\StudentHasRecordDaily;
use App\Models\StudentMission;
use App\Models\Workperiod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class StudentController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	protected function getLogedUser()
	{
		return auth()->user();
	}

	protected function getLastRecordMonthly()
	{
		$record = new Recordmonthly();
		return $record->getLastRecord();
	}

	protected function getLastRecordDaily()
	{
		$record = new Recorddaily();
		return $record->getLastRecord();
	}

	public function search(Request $request)
	{

		$userWorkperiod = Helperfunction::getUserWorkperiod();

		$latestRecorddaily = Recorddaily::where('workperiod_id', $userWorkperiod->id)
			->latest('id')
			->first();

		if (!$latestRecorddaily) {
			abort(404, 'لايوجد سجل يومي');
		}

		$request->validate(['search' => 'required']);

		$userType = $request->user()->user_type;

		$userLevelID = $request->user()->level_id;

		$student = Student::select(
			'full_name',
			'levels.title as level_title',
			'students.id',
			'students.study_days',
			'students.status',
			'present_time',
			'students.level_id',
			'password',
			'user_type',
			'students.gender',
			'under_observation'
		)
			->where('student_has_record_daily.recorddaily_id', $latestRecorddaily->id)
			->join('student_has_record_daily', 'students.id', '=', 'student_has_record_daily.student_id')
			->join('levels', 'students.level_id', '=', 'levels.id');

		if ($userType == 'male_moderator') {
			$student = $student->where('students.gender', 'm');
		}

		if ($userType == 'female_moderator') {
			$student = $student->where('students.gender', 'f');
		}

		if ($userType == 'male_teacher') {
			$student = $student->where('students.gender', 'm')->where('students.level_id', $userLevelID);
		}

		if ($userType == 'female_teacher') {
			$student = $student->where('students.gender', 'f')->where('students.level_id', $userLevelID);
		}

		$students = $student->get();

		return view('student.index', compact('students', 'latestRecorddaily'));
	}

	public function index(Request $request)
	{

		$userWorkperiod = Helperfunction::getUserWorkperiod();

		$latestRecorddaily = Recorddaily::where('workperiod_id', $userWorkperiod->id)
			->latest('id')
			->first();

		if (!$latestRecorddaily) {
			die('لايوجد سجل يومي');
		}

		//whereFields :: admin
		$whereFields = ['students.status' => 'active', 'students.workperiod_id' => $userWorkperiod->id];

		$loggedUser = auth()->user();

		//whereFields :: male_moderator - female_moderator
		if ($loggedUser->user_type == 'male_moderator' || $loggedUser->user_type == 'female_moderator') {
			$whereFields = ['students.status' => 'active', 'students.workperiod_id' => $userWorkperiod->id];
		}

		//whereFields :: male_teacher - female_teacher
		if ($loggedUser->user_type == 'male_teacher' || $loggedUser->user_type == 'female_teacher') {
			$whereFields = ['students.status' => 'active', 'students.workperiod_id' => $userWorkperiod->id, 'students.level_id' => $loggedUser->level_id];
		}

		$studentHasRecordDailys = StudentHasRecordDaily::where('recorddaily_id', $latestRecorddaily->id)
			->select('id as student_has_record_daily_id', 'student_id', 'present_time', 'with_excuse', 'note')
			->get()->toArray();

		$students = Student::where($whereFields)
			->select(
				'full_name',
				'levels.title as level_title',
				'students.id',
				'students.study_days',
				'status',
				'students.level_id',
				'password',
				'user_type',
				'students.gender',
				'under_observation'
			)
			->join('levels', 'students.level_id', '=', 'levels.id');

		$search = $request->search;

		if ($search) {

			$students = $students->where(function ($q) use ($search) {
				$q->orWhere('students.id', 'LIKE', '%' . $search . '%')
					->orWhere('first_name', 'LIKE', '%' . $search . '%')
					->orWhere('second_name', 'LIKE', '%' . $search . '%')
					->orWhere('third_name', 'LIKE', '%' . $search . '%')
					->orWhere('last_name', 'LIKE', '%' . $search . '%')
					->orWhere('full_name', 'LIKE', '%' . $search . '%');
			});
		}

		$students = $students->get();

		$students = $students->map(function ($student) use ($studentHasRecordDailys) {
			$sObj = new stdClass;

			$sObj->id = $student->id;

			$sObj->full_name = $student->full_name;

			$sObj->level_title = $student->level_title;

			$sObj->study_days = $student->study_days;

			$sObj->status = $student->status;

			$sObj->level_id = $student->level_id;

			$sObj->password = $student->password;

			$sObj->user_type = $student->user_type;

			$sObj->gender = $student->gender;

			$sObj->under_observation = $student->under_observation;

			$studyDays = json_decode($student->study_days) ?? [];

			$sObj->is_study_day = in_array(date('D'), $studyDays);

			$sObj->record_daily = null;

			foreach ($studentHasRecordDailys as $shrd) {

				// check if record is avaliable
				if ($student->id == $shrd['student_id']) {
					$rdObj = new stdClass;
					// add record daily id
					$rdObj->id = $shrd['student_has_record_daily_id'];

					// add record note
					$rdObj->note = $shrd['note'];

					$rdObj->with_excuse = $shrd['with_excuse'];

					//check if absent
					if ($shrd['present_time'] == null) {
						$rdObj->present_time = null;
					} else {
						$rdObj->present_time = date('H:i', $shrd['present_time']);
					}
					$sObj->record_daily = $rdObj;
					break;
				}
			}

			return $sObj;
		});

		// return $students;

		return view('admin.student.index', compact('students', 'latestRecorddaily'));
	}

	public function studentFinalStore(Request $request)
	{

		$this->validate(
			$request,
			[
				'student_id' => 'required',
				'mission_id' => 'required',
			]
		);

		$missionId = $request->mission_id;

		$tobedone_at = ($request->time_days * 86400) + time() + ($request->time_minutes * 60);

		$mission = Mission::find($missionId);

		StudentHasMission::create([
			'mission_id' => $missionId,
			'student_id' => $request->student_id,
			'mission_title' => $mission->title,
			'mission_description' => $mission->note,
			'start_at' => time(),
			'tobedone_at' => $tobedone_at,
			'track_type' => 'final',
			'track_cate' => $mission->track_cate,
		]);

		return redirect()->route('admin.student.dashboard', ['student' => $request->student_id]);
	}

	public function dashboard(Student $student)
	{

		$studentMissions = StudentMission::where(['student_id' => $student->id, 'done_at' => NULL])->get();

		$newMissions = StudentHasMission::where('track_type', 'new')
			->where(['student_id' => $student->id, 'done_at' => NULL])
			->get();

		$hesasReviewMissions = StudentHasMission::where('track_type', 'review_hesas')
			->where(['student_id' => $student->id, 'done_at' => NULL])
			->get();

		$duaacateStudents = DB::table('duaacate_student')
			->select('duaacate_student.id', 'duaacates.title', 'duaacate_student.done_at', 'duaacates.duaacate_id')
			->join('duaacates', 'duaacate_student.duaacate_id', '=', 'duaacates.id')
			->where('student_id', $student->id)
			->get();


		return view('admin.student.dashboard', compact(
			'student',
			'newMissions',
			'hesasReviewMissions',
			'studentMissions',
			'duaacateStudents'
		));
	}

	public function studentMarkAddPointByTag(Student $student, $tag, $point)
	{
		$point = (int) $point;

		if ($point == null || $point == 0) {

			$marks = Mark::where(['student_id' => $student->id, 'tag' => $tag]);

			return view('admin.student.mark.add_point', compact('student', 'tag', 'marks'));
		}

		Helperfunction::createMark($tag, $point, $student->id);

		return redirect()->back();
	}

	public function studentMarkIndex(Student $student)
	{
		$marks = Mark::where('student_id', $student->id)
			->orderby('id', 'desc')
			->paginate(20);

		return view('admin.student.mark.index', compact('marks', 'student'));
	}

	public function studentMarkCreate(Student $student)
	{

		$marks = Mark::where(['student_id' => $student->id])
			// ->limit(30)
			->orderby('id', 'DESC')->paginate(50);

		return view('admin.student.mark.create', compact('marks', 'student'));
	}

	public function studentMarkStore(Request $request)
	{
		// return $request->all();

		$this->validate($request, ['point' => 'required']);

		Helperfunction::createMark($request->tag, $request->point, $request->student_id, $request->note);

		return redirect()->route('admin.student.mark.create', ['student' => $request->student_id])
			->with(['message' => 'تم', 'status' => 'success']);
	}

	public function studentNoteIndex(Student $student)
	{

		$notes = Note::where('student_id', $student->id)->get();

		return view('admin.student.note.index', compact('notes'));
	}

	public function studentNoteCreate(Student $student)
	{

		$notes = Note::where(['student_id' => $student->id])
			->latest('id')
			->get();

		return view('admin.student.note.create', compact('student', 'notes'));
	}

	public function studentNoteDelete(Note $note)
	{
		$note->delete();

		return back();
	}

	public function show(Student $student)
	{
		$student_has_missions = DB::table('student_has_mission')->where('student_id', $student->id)->get();

		$student_missions = DB::table('student_missions')
			->select('missions.id as mission_id','missions.title as mission_title', 'student_missions.start_at', 'missions.track_type')
			->join('missions', 'student_missions.mission_id', 'missions.id')
			->where('student_id', $student->id)->get();

		$semester_student_amount_to_pay_count = DB::table('semester_student_amount_to_pay')->where('student_id', $student->id)->count();
		return view('admin.student.show', compact(
			'student',
			'student_has_missions',
			'student_missions',
			'semester_student_amount_to_pay_count',
		));
	}

	public function studentEdit(Student $student)
	{
		$userType = $this->getLogedUser()->user_type;

		return view('admin.student.edit', compact('student', 'userType'));
	}

	public function studentUpdate(Request $request, Student $student)
	{
		$request->validate([
			'status' => 'required'
		]);

		// return $request->all();

		if ($student->status == 'waitingApproval') {
			return redirect()
				->back()
				->with(['status' => 'danger', 'message' => 'يجب أن يتم الإعتماد من قِبل الإدارة قبل التعديل']);
		}

		$student->update([
			"first_name" => $request->first_name,
			"second_name" => $request->second_name,
			"third_name" => $request->third_name,
			"last_name" => $request->last_name,
			"full_name" => $request->full_name,
			"status" => $request->status,
			"national_id" => $request->national_id,
			"note" => $request->note,
		]);

		if ($request->status == 'disabled') {

			$student->update(['level_id' => 1]);
		}

		return redirect()
			->route('admin.student.index');
	}

	public function studentNoteEdit(Note $note)
	{
		return view('admin.student.note.edit', compact('note'));
	}

	public function studentNoteUpdate(Request $request, Note $note)
	{

		$note->update([
			'title' => $request->title,
		]);

		return redirect()->route('admin.student.note.create', ['student' => $note->student_id]);
	}

	public function studentNoteStore(Request $request, Student $student)
	{
		$request->validate([
			'title' => 'required',
		]);

		Note::create([
			'title' => $request->title,
			'student_id' => $student->id,
			'level_id' => $student->level_id,
			'gender' => $student->gender,
			'user_id' => auth()->id(),
		]);

		return back();
	}

	//  all students
	public function showAllStudents()
	{

		$students = Student::select('full_name', 'first_name', 'second_name', 'third_name', 'last_name', 'levels.title as level_title', 'students.id', 'status', 'password', 'user_type', 'students.gender', 'under_observation')
			->join('levels', 'students.level_id', '=', 'levels.id')
			->get();

		return view('student.show_all_student', compact('students'));
	}

	public function searchAllStudents(Request $request)
	{

		//[ ] add permissions
		// return $request->all();
		$student = $request->student; //name of id
		$gender = $request->gender;
		$status = $request->status;

		$students = Student::select('full_name', 'first_name', 'second_name', 'third_name', 'last_name', 'levels.title as level_title', 'students.id', 'status', 'password', 'user_type', 'students.gender', 'under_observation')
			->join('levels', 'students.level_id', '=', 'levels.id');

		if ($student) {
			$students->where(function ($q) use ($student) {
				$q->orWhere('students.id', 'LIKE', '%' . $student . '%')
					->orWhere('first_name', 'LIKE', '%' . $student . '%')
					->orWhere('second_name', 'LIKE', '%' . $student . '%')
					->orWhere('third_name', 'LIKE', '%' . $student . '%')
					->orWhere('last_name', 'LIKE', '%' . $student . '%')
					->orWhere('full_name', 'LIKE', '%' . $student . '%');
			});
		}

		//gender male only
		if ($gender == 'm') {
			$students->where('students.gender', 'm');
		}

		//gender female only
		if ($gender == 'f') {
			$students->where('students.gender', 'f');
		}

		//status waiting approval only
		if ($status == 'waitingApproval') {
			$students->where('students.status', 'waitingApproval');
		}

		//status active only
		if ($status == 'active') {
			$students->where('students.status', 'active');
		}

		//status disabled only
		if ($status == 'disabled') {
			$students->where('students.status', 'disabled');
		}

		$students = $students->get();

		return view('student.show_all_student', compact('students'));
	}

	public function weekDaysUpdate(Request $request, Student $student)
	{
		if ($request->weekdays) {
			$student->update(['study_days' => $request->weekdays]);
		}
		return back()->with(['message' => 'تم', 'status' => 'success']);
	}

	public function attendanceStudentIndex(Recorddaily $recorddaily, Workperiod $workperiod)
	{
		// return $recorddaily;
		$title = $recorddaily->created_at->toDateString() . ' الحضور والغياب ';

		$loggedUser = auth()->user();
		//show for teachers 
		if ($loggedUser->user_type == 'male_teacher' || $loggedUser->user_type == 'female_teacher') {
			//show for moderators
			$studentHasRecordDailys = DB::table('student_has_record_daily')
				->where([
					'recorddaily_id' => $recorddaily->id,
					'student_has_record_daily.level_id' => $loggedUser->level_id,
				])
				->select('student_has_record_daily.id', 'student_has_record_daily.student_id', 'students.first_name', 'students.last_name', 'student_has_record_daily.present_time', DB::raw("IF(student_has_record_daily.present_time,true,false) as present"))
				->join('students', 'student_has_record_daily.student_id', 'students.id')
				->orderby('students.id', 'ASC')
				->get()
				->toArray();
		} else {
			//show for moderators
			$studentHasRecordDailys = DB::table('student_has_record_daily')
				->where([
					'recorddaily_id' => $recorddaily->id,
				])
				->select('student_has_record_daily.id', 'student_has_record_daily.student_id', 'students.first_name', 'students.last_name', 'student_has_record_daily.present_time', DB::raw("IF(student_has_record_daily.present_time,true,false) as present"))
				->join('students', 'student_has_record_daily.student_id', 'students.id')
				->orderby('students.id', 'ASC')
				->get()
				->toArray();
		}



		$studentHasRecordDailys = json_encode($studentHasRecordDailys);

		return view('student.attendance.student_index', compact('studentHasRecordDailys', 'recorddaily', 'title', 'workperiod'));
	}
}
