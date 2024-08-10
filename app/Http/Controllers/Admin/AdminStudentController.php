<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helper\Helperfunction;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminStudentController extends Controller
{

    public function studyDayIndex(Student $student)
    {
        $weekDays = Helperfunction::getWeekDays();

        return view('admin.student.studyday.index', compact('student', 'weekDays'));
    }

  
}
