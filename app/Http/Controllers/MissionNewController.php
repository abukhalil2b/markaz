<?php
namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Student;
use App\Models\StudentHasMission;
use App\Models\StudentNewSowar;
use App\Models\StudentReviewSowar;
use Illuminate\Http\Request;

class MissionNewController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	public function multiMissionNewTaskShow($student_id, $mission_id) {
		$mission = StudentHasMission::orderBy('id', 'desc')
			->where(['student_id' => $student_id, 'mission_id' => $mission_id])
			->first();
		if (!$mission) {
			die('wrong mission id');
		}
		if ($mission->done) {
			return redirect()->back()->with(['status' => 'تم انهاء المهمة']);
		}

		
		$user = auth()->user();
		$student = Student::where(['id' => $student_id])->where('level_id', '<>', 1)->first();

		if (!$student) {
			die('student must be in a level');
		}
		//last 10 reports
		$reports = Report::where(['student_id' => $student_id, 'mission_id' => $mission_id, 'onesowar' => 0, 'done' => 0])
			->orderBy('id', 'desc')
			->limit(10)->get();
		$studentNewSowars = StudentNewSowar::where(['mission_id' => $mission_id, 'student_id' => $student_id, 'done' => 0])
			->select(
				'student_has_new_sowars.id',
				'sowars.id as sowar_id',
				'student_id',
				'mission_id',
				'mission_title',
				'done_at',
				'done',
				'thomon_num',
				'student_has_new_sowars.ayat',
				'title')
			->leftjoin('sowars', 'student_has_new_sowars.sowar_id', 'sowars.id')->get();

		return view('student.multi_mission.new.task_show',
			compact('student', 'reports', 'studentNewSowars', 'mission_id', 'user'));

	}

	public function multiMissionNewTaskCreate($student_id, $has_sowar_id) {



		$user = auth()->user();
		$student = Student::where(['id' => $student_id])->where('level_id', '<>', 1)->first();

		if (!$student) {
			die('student must be in a level');
		}
		$studentNewSowars = StudentNewSowar::find($has_sowar_id);
		return view('student.multi_mission.new.task_create',
			compact('student', 'studentNewSowars', 'user'));

	}
	public function multiMissionNewTaskStore(Request $request) {
		// return $request->all();
		$whole = (int) $request->whole;
		$this->validate($request,
			['sowar_id' => 'required', 'user_id' => 'required', 'student_id' => 'required', 'has_sowar_id' => 'required']
		);
		if (!$whole) {
			$request->ayafrom;
			$request->ayato;
			$this->validate($request, ['ayafrom' => 'required', 'ayato' => 'required']);
		}

		$request['tobedone_at'] = ($request->time_days * 86400) + time() + ($request->time_minutes * 60);
		Report::create($request->all());
		return redirect()
			->route('student.multi_mission.new.task_show', ['student_id' => $request->student_id, 'mission_id' => $request->mission_id])
			->with(['status' => 'تم']);

	}

}
