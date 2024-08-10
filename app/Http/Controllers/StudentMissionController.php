<?php

namespace App\Http\Controllers;

use App\Models\StudentMission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentMissionController extends Controller
{

    public function toggleDone(StudentMission $studentMission)
    {
        if ($studentMission->done_at) {

            $studentMission->update([
                'done_at' => NULL,
            ]);
        } else {

            $studentMission->update([
                'done_at' => date('Y-m-d'),
            ]);
        }

        return redirect()->route('admin.student.dashboard', $studentMission->student_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentMission  $studentMission
     * @return \Illuminate\Http\Response
     */
    public function show(StudentMission $studentMission)
    {
        $studentMissionTasks = DB::table('student_mission_tasks')
            ->select(
                'student_mission_tasks.done_at',
                'student_mission_tasks.evaluation',
                'student_mission_tasks.task_order',
                'student_mission_tasks.mission_type',
                'student_mission_tasks.descr',
                'student_mission_tasks.wrongs',
                'student_mission_tasks.note',
                'marks.point'
            )
            ->leftJoin('marks', 'student_mission_tasks.id', '=', 'marks.student_mission_task_id')
            ->where('student_mission_tasks.student_mission_id', $studentMission->id)
            ->orderby('student_mission_tasks.task_order', 'ASC')
            ->get();

        return view('admin.student_mission.show', compact('studentMission', 'studentMissionTasks'));
    }


    public function update(Request $request, StudentMission $studentMission)
    {
        //
    }

    public function destroy(StudentMission $studentMission)
    {
        $studentMission->delete();

        DB::table('student_mission_tasks')->where('student_mission_id', $studentMission->id)->delete();

        return back();
    }
}
