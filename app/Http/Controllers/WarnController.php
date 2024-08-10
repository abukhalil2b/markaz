<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Warnlate;
use App\Models\Warnabsent;
use Illuminate\Support\Facades\DB;

class WarnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $warnabsents = Warnabsent::select(DB::raw('DISTINCT student_id'))->get();

        $warnlates = Warnlate::select(DB::raw('DISTINCT student_id'))->get();

        return view('admin.warn.dashboard',compact('warnabsents','warnlates'));
    }

    public function edit(Student $student)
    {
        $warn = Warnabsent::where(['student_id' => $student->id])->first();

        if (!$warn) {
            for ($id = 0; $id < 4; $id++) {
                Warnabsent::create(['student_id' => $student->id, 'absent' => 0]);
            }
            for ($id = 0; $id < 5; $id++) {
                Warnlate::create(['student_id' => $student->id, 'late' => 0]);
            }
        }

        $warnabsents = Warnabsent::where(['student_id' => $student->id])->get();

        $warnlates = Warnlate::where(['student_id' => $student->id])->get();

        return view('warn.edit', compact('warnlates', 'warnabsents', 'student'));

    }


    public function absentUpdate(Warnabsent $warnabsent)
    {
        $warnabsent->update(['absent' => 1]);

        return redirect()->back();
    }


    public function absentClear(Student $student)
    {
        Warnabsent::where(['student_id' => $student->id])->update(['absent' => 0]);

        return redirect()->back();
    }

    public function lateUpdate(Warnlate $warnlate)
    {
        $warnlate->update(['late' => 1]);

        return redirect()->back();
    }


    public function lateClear(Student $student)
    {
        Warnlate::where(['student_id' => $student->id])->update(['late' => 0]);

        return redirect()->back();
    }

    public function warnabsentTruncate()
    {
        Warnabsent::truncate();

        return back();
    }

    public function warnlateTruncate()
    {
        Warnlate::truncate();

        return back();
    }
}
