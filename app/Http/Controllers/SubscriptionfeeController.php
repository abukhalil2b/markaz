<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Student;
use App\Models\Subscriptionfee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionfeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Semester $semester,Student $student)
    {

        $subscriptionfees = Subscriptionfee::where([
            'semester_id' => $semester->id,
            'student_id' => $student->id
        ])
        ->get();

        $total = Subscriptionfee::where([
            'semester_id' => $semester->id,
            'student_id' => $student->id
        ])
        ->sum('amount');


        return view('admin.subscriptionfee.index', compact('subscriptionfees', 'student','total','semester'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
// return $request->all();
        $request->validate([
            'amount' => 'required',
            'student_id' => 'required',
            'semester_id' => 'required'
        ]);

        Subscriptionfee::create([
            'semester_id' => $request->semester_id,
            'amount' => $request->amount,
            'student_id' => $request->student_id,
            'note' => $request->note
        ]);

        return redirect()->route('admin.semester.student.subscriptionfee.index',$request->semester_id);
    }


    public function show(Subscriptionfee $subscriptionfee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscriptionfee  $subscriptionfee
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriptionfee $subscriptionfee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscriptionfee  $subscriptionfee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscriptionfee $subscriptionfee)
    {
        // return $request->all();

        $subscriptionfee->update([
            'amount' => $request->amount,
            'note' => $request->note
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscriptionfee  $subscriptionfee
     * @return \Illuminate\Http\Response
     */
    public function delete(Subscriptionfee $subscriptionfee)
    {
        $subscriptionfee->delete();
        
        return back();
    }
}
