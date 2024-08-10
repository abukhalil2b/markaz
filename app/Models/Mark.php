<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{

	protected $fillable = [
		'student_id',
		'tag',
		'note',
		'point',
		'student_mission_task_id',
		'duaacate_student_task_id'
	];

	public function student()
	{
		return $this->belongsTo(Student::class);
	}
}
