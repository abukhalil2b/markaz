<?php

namespace App\Http\Controllers;

use App\Helper\Helperfunction;
use App\Models\DailyEvaluation;
use App\Models\Level;
use App\Models\Student;
use App\Models\StudentHasMission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DailyEvaluationController extends Controller
{

    public function dashboard()
    {
        $loggedUser = auth()->user();

        $level = Level::find($loggedUser->level_id);

        $todayDate = date('Y-m-d');

        //this is not evaluation but we want see how it is work.
        $halfDones = DailyEvaluation::whereDate('created_at', $todayDate)
            ->where('level_id', $loggedUser->level_id)
            ->where('evaluation', 'أنجز نصف المهمة')
            ->get();

        $superExcellents = DailyEvaluation::whereDate('created_at', $todayDate)
            ->where('level_id', $loggedUser->level_id)
            ->where('evaluation', 'تفوق عالٍ')
            ->get();

        $excellents = DailyEvaluation::whereDate('created_at', $todayDate)
            ->where('level_id', $loggedUser->level_id)
            ->where('evaluation', 'ممتاز')
            ->get();

        $veryGoods = DailyEvaluation::whereDate('created_at', $todayDate)
            ->where('level_id', $loggedUser->level_id)
            ->where('evaluation', 'جيد جدا')
            ->get();

        $goods = DailyEvaluation::whereDate('created_at', $todayDate)
            ->where('level_id', $loggedUser->level_id)
            ->where('evaluation', 'جيد')
            ->get();

        $notSucceeds = DailyEvaluation::whereDate('created_at', $todayDate)
            ->where('level_id', $loggedUser->level_id)
            ->where('evaluation', 'لم ينجح')
            ->get();

        $passReadings = DailyEvaluation::whereDate('created_at', $todayDate)
            ->where('level_id', $loggedUser->level_id)
            ->where('evaluation', 'مجاز')
            ->get();

        $notPassReadings = DailyEvaluation::whereDate('created_at', $todayDate)
            ->where('level_id', $loggedUser->level_id)
            ->where('evaluation', 'لم يجز')
            ->get();

        $preparation_for_hesas = DailyEvaluation::where('level_id', $loggedUser->level_id)
            ->where('evaluation', 'التحضير للحصة')
            ->get();

        //$preparation_for_hesasIds
        $preparation_for_hesasIds = $preparation_for_hesas->map(fn ($s) => $s->student_id)->toArray();

        //get evaluated students
        $studentIds = DailyEvaluation::whereDate('created_at', $todayDate)
            ->where('level_id', $loggedUser->level_id)->pluck('student_id');

        $userWorkperiod = Helperfunction::getUserWorkperiod();

        $notDones = DB::table('student_has_record_daily')
            ->select('students.full_name', 'students.status', 'students.workperiod_id', 'students.level_id', 'student_has_record_daily.present_time', 'students.id')
            ->join('students', 'student_has_record_daily.student_id', '=', 'students.id')
            ->whereNotNull('present_time')
            ->where(['status' => 'active', 'workperiod_id' => $userWorkperiod->id, 'students.level_id' => $loggedUser->level_id])
            ->whereDate('student_has_record_daily.created_at', $todayDate)
            ->whereNotIn('students.id', $studentIds)
            ->get()->filter(fn ($notDone) => !in_array($notDone->id, $preparation_for_hesasIds));

        // $day = date('D');
        // // return $day;
        // $notDones = $students->filter(fn ($student) => $student->checkHasWeekDay($day));
        // return $notDones;
        return view('admin.student.daily_evaluations.dashboard', compact('level', 'halfDones', 'superExcellents', 'excellents', 'veryGoods', 'goods', 'notSucceeds', 'passReadings', 'notPassReadings', 'notDones', 'todayDate', 'preparation_for_hesas'));
    }

    public function addStudent(StudentHasMission $studentHasMission, $student_id)
    {

        $loggedUser = auth()->user();

        $student = Student::where([
            'id' => $student_id,
            // 'level_id' => $loggedUser->level_id
        ])->first();

        if (!$student) {
            abort(403, 'تأكد بأن الطالب في القاعة الصحيحة');
        }

        $preparation_for_hesas = DailyEvaluation::where([
            'model_type' => 'student_has_mission',
            'model_id' => $studentHasMission->id,
        ])->first();

        if (!$preparation_for_hesas) {

            DailyEvaluation::create([
                'student_id' => $student->id,
                'level_id' => $student->level_id,
                'evaluation' => 'التحضير للحصة',
                'full_name' => $student->full_name,
                'descr' => $studentHasMission->mission_title,
                'model_type' => 'student_has_mission',
                'model_id' => $studentHasMission->id
            ]);
        }

        return redirect()->route('admin.student.daily_evaluations.dashboard');
    }


    public function index()
    {
        $dailyEvaluationCount = DailyEvaluation::count();

        return view('admin.student.daily_evaluations.index', compact('dailyEvaluationCount'));
    }


    public function truncate()
    {
        DailyEvaluation::truncate();

        return back();
    }

    public function hesas_show($daily_evaluation_id)
    {

        $daily_evaluation = DB::table('daily_evaluations')
            ->where('id', $daily_evaluation_id)
            ->first();

        return view('admin.student.daily_evaluations.hesas_show', compact('daily_evaluation'));
    }

    public function hesas_remove($daily_evaluation_id)
    {

        DB::table('daily_evaluations')
            ->where('id', $daily_evaluation_id)
            ->delete();

            return redirect()->route('admin.student.daily_evaluations.dashboard');

    }

}
