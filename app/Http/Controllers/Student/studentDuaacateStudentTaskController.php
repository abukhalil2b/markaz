<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use Illuminate\Support\Facades\DB;
use stdClass;

class studentDuaacateStudentTaskController extends Controller
{

    public function index($duaacate_student_id)
    {
        //mission was given to a student
		$duaacateStudent = DB::table('duaacate_student')
        ->where('id', $duaacate_student_id)
        ->first();

    if (!$duaacateStudent) {
        abort(403);
    }

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

    $lastNotDoneDuaacateTask = $maped_duaacate_student_tasks->filter(fn($maped_dst) => $maped_dst->done == false)->first();

    // return $lastNotDoneDuaacateTask;

    // get taskCount
    $duaacate_task_count = count($duaacate_tasks);
    return view('student.dashboard.duaacate_student_task.index', compact('duaacateStudent', 'lastNotDoneDuaacateTask', 'maped_duaacate_student_tasks', 'duaacate_task_count'));
    }
    
    public function show($duaacate_student_task_id) {
		$duaacate_student_task = DB::table('duaacate_student_task')
			->where('id', $duaacate_student_task_id)
			->first();

		if (!$duaacate_student_task) {
			abort(404);
		}

		$duaacate_task = DB::table('duaacate_tasks')
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
			->where('duaacate_tasks.id', $duaacate_student_task->duaacate_task_id)
			->join('duaacate_student_task', 'duaacate_tasks.id', '=', 'duaacate_student_task.duaacate_task_id')
			->first();

		if (!$duaacate_task) {
			abort(404);
		}

		$mark = Mark::where('duaacate_student_task_id', $duaacate_student_task_id)->first();

		// return $task;
		return view('student.dashboard.duaacate_student_task.show', compact('duaacate_task', 'duaacate_student_task_id', 'mark'));
	}
}
