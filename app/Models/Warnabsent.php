<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warnabsent extends Model
{
    use HasFactory;
    protected $fillable=['student_id','absent'];
    public $timestamps = false;
}
