<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlysubscribeStudent extends Model
{

    
    public $timestamps=false;

    protected $fillable=['recordmonthly_id','student_id','gender','amount','paid','paid_date'];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function recordmonthly(){
        return $this->belongsTo(Recordmonthly::class);
    }
    
}
