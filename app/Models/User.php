<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable
{
    use  Notifiable;

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $fillable = [
        'first_name',
        'second_name',
        'third_name',
        'last_name',
        'full_name',
        'gender',
        'phone',
        'email',
        'password',
        'plain_password',
        'national_id',
        'user_type',
        'active',
        'note',
        'level_id',
        'summer_teacher_id',
        'workperiod_id'
    ];


    public function userType()
    {
        switch ($this->user_type) {
            case 'admin':
                return 'الإدارة';
                break;
            case 'male_moderator':
                return 'مُشْرِف';
                break;
            case 'female_moderator':
                return 'مُشْرِفة';
                break;
            case 'male_teacher':
                return 'مُدَرِس';
                break;
            case 'female_teacher':
                return 'مُدَرِسة';
                break;
            default:
                return $this->user_type;
                break;
        }
    }

    public function levelName()
    {
        return $this->level->title;
    }


    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function workperiod()
    {
        return $this->belongsTo(Workperiod::class);
    }

    public function userHasWorkperiods()
    {
        return $this->belongsToMany(Workperiod::class, 'user_has_workperiod');
    }

    public function userWorkperiods()
    {
        return $this->userHasWorkperiods()->orderBy('gender', 'desc')->get();
    }

    public function hasWorkperiod($id)
    {
        return (bool) $this->userHasWorkperiods()->where('user_has_workperiod.workperiod_id', $id)->first();
    }

    public function canChangeWorkperiod($workperiod)
    {
        $can = (bool) $this->userHasWorkperiods()->where('user_has_workperiod.workperiod_id', $workperiod->id)->first();
        if (!$can) {
            abort(403);
        }
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'user_as_teacher_has_student', 'user_id', 'student_id');
    }

    public function userAsFathers()
    {
        return $this->belongsToMany(Student::class, 'user_as_father_has_students', 'user_id', 'student_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user_has_permissions', 'user_id', 'permission_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_has_roles', 'user_id', 'role_id');
    }

    public function hasRole($id)
    {
        return $this->roles()->where('user_has_roles.role_id', $id)->count();
    }

    public function permission($permission)
    {
        $user = auth()->user();
        $userHasPermission = $user->permissions()->where('slug', $permission)->count();

        $userRolesHasPermission = $user->roles()->whereHas('permissions', function ($query) use ($permission) {
            $query->where('permissions.slug', $permission);
        })->count();

        if ($userHasPermission || $userRolesHasPermission || $user->id === 1) {
            return true;
        } else {
            return false;
        }
    }
    

    public function allPermissions()
    {
       //return all permissions as array
    }


    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getShortNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    //impersonate
    public function setImpersonating($user)
    {
        Session::put('impersonate_user_id', $user->id);
    }

    public function stopImpersonating()
    {
        Session::forget('impersonate_user_id');
    }

    public function isImpersonating()
    {
        return Session::has('impersonate_user_id');
    }

    public function isAdministrator()
    {
        return $this->user_type == 'admin' ? true : false;
    }

    public function suggestionpermissions()
    {
        return $this->belongsToMany(Suggestioncate::class, 'suggestionpermissions', 'user_id', 'suggestioncate_id');
    }

    public function hasPermissionOnSuggestioncate($suggestion)
    {
        $suggestion = $this->suggestionpermissions()->where('id', $suggestion->id)->first();
        if (!$suggestion) {
            abort(403, 'لاتملك الصلاحية');
        }
    }

    public function requestleaves()
    {
        return $this->hasMany(Requestleave::class);
    }

    public function storednotes()
    {
        return $this->hasMany(Storednote::class);
    }

    public function receiverPermission()
    {
        return $this->hasMany(MessageReceiverPermission::class, 'receiver_id');
    }

    public function messageReceiverPermissions()
    {
        return $this->belongsToMany(User::class, 'message_receiver_permissions','user_id','receiver_id');
    }
    
    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id')
        ->with('receivers');
    }

    public function receivedMessages()
    {
        return $this->belongsToMany(Message::class, 'message_receiver', 'receiver_id', 'message_id')
        ->with('sender')
        ->withPivot('is_read');
    }
}
