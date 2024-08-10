<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
	protected $fillable = ['allowed_wrong_number','sorted','status'];
	
	public $timestamps = false;


	public function missionTasks(){
		return $this->hasMany(MissionTask::class);
	}

	protected $casts = [
		'startfrom' => 'integer',
		'endto' => 'integer'
	];
}
