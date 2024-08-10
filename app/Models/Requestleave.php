<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requestleave extends Model
{
    protected $fillable=['description','datefrom','dateto','status','user_id','gender'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
