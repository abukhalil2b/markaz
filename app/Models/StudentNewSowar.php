<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentNewSowar extends Model {
	public $timestamps = false;
	protected $fillable = [
				'done',
				'selected_as_onesora',
				'selected_as_multisora',
				'done_at',
				'student_id',
				'sowar_id',
				'mission_id',
				'mission_title',
				'ayat'
			];
	protected $table = 'student_has_new_sowars';

	public function sowar() {
		return $this->belongsTo(Sowar::class);
	}


}
