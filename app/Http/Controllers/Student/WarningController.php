<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Warning;
use App\Models\Warnabsent;
use App\Models\Warnlate;

use Illuminate\Http\Request;


class WarningController extends Controller
{
    public function index()
    {
        $student = auth()->user();

    	$w1 = Warning::where(['student_id'=>$student->id,'level'=>'1'])->first();
    	$w2 = Warning::where(['student_id'=>$student->id,'level'=>'2'])->first();
    	$w3 = Warning::where(['student_id'=>$student->id,'level'=>'3'])->first();
    	$w4 = Warning::where(['student_id'=>$student->id,'level'=>'4'])->first();
    	$w5 = Warning::where(['student_id'=>$student->id,'level'=>'5'])->first();
    	$w6 = Warning::where(['student_id'=>$student->id,'level'=>'6'])->first();
        return view('student.warning.index',compact('student','w1','w2','w3','w4','w5','w6'));
    }

	public function absenceWarn()
    {
        $student = auth()->user();

        $warn = Warnabsent::where(['student_id'=>$student->id])->first();
		
        if(!$warn){
            for($id=0;$id<4;$id++){
                Warnabsent::create(['student_id'=>$student->id,'absent'=>0]);
            } 
            for($id=0;$id<5;$id++){
                Warnlate::create(['student_id'=>$student->id,'late'=>0]);
            }           
        }

        $warnabsents = Warnabsent::where(['student_id'=>$student->id])->get();

        $warnlates = Warnlate::where(['student_id'=>$student->id])->get();

        return view('student.warning.absence_warn',compact('warnlates','warnabsents','student'));
    }
	

}
