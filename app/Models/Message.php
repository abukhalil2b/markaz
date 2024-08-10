<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
   protected $fillable = ['content','sender_id','parent_id'];

   public function sender(){
      return $this->belongsTo(User::class,'sender_id');
   }

   public function receivers(){

      return $this->belongsToMany(User::class,'message_receiver','message_id','receiver_id') 
      ->withPivot('is_read');
   }

}
