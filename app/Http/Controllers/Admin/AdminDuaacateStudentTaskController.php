<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DailyEvaluation;
use App\Models\Mark;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Workperiod;
use stdClass;

class AdminDuaacateStudentTaskController extends Controller
{

	public function dashboard($duaacate_student_id)
	{
		//mission was given to a student
		$duaacateStudent = DB::table('duaacate_student')
			->where('id', $duaacate_student_id)
			->first();

		if (!$duaacateStudent) {
			abort(403);
		}

		$student = Student::where('id', $duaacateStudent->student_id)->first();

		//tasks which is related to this mission
		$duaacate_tasks = DB::table('duaacate_tasks')
			->where('duaacate_tasks.duaacate_id', $duaacateStudent->duaacate_id)
			->get();

		//tasks which is done by student
		$duaacate_student_tasks = DB::table('duaacate_student_task')
			->where('duaacate_student_id', $duaacateStudent->id)
			->get();

		$maped_duaacate_student_tasks = $duaacate_tasks->map(function ($duaacate_task) use ($duaacate_student_tasks) {
			$t = new stdClass;

			$t->duaacate_task_id = $duaacate_task->id;

			$t->title = $duaacate_task->title;

			$t->content = $duaacate_task->content;

			$t->duaacate_student_task_id = null;

			$t->done = false;

			$t->done_at = NULL;

			$t->numwrong = 0;

			$t->evaluation = NULL;

			$t->note = NULL;

			$t->duaacate_student_task_id = NULL;

			if (count($duaacate_student_tasks) > 0) {
				$t->done = false;

				foreach ($duaacate_student_tasks as $duaacate_student_task) {

					if ($duaacate_student_task->duaacate_task_id == $duaacate_task->id) {
						$t->done = true;

						$t->duaacate_student_task_id = $duaacate_student_task->id;

						$t->done_at = $duaacate_student_task->done_at;

						$t->numwrong = $duaacate_student_task->numwrong;

						$t->evaluation = $duaacate_student_task->evaluation;

						$t->note = $duaacate_student_task->note;

						$t->duaacate_student_task_id = $duaacate_student_task->id;
						break;
					}
				}
			}

			return $t;
		});

		$lastNotDoneDuaacateTask = $maped_duaacate_student_tasks->filter(fn ($maped_dst) => $maped_dst->done == false)->first();

		// return $lastNotDoneDuaacateTask;

		// get taskCount
		$duaacate_task_count = count($duaacate_tasks);
		return view('admin.duaacate_student_task.dashboard', compact('duaacateStudent', 'lastNotDoneDuaacateTask', 'maped_duaacate_student_tasks', 'duaacate_task_count', 'student'));
	}

	public function show($duaacate_student_task_id)
	{

		$duaacate_student_task = DB::table('duaacate_student_task')
			->select(
				'duaacate_task_id',
				'duaacate_tasks.title',
				'duaacate_tasks.content',
				'duaacate_student_task.id as duaacate_student_task_id',
				'duaacate_student_task.numwrong',
				'duaacate_student_task.evaluation',
				'duaacate_student_task.done_at',
				'duaacate_student_task.note',
			)
			->where('duaacate_student_task.id', $duaacate_student_task_id)
			->join('duaacate_tasks', 'duaacate_student_task.duaacate_task_id', '=', 'duaacate_tasks.id')
			->first();

		if (!$duaacate_student_task) {
			abort(404);
		}

		$mark = Mark::where('duaacate_student_task_id', $duaacate_student_task_id)->first();

		// return $task;
		return view('admin.duaacate_student_task.show', compact('duaacate_student_task_id', 'duaacate_student_task', 'mark'));
	}

