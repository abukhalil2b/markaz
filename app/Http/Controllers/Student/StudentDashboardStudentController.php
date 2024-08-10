<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentHasDuaa;
use App\Models\StudentHasRecordDaily;
use App\Models\StudentMission;

use Illuminate\Support\Facades\DB;

class StudentDashboardStudentController extends Controller
{
    public function dashboard()
    {
        $student = auth()->user();

        //attendance
        $attendance = StudentHasRecordDaily::where('student_id', $student->id)->latest('id')->first();

        //c
        $timesOfAbsence = StudentHasRecordDaily::where('student_id', $student->id)
            ->whereNull('present_time')
            ->count();

        // مسار إنجاز الحصص
        $studentHasMission = DB::table('student_has_mission')
            ->whereNull('done_at')
            ->orderBy('id', 'desc')
            ->where([
                'student_id' => $student->id,
                'track_type' => 'review_hesas'
            ])->first();

        $hesasReviewMissions = DB::table('student_has_mission')
            ->orderBy('id', 'desc')
            ->where('track_type', 'review_hesas')
            ->where(['student_id' => $student->id])
            ->get();

        $duaacateStudents = DB::table('duaacate_student')
            ->select('duaacate_student.id', 'duaacates.title', 'duaacate_student.done_at')
            ->join('duaacates', 'duaacate_student.duaacate_id', '=', 'duaacates.id')
            ->whereNull('duaacate_student.done_at')
            ->where('student_id', $student->id)
            ->get();


        //حفظ القرآن الكريم
        $studentMissions = StudentMission::where('student_id', $student->id)->get();

        return view('student.dashboard.show', compact('student', 'attendance', 'timesOfAbsence', 'studentMissions', 'studentHasMission', 'hesasReviewMissions', 'duaacateStudents'));
    }



    public function absenceTimesDetails()
    {
        $student = auth()->user();

        //times of absence
        $timesOfAbsences = StudentHasRecordDaily::where('student_id', $student->id)
            ->select(DB::raw('MONTH(created_at) AS in_month , count( MONTH(created_at) ) AS absentTimes'))
            ->whereNull('present_time')
            ->groupBy('in_month')
            ->get();

        return view('student.dashboard.absence_details', compact('timesOfAbsences'));
    }



    public function showDuaa(StudentHasDuaa $studentHasDuaa)
    {
        // return $studentHasDuaa;
        return view('student.dashboard.duaa.show', compact('studentHasDuaa'));
    }
}
