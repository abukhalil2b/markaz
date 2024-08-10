<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentHasMission extends Model {
	protected $fillable = [
		'student_id',
		'mission_id',
		'mission_title',
		'start_at',
		'done_at',
		'mission_description',
		'track_type',
		'track_cate',
		'success',
		'try_number',
		'numwrong',
		'wrongs',
		'attention_number',
		'stop_number',
		'evaluation',
		'evaluatedby_id',
		'notes',
		'moderator_approved',
		'admin_approved'
	];

	protected $table = 'student_has_mission';

	public function mission() {
		return $this->belongsTo(Mission::class, 'mission_id');
	}
	public function student() {
		return $this->belongsTo(Student::class);
	}

	//@return css class
	public function statusAddCssClass(){
		if($this->done == 1 && $this->success == 0){
			return 'mission-fail';
		}
		if($this->done == 1 && $this->success == 1 && $this->step_approval == 0){
			return 'bg-white';
		}
		if($this->done == 1 && $this->success == 1 && $this->step_approval == 0){
			return 'mission-done';
		}
		
		return ' ';
	}

}
