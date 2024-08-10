<?php

namespace App\Http\Controllers;

use App\Helper\Helperfunction;
use App\Models\DailyEvaluation;
use App\Models\Mark;
use App\Models\Student;
use App\Models\StudentMissionTask;
use App\Models\Workperiod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentMissionTaskController extends Controller
{

	public function studentMissionTaskCount(Request $request)
	{
		$loggedUser = auth()->user();

		$workperiod = Workperiod::findOrFail($loggedUser->workperiod_id);

		$date = date('Y-m-d');

		$datefrom = $request->datefrom;

		$dateto = $request->dateto;

		$info = '';

		$countDoneStudentTasks = [];

		$countNotDoneStudentTasks = [];

		if ($request->isMethod('GET')) {

			$info = 'تم عرض النتائج حسب تاريخ: ' . $date . ' والفترة: ' . $workperiod->title;

			$countDoneStudentTasks = $this->getCountDoneStudentMissionTask($loggedUser, $workperiod, $date, null, null);
		} else {

			$info = 'تم عرض النتائج من تاريخ: ' . $datefrom . ' إلى ' . $dateto . ' والفترة: ' . $workperiod->title;

			$request->validate([
				'datefrom' => 'required|date',
				'dateto' => 'required|date',
			]);

			$countDoneStudentTasks = $this->getCountDoneStudentMissionTask($loggedUser, $workperiod, null, $datefrom, $dateto);

			$countNotDoneStudentTasks = $this->getCountNotDoneStudentMissionTask($loggedUser, $workperiod, $countDoneStudentTasks);
		}

		return view('admin.student_mission_task.count', compact('countDoneStudentTasks', 'countNotDoneStudentTasks', 'info'));
	}


	public function show(StudentMissionTask $studentMissionTask)
	{
		$student = Student::find($studentMissionTask->student_id);

		//for updating
		$evaluations = ['تفوق عالٍ', 'ممتاز', 'جيد جدا', 'جيد'];

		$mark = Mark::where('student_mission_task_id', $studentMissionTask->id)->first();

		return view('admin.student.mission.task.show', compact('studentMissionTask', 'evaluations', 'mark', 'student'));
	}

	public function update(Request $request, StudentMissionTask $studentMissionTask)
	{
		//--- Need to update 3 tables ---//

		$mark = Mark::where('student_mission_task_id', $studentMissionTask->id)->first();

		//mark table
		if ($mark) {
			if ($request->point != $mark->point) {
				$mark->update(['point' => $request->point]);
			}
		} else {
			// add new point to student
			if ($request->point > 0) {
				Mark::create([
					'student_id' => $studentMissionTask->student_id,
					'tag' => 'missionTask',
					'point' => $request->point,
					'student_mission_task_id' => $studentMissionTask->id,
				]);
			}
		}

		//FIRST: update daily evaluation
		if ($studentMissionTask->evaluation != $request->evaluation) {

			DailyEvaluation::where([
				'model_type' => 'student_mission_task',
				'model_id' => $studentMissionTask->id,
			])
				->whereNotIn('evaluation', ['أنجز نصف المهمة', 'مجاز', 'لم يجز'])
				->update([
					'evaluation' => $request->evaluation,
				]);
		}

		//SECOND: update student_mission_task table
		$studentMissionTask->update([
			'note' => $request->note,
			'evaluation' => $request->evaluation,
		]);

		return redirect()->route('admin.student.task.dashboard', $studentMissionTask->student_mission_id);
	}

	public function updatePassReading(StudentMissionTask $studentMissionTask, $status)
	{

		$studentMissionTask->update([
			'pass_reading' => $status,
		]);

		if ($status == 'pass') {
			$evaluation = 'مجاز';
		}

		if ($status == 'not-pass') {
			$evaluation = 'لم يجز';
		}

		$student = Student::find($studentMissionTask->student_id);

		Helperfunction::DailyEvaluationStore($student->level_id, $student->id, $student->full_name, $evaluation, $studentMissionTask->descr, 'student_mission_task', $studentMissionTask->id);


		return back();
	}

	public function updateFreeText(StudentMissionTask $studentMissionTask)
	{
		$studentMissionTask->update([
			'pass_reading' => 'pass',
			'done_at' => date('Y-m-d H:i:s'),
			'evaluatedby_name'=>auth()->user()->full_name
		]);

		return back();
	}

	public function delete(StudentMissionTask $studentMissionTask)
	{
		//FIRST: delete Mark
		Mark::where('student_mission_task_id', $studentMissionTask->id)->delete();

		//SECOND: delete DailyEvaluation
		DailyEvaluation::where([
			'model_type' => 'student_mission_task',
			'model_id' => $studentMissionTask->id,
		])
			->whereNotIn('evaluation', ['أنجز نصف المهمة', 'مجاز', 'لم يجز'])
			->delete();

		//FINALY: update student_mission_task table
		$studentMissionTask->update([
			'done_at' => NULL,
			'evaluation' => NULL,
			'note' => NULL,
			'pass_reading' => NULL,
			'wrongs' => NULL,
			'half_done_at' => NULL,
		]);

		return redirect()->route('admin.student.task.dashboard', $studentMissionTask->student_mission_id);
	}


	private function getCountDoneStudentMissionTask($loggedUser, $workperiod, $date, $datefrom, $dateto)
	{

		$where = ['students.workperiod_id' => $workperiod->id];

		if ($loggedUser->user_type == 'male_teacher' || $loggedUser->user_type == 'female_teacher') {

			$where = ['students.workperiod_id' => $workperiod->id, 'level_id' => $loggedUser->level_id];
		}

		$load = DB::table('student_mission_tasks')
			->select(
				'student_mission_tasks.student_id',
				'students.full_name',
				DB::raw('COUNT(student_id) as evaluationCount')
			)
			->where($where)
			->whereNotIn('select_type', ['freeText','duaa'])
			->groupby('student_mission_tasks.student_id')
			->orderby('evaluationCount', 'DESC')
			->join('students', 'student_mission_tasks.student_id', '=', 'students.id');

		if ($date) {
			$load->where('done_at', $date);
		} elseif ($datefrom && $dateto) {
			$load->whereBetween('done_at', [$datefrom, $dateto]);
		}

		return $load->get();
	}

	private function getCountNotDoneStudentMissionTask($loggedUser, $workperiod, $countDoneStudentTasks)
	{

		$where = ['workperiod_id' => $workperiod->id, 'status' => 'active'];

		if ($loggedUser->user_type == 'male_teacher' || $loggedUser->user_type == 'female_teacher') {

			$where = ['workperiod_id' => $workperiod->id, 'status' => 'active', 'level_id' => $loggedUser->level_id];
		}

		$taskDoneStudentIds = $countDoneStudentTasks->map(fn ($s) => $s->student_id);

		return Student::whereNotIn('id', $taskDoneStudentIds)
			->where($where)
			->get();
	}
}
