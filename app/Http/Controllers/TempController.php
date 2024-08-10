<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Duaa;
use Illuminate\Support\Facades\DB;

class TempController extends Controller
{

    public function allMaleStudent()
    {
        $students = Student::where('gender', 'm')
            ->orderby('full_name', 'asc')
            ->get();
        return view('temp.all_student', compact('students'));
    }

    public function allFemaleStudent()
    {
        $students = Student::where('gender', 'f')
            ->orderby('full_name', 'asc')
            ->get();
        return view('temp.all_student', compact('students'));
    }

    public function duaa()
    {
        $duaas =  Duaa::all();
        return view('temp.duaas', compact('duaas'));
    }

    public function male_student_mission_tasks()
    {
        $student_Ids = DB::table('student_mission_tasks')
            ->selectRaw('DISTINCT student_id')
            ->whereNull('mission_task_id')
            ->whereNull('done_at')
            ->pluck('student_id');

        $students = Student::whereIn('id', $student_Ids)
            ->select('full_name', 'id')
            ->where('gender', 'm')
            ->get();

        return view('temp.student_mission_tasks', compact('students'));
    }

    public function female_student_mission_tasks()
    {
        $student_Ids = DB::table('student_mission_tasks')
            ->selectRaw('DISTINCT student_id')
            ->whereNull('mission_task_id')
            ->whereNull('done_at')
            ->pluck('student_id');

        $students = Student::whereIn('id', $student_Ids)
            ->select('full_name', 'id')
            ->where('gender', 'f')
            ->get();

        return view('temp.student_mission_tasks', compact('students'));
    }

}
