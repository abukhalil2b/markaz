<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\MonthlysubscribeStudent;
use App\Models\Semester;
use App\Models\Subscriptionfee;
use Illuminate\Support\Facades\DB;

class MonthlysubscribeController extends Controller
{
    public function index()
    {
        $student = auth()->user();

        $lastSemester = Semester::latest('id')
            //[ ] ->where('actve',1)
            ->first();

        if (!$lastSemester) {
            abort(404);
        }

        // student has to pay an amount
        $semesterStudentAmountToPay = DB::table('semester_student_amount_to_pay')
            ->where(['student_id' => $student->id, 'semester_id' => $lastSemester->id])
            ->first();

        //student all payment for this semester
        $subscriptionfees = Subscriptionfee::where([
            'semester_id' => $lastSemester->id,
            'student_id' => $student->id
        ])->get();
        
        //total payment
        $total = Subscriptionfee::where([
            'semester_id' => $lastSemester->id,
            'student_id' => $student->id
        ])->select(DB::raw('sum(amount) as total'))->first();

        return view('student.monthlysubscribe.index', compact('student', 'lastSemester', 'semesterStudentAmountToPay', 'subscriptionfees', 'total'));
    }
}
