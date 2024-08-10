<?php

namespace App\Http\Controllers;

use App\Helper\Helperfunction;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subscriptionfee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AmountToPayController extends Controller
{

    public function create()
    {

        $semester = Semester::latest('id')->first();
        
        $workperiod = Helperfunction::getUserWorkperiod();

        $registeredStudentIds = DB::table('semester_student_amount_to_pay')
            ->where('semester_id', $semester->id)
            ->pluck('student_id');

        $students = Student::where(['status' => 'active', 'workperiod_id' => $workperiod->id])
            ->whereNotIn('id', $registeredStudentIds)
            ->get();


        return view('admin.semester.student.amount_to_pay.create', compact('semester', 'students', 'workperiod'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'semester_id' => 'required',
        ]);

        // return $request->all();

        if (!$request->studentIds) {
            abort(404);
        }

        foreach ($request->studentIds as $student_id) {

            DB::table('semester_student_amount_to_pay')
                ->insert([
                    'isforgiven' => $request->isforgiven == null ? 0 : 1,
                    'amount' => $request->amount,
                    'student_id' => $student_id,
                    'semester_id' => $request->semester_id,
                    'workperiod_id' => $request->workperiod_id,
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d')
                ]);
        }

        return redirect()
            ->route('admin.semester.student.amount_to_pay.create', $request->semester_id)
            ->with(['status' => 'success', 'message' => 'تم']);
    }


    public function search(Request $request, Semester $semester)
    {
        if (!$request->search) {
            abort(404);
        }

        $workperiod = Helperfunction::getUserWorkperiod();

        $registeredStudentIds = DB::table('semester_student_amount_to_pay')
            ->where('semester_id', $semester->id)
            ->pluck('student_id');

        $students = Student::where(['status' => 'active', 'workperiod_id' => $workperiod->id])
            ->whereNotIn('id', $registeredStudentIds)
            ->where(function ($query) use ($request) {
                $query->where('id', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('full_name', 'LIKE', '%' . $request->search . '%');
            })->get();

        return view('admin.semester.student.amount_to_pay.create', compact('semester', 'students', 'workperiod'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function edit(Semester $semester)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function delete(Semester $semester)
    {
        Subscriptionfee::where('semester_id', $semester->id)->delete();

        $semester->delete();

        return back();
    }
}
