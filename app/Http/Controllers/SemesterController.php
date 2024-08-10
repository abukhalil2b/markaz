<?php

namespace App\Http\Controllers;

use App\Helper\Helperfunction;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subscriptionfee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SemesterController extends Controller
{

    public function index()
    {
        $semesters = Semester::latest('id')->get();

        return view('admin.semester.index', compact('semesters'));
    }

    public function studentSubscriptionfeeIndex(Semester $semester)
    {
        //do we make opining semester to all workperiod
        $workperiod = Helperfunction::getUserWorkperiod();

        $subscriptionfees = DB::table('subscriptionfees')
            ->select(DB::raw('SUM(amount) AS total_paid'), 'students.id as student_id', 'students.full_name')
            ->join('students', 'subscriptionfees.student_id', '=', 'students.id')
            ->where('semester_id', $semester->id)
            ->groupBy('student_id')
            ->get();

        $amountToPays = DB::table('semester_student_amount_to_pay')
            ->select('semester_student_amount_to_pay.id', 'student_id', 'students.full_name', 'amount as mount_required', 'isforgiven')
            ->join('students', 'semester_student_amount_to_pay.student_id', '=', 'students.id')
            ->where(['semester_student_amount_to_pay.workperiod_id' => $workperiod->id, 'semester_id' => $semester->id])
            ->get();

        $studentAmountToPays = $amountToPays->map(function ($amountToPay) use ($subscriptionfees) {

            $obj['id'] = $amountToPay->id;

            $obj['student_id'] = $amountToPay->student_id;

            $obj['full_name'] = $amountToPay->full_name;

            $obj['mount_required'] = $amountToPay->mount_required;

            $obj['isforgiven'] = $amountToPay->isforgiven;

            $obj['total_paid'] = 0;

            $subscriptionfee = $subscriptionfees->filter(fn ($subscriptionfee) => $subscriptionfee->student_id == $amountToPay->student_id)->first();

            if ($subscriptionfee) {

                $obj['total_paid'] = $subscriptionfee->total_paid;
            }

            $obj['paid'] = $obj['total_paid'] >= $obj['mount_required'];

            return (object) $obj;
        })->sortBy(fn ($item) => $item->paid > 0);

        return view('admin.semester.student.subscriptionfee.index', compact('semester', 'studentAmountToPays'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        Semester::create([
            'title' => $request->title
        ]);

        return back();
    }

    public function studentAmountToPayDelete(Request $request)
    {
        // return $request->all();
        DB::table('semester_student_amount_to_pay')
            ->where([
                'semester_id' => $request->semester_id,
                'student_id' => $request->student_id,
            ])
            ->delete();

        DB::table('subscriptionfees')->where([
            'semester_id' => $request->semester_id,
            'student_id' => $request->student_id,
        ])->delete();

        return redirect()->route('admin.semester.student.subscriptionfee.index', ['semester' => $request->semester_id]);
    }

    public function studentAmountToPayEdit($student_amount_to_pay_id)
    {
        $studentAmountToPay = DB::table('semester_student_amount_to_pay')
            ->where('id', $student_amount_to_pay_id)
            ->first();

        if (!$studentAmountToPay) {
            abort(404);
        }

        return view('admin.semester.student_amount_to_pay_edit', compact('studentAmountToPay'));
    }

    public function studentAmountToPayUpdate(Request $request)
    {
        // return $request->all();
        $ssmtp = DB::table('semester_student_amount_to_pay')
            ->where('id', $request->id)
            ->first();

        if (!$ssmtp) {
            abort(404);
        }

        DB::table('semester_student_amount_to_pay')
            ->where('id', $request->id)
            ->update([
                'amount' => $request->amount
            ]);

        return redirect()->route('admin.semester.student.subscriptionfee.index', ['semester' => $ssmtp->semester_id]);
    }

    public function update(Request $request, Semester $semester)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $semester->update([
            'title' => $request->title
        ]);

        return back();
    }

    public function delete(Semester $semester)
    {
        Subscriptionfee::where('semester_id', $semester->id)->delete();

        $semester->delete();

        return back();
    }
}
