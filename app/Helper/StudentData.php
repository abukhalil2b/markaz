<?php
namespace App\Helper;

use App\Models\Student;
use App\Models\Report;
use App\Models\StudentHasMission;
use App\Models\StudentHasDuaa;
use App\Models\Studentplan;
use Illuminate\Support\Facades\Session;

class StudentData{
	
	static function newMissions(Student $student){
		return StudentHasMission::where('track_type','new')
			->where(['student_id' => $student->id])
			->get();	
	}

	static function reviewMissions(Student $student){
		return StudentHasMission::where('track_type','review')
			->where('type', '<>', 'final')
			->where(['student_id' => $student->id])
			->get();	
	}

	static function reviewOneSowars(Student $student){
		return Report::where(['done'=>1,'onesowar'=>1,'student_id'=>$student->id])->get();
	}

	static function hesasReviewMissions(Student $student){
		return  StudentHasMission::where('track_type','review_hesas')
			->where(['student_id' => $student->id])
			->get();
	}

	static function duaa(Student $student){
		return StudentHasDuaa::where(['student_id'=>$student->id])
			->where('done_at','<>',NULL)
			->get();
	}


	static function studentplan(Student $student){
		return Studentplan::where('status','<>',NULL)
		->where(['student_id'=>$student->id,'archived'=>0])->get();
	}
	
}