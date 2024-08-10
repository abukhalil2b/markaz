<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Warning;
use Illuminate\Support\Facades\DB;

class WarningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function studentIndex()
    {
        $studentIds = DB::select('SELECT DISTINCT student_id FROM `warnings`');

        $studentIds = array_map(fn ($student) => $student->student_id, $studentIds);

        $students = Student::whereIn('id', $studentIds)->get();

        return view('admin.warning.student_index', compact('students'));
    }

    public function index(Student $student)
    {
        $w1 = Warning::where(['student_id' => $student->id, 'level' => '1'])->first();
        $w2 = Warning::where(['student_id' => $student->id, 'level' => '2'])->first();
        $w3 = Warning::where(['student_id' => $student->id, 'level' => '3'])->first();
        $w4 = Warning::where(['student_id' => $student->id, 'level' => '4'])->first();
        $w5 = Warning::where(['student_id' => $student->id, 'level' => '5'])->first();
        $w6 = Warning::where(['student_id' => $student->id, 'level' => '6'])->first();
        return view('admin.student.warning.index', compact('student', 'w1', 'w2', 'w3', 'w4', 'w5', 'w6'));
    }

    public function create(Student $student, $level)
    {
        $warning = Warning::where(['student_id' => $student->id, 'level' => $level])->first();
        return view('admin.student.warning.create', compact('student', 'level', 'warning'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['date' => 'required', 'level' => 'required']);
        Warning::create($request->all());

        return redirect()->route('admin.student.warning.index', $request->student_id)->with(['status' => 'success', 'message' => 'تم']);
    }

    public function delete(Warning $warning)
    {
        $warning->delete();
        return redirect()->back()->with(['status' => 'success', 'message' => 'تم']);
    }
}
