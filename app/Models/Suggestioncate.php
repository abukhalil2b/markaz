<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestioncate extends Model
{
    use HasFactory;

    protected $fillable=['title','active'];

    public function suggestions(){
        return $this->hasMany(Suggestion::class);
    }

    public function suggestionpermissions(){
        return $this->belongsToMany(User::class,'suggestionpermissions','suggestioncate_id','user_id');
    }
}
