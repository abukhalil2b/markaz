<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionTask extends Model
{

    public $timestamps = false;

    public $guarded = [];

    public function mission()
    {
        $this->belongsTo(Mission::class);
    }
}
