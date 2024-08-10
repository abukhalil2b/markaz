<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMissionTask extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function mark()
    {
        return $this->hasOne(Mark::class,'student_mission_task_id');
    }
}
