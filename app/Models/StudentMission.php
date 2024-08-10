<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMission extends Model
{
    protected $guarded = [];

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }
}
