<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warnlate extends Model
{
    use HasFactory;
    protected $fillable=['student_id','late'];
    public $timestamps = false;
}
