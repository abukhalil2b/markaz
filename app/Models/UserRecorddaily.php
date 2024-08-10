<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRecorddaily extends Model
{
    protected $fillable = [
        'recorddaily_id',
        'user_id',
        'gender',
        'present_time',
        'islate',
        'note',
        'notification_is_seen',
        'should_be_present_at',
        'moderator_note',
        'moderator_seen'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recorddaily()
    {
        return $this->belongsTo(Recorddaily::class);
    }
}
