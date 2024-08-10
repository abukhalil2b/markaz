<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminStudentHasRecordDailyController extends Controller
{

    public function absent_excuse_create($student_has_record_daily_id)
    {

        $student_has_record_daily = DB::table('student_has_record_daily')
            ->where(['id' => $student_has_record_daily_id])
            ->first();

        if (!$student_has_record_daily) {
            abort(404);
        }

        return view('admin.student_has_record_daily.absent_excuse_create', compact('student_has_record_daily'));
    }

    public function absent_excuse_store(Request $request)
    {

        if ($request->with_excuse == 1) {
            
            $data = [
                'with_excuse' => 1,
                'note' => NULL
            ];

        } else {

            $request->validate(['note' => "required"]);

            $data = [
                'with_excuse' => 0,
                'note' => $request->note
            ];
        }

        DB::table('student_has_record_daily')
            ->where(['id' => $request->student_has_record_daily_id])
            ->update($data);

        return redirect()->route('admin.student.index');
    }
}
