<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentHasDuaa extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'student_id',
        'duaa_id',
        'start_at',
        'tobedone_at',
        'done_at',
        'evaluation',
        'numwrong',
        'notes',
        'ignore_timing',
        'timing_status',
    ];

    public function duaa() {
        return $this->belongsTo(Duaa::class);
    }
    public function student() {
        return $this->belongsTo(Student::class);
    }
}
