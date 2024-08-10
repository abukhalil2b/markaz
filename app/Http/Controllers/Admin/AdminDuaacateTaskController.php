<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Duaacate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDuaacateTaskController extends Controller
{

    public function dashboard(Student $student)
    {
        $duaacates = Duaacate::all();

        $duaacateTasks = DB::table('duaacate_tasks')
            ->get();

        return view('admin.duaacate_task.dashboard', compact('duaacateTasks', 'student'));
    }



    public function index(Duaacate $duaacate)
    {
        $duaacateTasks = DB::table('duaacate_tasks')
            ->where('duaacate_id', $duaacate->id)
            ->get();

        return view('admin.duaacate.task.index', compact('duaacateTasks', 'duaacate'));
    }




    public function store(Request $request)
    {
        // return $request->all();

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'duaacate_id' => 'required'
        ]);

        DB::table('duaacate_tasks')->insert([
            'title' => $request->title,
            'content' => $request->content,
            'duaacate_id' => $request->duaacate_id
        ]);

        return back();
    }


    public function show($duaacate_task_id)
    {
        $duaacateTask = DB::table('duaacate_tasks')
            ->where('id', $duaacate_task_id)
            ->first();

        return view('admin.duaacate.task.show', compact('duaacateTask'));
    }

    public function studentDuaacateTaskIndex(Duaacate $duaacate, Student $student)
    {
        $duaacateTasks = DB::table('duaacate_tasks')
            ->where('duaacate_id', $duaacate->id)
            ->get();

        return view('admin.student.duaacate.task.index', compact('duaacateTasks', 'duaacate', 'student'));
    }

    public function studentDuaacateTaskShow($duaacate_task_id, Student $student)
    {
        $duaacateTask = DB::table('duaacate_tasks')
            ->where('id', $duaacate_task_id)
            ->first();

        return view('admin.student.duaacate.task.show', compact('duaacateTask', 'student'));
    }


    public function update(Request $request, $duaacate_task_id)
    {
        // return $request->all();
        DB::table('duaacate_tasks')
            ->where('id', $duaacate_task_id)
            ->update([
                'title' => $request->title,
                'content' => $request->content
            ]);

        return back();
    }

    public function delete($duaacate_task_id)
    {

        $duaacateTask = DB::table('duaacate_tasks')
            ->where('id', $duaacate_task_id)
            ->first();

        DB::table('duaacate_student_task')
            ->where('duaacate_task_id', $duaacate_task_id)
            ->delete();

        DB::table('duaacate_tasks')
            ->where('id', $duaacate_task_id)
            ->delete();

        return redirect()->route('admin.duaacate.task.index', $duaacateTask->duaacate_id);
    }
}
