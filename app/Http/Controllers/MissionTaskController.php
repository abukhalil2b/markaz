<?php

namespace App\Http\Controllers;

use App\Models\DailyEvaluation;
use App\Models\LastStudentMissionTask;
use App\Models\Mark;
use App\Models\Mission;
use App\Models\MissionTask;
use App\Models\Student;
use App\Models\StudentHasMission;
use App\Models\StudentMission;
use App\Models\StudentMissionTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MissionTaskController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function studentMissionCreate(Student $student, Mission $mission)
	{
		$missionTasks = MissionTask::where('mission_id', $mission->id)
			->orderby('task_order', 'ASC')
			->get();

		return view('admin.student.mission.create', compact('missionTasks', 'student', 'mission'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function studentMissionIndex(Student $student)
	{
		$missions = Mission::where('track_type', 'new')
			->get();

		return view('admin.student.mission.index', compact('missions'));
	}

	public function dashboard(StudentMission $studentMission)
	{
		// return $studentMission;
		// $missionTasks = MissionTask::where('mission_id',$studentMission->mission_id)->get();

		// return $missionTasks->first();
		$studentMissionTasks = DB::table('student_mission_tasks')
			->orderby('task_order', 'ASC')
			->where('student_mission_id', $studentMission->id)
			->get();

		//if student has done all his tasks, this query will return null.
		$studentMissionTask = DB::table('student_mission_tasks')
			->where([
				'student_mission_id' => $studentMission->id,
				'done_at' => NULL,
			])
			->orderBy('task_order', 'ASC')
			->first();
		
		$student = Student::findOrFail($studentMission->student_id);

		return view('admin.student.mission.task.dashboard', compact('student', 'studentMission', 'studentMissionTask', 'studentMissionTasks'));
	}

	public function createNew(StudentMissionTask $studentMissionTask)
	{

		return view('admin.student.mission.task.create_new', compact('studentMissionTask'));
	}

	public function storeNew(Request $request, StudentMissionTask $studentMissionTask)
	{
		$request->validate([
			'descr' => 'required',
		]);

		// return $studentMissionTask->task_order;
		$studentMissionTasks = DB::table('student_mission_tasks')
			->where('task_order', '>', $studentMissionTask->task_order)
			->where('student_mission_id', $studentMissionTask->student_mission_id)
			->get();

		DB::table('student_mission_tasks')->insert([
			'student_id' => $studentMissionTask->student_id,
			'student_mission_id' => $studentMissionTask->student_mission_id,
			'mission_type' => $studentMissionTask->mission_type,
			'select_type' => $studentMissionTask->select_type,
			'descr' => $request->descr,
			'task_order' => $studentMissionTask->task_order + 1,
		]);

		foreach ($studentMissionTasks as $studentMissionTask) {

			DB::table('student_mission_tasks')->where([
				'id' => $studentMissionTask->id,
			])->update([
				'task_order' => $studentMissionTask->task_order + 1,
			]);
		}

		return redirect()->route('admin.student.task.dashboard', $studentMissionTask->student_mission_id);
	}

	public function halfDoneEdit(StudentMissionTask $studentMissionTask)
	{
		return view('admin.student.mission.task.half_done_edit', compact('studentMissionTask'));
	}

	public function halfDoneUpdate(StudentMissionTask $studentMissionTask)
	{
		$student = Student::find($studentMissionTask->student_id);

		$studentMissionTask->update([
			'half_done_at' => date('Y-m-d'),
			'evaluation'=>'أنجز نصف المهمة',
			'note'=>'أنجز نصف المهمة'
		]);

		DailyEvaluation::create([
			'student_id' => $student->id,
			'level_id' => $student->level_id,
			'evaluation' => 'أنجز نصف المهمة',
			'full_name' => $student->full_name,
			'descr' => $studentMissionTask->descr,
			'model_type' => 'student_mission_task',
			'model_id' => $studentMissionTask->id,
		]);

		return redirect()->route('admin.student.task.dashboard', $studentMissionTask->student_mission_id);
	}

	public function quran(StudentMissionTask $studentMissionTask)
	{
		$ayats = [];

		if ($studentMissionTask->select_type == 'oneSurat') {
			$surat_id = $studentMissionTask->surat_id;

			$ayats = DB::connection('secondDB')->table('quran_ayas')->where('quran_surat_id', $surat_id)->get();
		}

		if ($studentMissionTask->select_type == 'suratToSurat') {

			$from_surat_id = $studentMissionTask->from_surat_id;
			$to_surat_id = $studentMissionTask->to_surat_id;

			$ayats = DB::connection('secondDB')->table('quran_ayas')->whereBetween('quran_surat_id', [$from_surat_id, $to_surat_id])
				->get();
		}

		if ($studentMissionTask->select_type == 'onePage') {
			$page_number = $studentMissionTask->page_number;
			$ayats = DB::connection('secondDB')->table('quran_ayas')->where('page_number', $page_number)->get();
		}
		return view('admin.student.mission.task.quran', compact('ayats'));
	}

	public function store(Request $request)
	{
		$loggedUser = auth()->user();

		// return $request->all();

		$studentMissionTask = DB::table('student_mission_tasks')
			->where('id', $request->student_mission_task_id)
			->first();

		$student = Student::find($studentMissionTask->student_id);

		if ($request->evaluation == 'لم ينجح') {
			DB::table('student_mission_tasks')
				->where('id', $request->student_mission_task_id)
				->update([
					'done_at' => NULL,
					'evaluation' => $request->evaluation,
					'evaluatedby_name'=>auth()->user()->full_name,
					'note' => "لم ينجح \n" . $request->note,
					'wrongs' => $request->wrongs,
				]);
		} else {

			DB::table('student_mission_tasks')
				->where('id', $request->student_mission_task_id)
				->update([
					'half_done_at' => null,
					'done_at' => date('Y-m-d H:i:s', time()),
					'evaluation' => $request->evaluation,
					'evaluatedby_name'=>auth()->user()->full_name,
					'note' => $request->note,
					'wrongs' => $request->wrongs,
				]);
		}

		if ($request->point > 0) {
			Mark::create([
				'student_id' => $student->id,
				'tag' => 'missionTask',
				'point' => $request->point,
				'student_mission_task_id' => $request->student_mission_task_id,
			]);
		}

		DailyEvaluation::create([
			'level_id' => $loggedUser->level_id,
			'student_id' => $student->id,
			'evaluation' => $request->evaluation,
			'full_name' => $student->full_name,
			'descr' => $studentMissionTask->descr,
			'model_type' => 'student_mission_task',
			'model_id' => $studentMissionTask->id,
		]);

		$lastStudentMissionTask = LastStudentMissionTask::where('student_id', $studentMissionTask->student_id)->first();

		if ($lastStudentMissionTask) {

			$lastStudentMissionTask->update([
				'student_mission_task_id' => $studentMissionTask->id,
				'descr' => $studentMissionTask->descr,
				'evaluation' => $request->evaluation,
				'evaluatedby_name'=>auth()->user()->full_name,
				'wrongs' => $request->wrongs,
				'note' => $request->note,
				'done_at' => date('Y-m-d H:i:s'),
				'point' => $request->point,
			]);
		} else {

			LastStudentMissionTask::create([
				'student_id' => $student->id,
				'student_name' => $student->full_name,
				'level_id' => $student->level_id,
				'workperiod_id' => $student->workperiod_id,
				'student_mission_task_id' => $studentMissionTask->id,
				'descr' => $studentMissionTask->descr,
				'evaluation' => $request->evaluation,
				'wrongs' => $request->wrongs,
				'note' => $request->note,
				'done_at' => date('Y-m-d H:i:s'),
				'point' => $request->point,
			]);
		}

		// return $studentMissionTask;
		return back();
	}
}
