<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Student extends Authenticatable  {
	protected $guarded = [];

	public function notes() {
		return $this->hasMany(Note::class);
	}


	public function level() {
		return $this->belongsTo(Level::class);
	}



	public function workperiod() {
        return $this->belongsTo(Workperiod::class);
    }

	public function answers(){
		return $this->hasMany(Answer::class);
	}

	public function studentmissions() {
		return $this->hasMany(StudentHasMission::class, 'student_id');
	}

	public function dailyRecords() {
		return $this->hasMany(StudentHasRecordDaily::class, 'student_id');
	}
	

    public function getFirstLastNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

	public function duaas(){
        return $this->belongsToMany(Duaa::class,'student_has_duaas','student_id','duaa_id');
    }

    public function checkHasWeekDay($day){
    	$studyDays = json_decode($this->study_days);
    	if($studyDays){
    		foreach ($studyDays as $study_day) {
    			if($day == $study_day) return true;
    		}
    	}
        return false;
    }
    

	public function getAuthPassword() {
        return Hash::make($this->password);
    }

	protected $casts = [
		// 'study_days' => 'array'
	];
}
