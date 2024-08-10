<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duaacate extends Model
{
    protected $fillable=['title','duaacate_id'];

    public function duaas(){
        return $this->hasMany(Duaa::class);
    }

    public function childs(){

        return $this->hasMany(Duaacate::class,'duaacate_id');
        
    }

    
}
