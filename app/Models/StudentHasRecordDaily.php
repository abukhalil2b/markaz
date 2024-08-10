<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentHasRecordDaily extends Model {
	protected $table = 'student_has_record_daily';

	protected $guarded = [];

	public function record() {
		return $this->belongsTo(Recorddaily::class, 'recorddaily_id');
	}

	public function student() {
		return $this->belongsTo(Student::class, 'student_id');
	}

}
