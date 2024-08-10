<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    protected $fillable=['body','user_id','suggestioncate_id','replay','parent'];
    
    public function suggestioncate(){
        return $this->belongsTo(Suggestioncate::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replays(){
        return $this->hasMany(Suggestion::class,'parent');
    }
}
