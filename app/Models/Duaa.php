<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duaa extends Model
{

    protected $fillable = ['title','content','content_type','view_gender','duaacate_id'];

    public function students(){
        return $this->belongsToMany(Student::class,'student_has_duaas','duaa_id','student_id');
    }

}
