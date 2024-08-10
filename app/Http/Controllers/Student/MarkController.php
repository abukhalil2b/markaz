<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Mark;
use App\Models\Mission;
use App\Models\Student;
use App\Models\StudentHasRecordDaily;
use Carbon\Carbon;
use Illuminate\Http\Request;


class MarkController extends Controller
{
    public function index()
    {
        $student = auth()->user();

        //marks
        $marks = Mark::where('student_id',$student->id)->latest('id')->paginate(100);
        
        return view('student.mark.index', compact('marks'));
    }

}
