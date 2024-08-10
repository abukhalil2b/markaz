<?php

namespace App\Http\Controllers;

use App\Helper\Helperfunction;
use App\Models\MonthlysubscribeStudent;
use App\Models\Recordmonthly;
use App\Models\Recorddaily;
use App\Models\Student;
use App\Models\StudentBus;
use App\Models\Studentfee;
use App\Models\Busrecord;
use App\Models\Level;
use App\Models\Bus;
use Illuminate\Http\Request;

class MonthlysubscribeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function monthlysubscribeStudentDetails(Student $student)
    {

        $subscribers = MonthlysubscribeStudent::with('recordmonthly')
            ->where(['student_id' => $student->id])
            ->get();

        return view('monthlysubscribe.student.details', compact('student', 'subscribers'));
    }


    public function monthlysubscribeStudentSearch(Recordmonthly $recordmonthly, Request $request)
    {
        $request->validate(['search' => 'required']);

        $search = $request->search;

        $subscribers = MonthlysubscribeStudent::where(['recordmonthly_id' => $recordmonthly->id])->get();

        $student = Student::where(['status' => 'active', 'workperiod_id' => $recordmonthly->workperiod_id])
            ->whereNotIn('id', $subscribers->pluck('student_id'));

        if ($search) {

            $student = $student->where(function ($q) use ($search) {
                $q->orWhere('id', 'LIKE', '%' . $search . '%')
                    ->orWhere('first_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('second_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('third_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('full_name', 'LIKE', '%' . $search . '%');
            });
        }


        $students = $student->get();

        return view('monthlysubscribe.student.index', compact('students', 'recordmonthly'));
    }


    public function monthlysubscribeEdit(MonthlysubscribeStudent $monthlysubscribeStudent)
    {
        return view('monthlysubscribe.edit', compact('monthlysubscribeStudent'));
    }

    public function monthlysubscribeUpdate(Request $request, MonthlysubscribeStudent $monthlysubscribeStudent)
    {

        if ($request->paid == 1) {
            $request->validate(['amount' => 'required', 'paid_date' => 'required']);
        } else {
            $request['paid_date'] = null;
        }

        $monthlysubscribeStudent->update(['amount' => $request->amount, 'paid' => $request->paid, 'paid_date' => $request->paid_date]);

        return redirect()->route('monthlysubscribe.student.index', ['recordmonthly' => $monthlysubscribeStudent->recordmonthly_id])
            ->with(['status' => 'success', 'message' => 'تم']);
    }

    public function monthlysubscribeDelete(MonthlysubscribeStudent $monthlysubscribeStudent)
    {
        $monthlysubscribeStudent->delete();

        return redirect()->route('monthlysubscribe.student.index', ['recordmonthly' => $monthlysubscribeStudent->recordmonthly_id])
            ->with(['status' => 'success', 'message' => 'تم']);
    }
}
