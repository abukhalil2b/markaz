<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDuaacateStudentController extends Controller
{

    public function show($duaacate_student_id)
    {
        $duaacate_student = DB::table('duaacate_student')
            ->where('id', $duaacate_student_id)
            ->first();

        if (!$duaacate_student) {
            abort(404);
        }

        $student = Student::findOrFail($duaacate_student->student_id);

        $duaacate_student_tasks = DB::table('duaacate_student_task')
            ->select(
                'duaacate_student_task.id',
                'duaacate_tasks.title',
                'duaacate_student_task.done_at',
                'duaacate_student_task.numwrong',
                'duaacate_student_task.note',
                'duaacate_student_task.evaluation'
            )
            ->where('duaacate_student_id', $duaacate_student_id)
            ->join('duaacate_tasks', 'duaacate_student_task.duaacate_task_id', '=', 'duaacate_tasks.id')
            ->get();

        return view('admin.duaacate_student.show', compact('duaacate_student', 'duaacate_student_tasks', 'student'));
    }

    public function store(Request $request)
    {

        $duaacateStudent = DB::table('duaacate_student')
            ->where([
                'duaacate_id' => $request->duaacate_id,
                'student_id' => $request->student_id
            ])
            ->first();

        if ($duaacateStudent) {
            die('تم أخذ المهمة سابقا');
        }

        $duaacate_student_id = DB::table('duaacate_student')
            ->insertGetId([
                'duaacate_id' => $request->duaacate_id,
                'student_id' => $request->student_id
            ]);

        if ($request->duaacateTaskIds) {
            foreach ($request->duaacateTaskIds as $id) {
                DB::table('duaacate_student_task')
                    ->insert([
                        'duaacate_student_id' => $duaacate_student_id,
                        'duaacate_task_id' => $id,
                        'numwrong' => 0,
                        'evaluation' => 'معفي',
                        'done_at' => date('Y-m-d'),
                        'note' => 'معفي',
                    ]);
            }
        }

        return redirect()->route('admin.student.dashboard', $request->student_id);
    }

    public function toggleDone($duaacate_student_id)
    {
        $duaacate_student = DB::table('duaacate_student')
            ->where('id', $duaacate_student_id)
            ->first();

        if (!$duaacate_student) {
            abort(404);
        }

        if ($duaacate_student->done_at) {

            DB::table('duaacate_student')
                ->where('id', $duaacate_student_id)
                ->update([
                    'done_at' => NULL,
                ]);
        } else {

            DB::table('duaacate_student')
                ->where('id', $duaacate_student_id)
                ->update([
                    'done_at' => date('Y-m-d'),
                ]);
        }

        return redirect()->route('admin.student.dashboard', $duaacate_student->student_id);
    }

    public function duaacate_student_history($student_id)
    {

        $duaacates = DB::table('duaacate_student')
            ->select('duaacates.id', 'duaacates.title', 'duaacate_student.done_at', 'duaacate_student.id as duaacate_student_id')
            ->join('duaacates', 'duaacate_student.duaacate_id', '=', 'duaacates.id')
            ->where('student_id', $student_id)
            ->get();

        $student = Student::findOrFail($student_id);

        return view('admin.duaacate_student.history', compact('duaacates', 'student'));
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'duaacate_student_id' => 'required'
        ]);

        $duaacate_student_id = $request->duaacate_student_id;

        $duaacate_student = DB::table('duaacate_student')
            ->where('id', $duaacate_student_id)
            ->first();

        if (!$duaacate_student) {
            abort(404);
        }

        DB::transaction(function () use ($duaacate_student_id) {

            DB::table('duaacate_student')
                ->where('id', $duaacate_student_id)
                ->delete();

            DB::table('duaacate_student_task')
                ->where('duaacate_student_id', $duaacate_student_id)
                ->delete();
        });

        return redirect()->route('admin.student.dashboard', $duaacate_student->student_id);
    }
}
