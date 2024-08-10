<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model {

	protected $fillable = [
		'title',
		'student_id',
		'level_id',
		'user_id',
		'action',
		'gender',
	];

	public function student() {
		return $this->belongsTo(Student::class);
	}
	public function level() {
		return $this->belongsTo(Level::class);
	}
}
