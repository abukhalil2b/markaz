<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recordmonthly extends Model
{
    protected $fillable = ['workperiod_id','title'];
    public function getLastRecord(){
       $record = Recordmonthly::orderBy('id','desc')->first();
       if($record)
        return $record;
       else
        die('<h1><center>يجب انشاء سجل يومي</center></h1>');
    }

    public function studentBusFees(){
      return $this->hasMany(Studentfee::class);
    }

    public function workperiod() {
        return $this->belongsTo(Workperiod::class);
    }
}
