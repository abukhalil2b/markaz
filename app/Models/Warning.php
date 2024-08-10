<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
	
class Warning extends Model
{
	protected $fillable = ['level','date','description','student_id'];
    use HasFactory;
}
