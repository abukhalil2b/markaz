<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helper\Helperfunction;
class Level extends Model {
	public $timestamps = false;

	protected $fillable = ['title','gender','description'];

	public function users() {
		return $this->belongsToMany(User::class, 'user_has_level', 'level_id', 'user_id');
	}

	public function students() {
		return $this->hasMany(Student::class);
	}

	public function teachers() {
		return $this->hasMany(User::class);
	}


	public function workperiodSelectedStudents(){
		$userWorkperiod = Helperfunction::getUserWorkperiod();
		return $this->selectedstudents()
		->where('workperiod_id',$userWorkperiod->id)
		->where('cate','high_point_in_his_level')
		->get();
	}

    public function levelHasWorkperiods() {
        return $this->belongsToMany(Workperiod::class,'level_has_workperiod');
    }

    public function levelHasWorkperiodPermission($workperiondId){
    	$workperiond = $this->levelHasWorkperiods()->where('workperiod_id',$workperiondId)->first();
    	if(!$workperiond){
    		abort(401);
    	}
    }


}
