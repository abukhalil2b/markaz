<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workperiod extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'gender',
        'title',
        'moderator_should_be_present_at',
        'teacher_should_be_present_at',
        'student_should_be_present_at',
    ];
    
    public function userHasWorkperiods() {
        return $this->belongsToMany(User::class,'user_has_workperiod');
    }

    public function levelHasWorkperiods() {
        return $this->belongsToMany(Level::class,'level_has_workperiod');
    }

    public function getStudentAwardTimeAttribute($value)
    {
        return date('H:i:s',strtotime($value));
    }

    public function recorddailies() {
        return $this->hasMany(Recorddaily::class);
    }

    public function lastRecorddaily(){
        return $this->recorddailies()->orderby('id','desc')->first();
    }

    public function users($gender) {
        return $this->userHasWorkperiods()
        ->where('users.user_type','<>','admin')
        ->where('users.gender',$gender)
        ->get();
    }

    public function hasLevel($id) {
        return (bool) $this->levelHasWorkperiods()->where('level_has_workperiod.level_id',$id)->first();
    }

    public function hasUser($id) {
        return (bool) $this->userHasWorkperiods()->where('user_has_workperiod.user_id',$id)->first();
    }

    public function levelCount(){
        return $this->levelHasWorkperiods()
        ->count();
    }

    public function userCount(){
        return $this->userHasWorkperiods()
        ->where('users.user_type','<>','admin')
        ->count();
    }


}