	public function store(Request $request)
	{
		// return $request->all();

		$duaacateStudentTask = DB::table('duaacate_student_task')
			->where(['duaacate_task_id' => $request->duaacate_task_id, 'duaacate_student_id' => $request->duaacate_student_id])
			->first();

		if (!$duaacateStudentTask) {

			$duaacate_student_task_id = DB::table('duaacate_student_task')
				->insertGetId([
					'duaacate_student_id' => $request->duaacate_student_id,

					'duaacate_task_id' => $request->duaacate_task_id,

					'numwrong' => $request->wrongs ? count(json_decode($request->wrongs)) : 0,

					'evaluation' => $request->evaluation,

					'evaluatedby_name'=>auth()->user()->full_name,

					'done_at' => date('Y-m-d'),

					'note' => $request->note,
				]);

			$duaacate_student = DB::table('duaacate_student')
				->where('id', $request->duaacate_student_id)
				->first();

			//add point
			if ($request->point > 0) {

				Mark::create([
					'student_id' => $duaacate_student->student_id,
					'tag' => 'duaacateTask',
					'duaacate_student_task_id' => $duaacate_student_task_id,
					'point' => $request->point,
				]);
			}

			$student = Student::find($duaacate_student->student_id);

			$duaacate_task = DB::table('duaacate_tasks')
				->where('id', $request->duaacate_task_id)
				->first();

			//daily evaluation
			DailyEvaluation::create([
				'level_id' => auth()->user()->level_id,
				'student_id' => $student->id,
				'evaluation' => $request->evaluation,
				'full_name' => $student->full_name,
				'descr' => $duaacate_task->title,
				'model_type' => 'duaacate_student_task',
				'model_id' => $duaacate_student_task_id,
			]);
		}

		return back();
	}

	public function delete($duaacate_student_task_id)
	{

		$duaacate_student_task = DB::table('duaacate_student_task')
			->where('duaacate_student_task.id', $duaacate_student_task_id)
			->first();

		if (!$duaacate_student_task) {
			abort(404);
		}

		DB::table('duaacate_student_task')
			->where('duaacate_student_task.id', $duaacate_student_task_id)
			->delete();

		Mark::where('duaacate_student_task_id', $duaacate_student_task_id)
			->delete();

		DailyEvaluation::where([
			'model_type' => 'duaacate_student_task',
			'model_id' => $duaacate_student_task->id,
		])
			->whereNotIn('evaluation', ['أنجز نصف المهمة', 'مجاز', 'لم يجز'])
			->delete();

		return redirect()->route('admin.duaacate_student_task.dashboard', $duaacate_student_task->duaacate_student_id);
	}


	public function duaacateStudentTaskCount(Request $request)
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

			$countDoneStudentTasks = $this->getCountDoneDuaacateStudentTask($loggedUser, $workperiod, $date, null, null);
		} else {

			$info = 'تم عرض النتائج من تاريخ: ' . $datefrom . ' إلى ' . $dateto . ' والفترة: ' . $workperiod->title;

			$request->validate([
				'datefrom' => 'required|date',
				'dateto' => 'required|date',
			]);

			$countDoneStudentTasks = $this->getCountDoneDuaacateStudentTask($loggedUser, $workperiod, null, $datefrom, $dateto);

			$countNotDoneStudentTasks = $this->getCountNotDoneDuaacateStudentTask($loggedUser, $workperiod, $countDoneStudentTasks);
		}

		return view('admin.duaacate_student_task.count', compact('countDoneStudentTasks', 'countNotDoneStudentTasks', 'info'));
	}

// student_id 148
	private function getCountDoneDuaacateStudentTask($loggedUser, $workperiod, $date, $datefrom, $dateto)
	{

		$where = ['students.workperiod_id' => $workperiod->id];

		if ($loggedUser->user_type == 'male_teacher' || $loggedUser->user_type == 'female_teacher') {

			$where = ['students.workperiod_id' => $workperiod->id, 'level_id' => $loggedUser->level_id];
		}

		$load = DB::table('duaacate_student_task')
			->select(
				'students.id as student_id',
				'students.full_name',
				DB::raw('COUNT(students.id) as evaluationCount')
			)
			->where($where)
			->whereIn('evaluation',['ممتاز','تفوق عالٍ','جيد جدا','جيد'])
			->groupby('students.id')
			->orderby('evaluationCount', 'DESC')
			->join('duaacate_student', 'duaacate_student_task.duaacate_student_id', '=', 'duaacate_student.id')
			->join('students', 'duaacate_student.student_id', '=', 'students.id');

		if ($date) {
			$load->where('duaacate_student_task.done_at', $date);
		} elseif ($datefrom && $dateto) {
			$load->whereBetween('duaacate_student_task.done_at', [$datefrom, $dateto]);
		}

		return $load->get();
	}

	private function getCountNotDoneDuaacateStudentTask($loggedUser, $workperiod, $countDoneStudentTasks)
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
