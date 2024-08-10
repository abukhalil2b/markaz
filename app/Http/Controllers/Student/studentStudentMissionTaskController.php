<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\StudentMission;
use App\Models\StudentMissionTask;
use Illuminate\Support\Facades\DB;

class studentStudentMissionTaskController extends Controller {
	public function studentMissionTaskIndex(StudentMission $studentMission) {
		$student = auth()->user();

		//studentMissions
		$studentMissionTasks = DB::table('student_mission_tasks')
        ->orderby('task_order','ASC')
            ->where('student_mission_id', $studentMission->id)
            ->get();

		// return $studentMissionTasks;
		return view('student.dashboard.student_mission_task.index', compact('student', 'studentMissionTasks'));
	}

	public function show(StudentMissionTask $studentMissionTask)
    {
		$student = auth()->user();

		$level = Level::findOrFail($student->level_id);

        return view('student.mission.task.show', compact('studentMissionTask','student','level'));
    }

}
