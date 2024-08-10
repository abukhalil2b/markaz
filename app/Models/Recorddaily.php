<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recorddaily extends Model {
	protected $fillable = ['title', 'day','create_student_list','workperiod_id','gender'];

	public function getLastRecord() {
		$record = Recorddaily::orderBy('id', 'desc')->first();
		if ($record) {
			return $record;
		} else {
			die('<h1><center>يجب انشاء سجل يومي</center></h1>');
		}

	}


	public function workperiod() {
        return $this->belongsTo(Workperiod::class);
    }

}
