<?php

namespace App\Http\Controllers;

use App\Models\LastStudentMissionTask;
use Illuminate\Http\Request;
use App\Helper\Helperfunction;
use App\Models\Level;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class LastStudentMissionTaskController extends Controller
{


    public function chooseLevel()
    {
        $loggedUser = auth()->user();

        if ($loggedUser->user_type  == 'male_teacher' || $loggedUser->user_type  == 'female_teacher') {

            $levels = Level::where('id', $loggedUser->level_id)->get();
        }

        if ($loggedUser->user_type  == 'male_moderator' || $loggedUser->user_type  == 'female_moderator') {

            $levelIds = DB::table('level_has_workperiod')->where('workperiod_id', $loggedUser->workperiod_id)->pluck('level_id');

            $levels = Level::whereIn('id', $levelIds)
                ->get();
        }


        if ($loggedUser->user_type == 'admin') {

            $levels = Level::whereNot('id',1)->get();
        }

        return view('admin.last_student_mission_task.choose_level', compact('levels'));
    }

    public function index(Level $level)
    {
        $students = Student::where('level_id', $level->id)
            ->where('status', 'active')
            ->get();

        $studentIds = $students->map(fn ($student) => $student->id)->toArray();

        $lastStudentMissionTasks = LastStudentMissionTask::whereIn('student_id', $studentIds)
            ->latest('updated_at')
            ->get();

        // return count($lastStudentMissionTasks);

        return view('admin.last_student_mission_task.index', compact('lastStudentMissionTasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LastStudentMissionTask  $lastStudentMissionTask
     * @return \Illuminate\Http\Response
     */
    public function show(LastStudentMissionTask $lastStudentMissionTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LastStudentMissionTask  $lastStudentMissionTask
     * @return \Illuminate\Http\Response
     */
    public function edit(LastStudentMissionTask $lastStudentMissionTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LastStudentMissionTask  $lastStudentMissionTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LastStudentMissionTask $lastStudentMissionTask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LastStudentMissionTask  $lastStudentMissionTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(LastStudentMissionTask $lastStudentMissionTask)
    {
        //
    }
}
