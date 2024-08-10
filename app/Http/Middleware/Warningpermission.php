<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Warning;
class Warningpermission
{


    public function handle(Request $request, Closure $next)
    {


        $teachersLevelAllowed=[1,2];//teachers allow to write waring in this level only
        $moderatorLevelAllowed=[3,4,5,6];//moderators allow to write waring in this level only

        $userType = $request->user()->user_type;
        $student = $request->student;
        $level = $request->level;
        
        
        if($userType=='male_moderator'||$userType=='female_moderator'){
            if(!in_array($level,$moderatorLevelAllowed)){
                abort(401);
            }
        }


        if($userType=='male_teacher'||$userType=='female_teacher'){
            if(!in_array($level,$teachersLevelAllowed)){
                abort(401);
            }

            
        }
            
        $lastLevel = Warning::where('student_id',$student->id)
        ->orderby('id','desc')
        ->pluck('level')
        ->first();

        $nextLevel = $lastLevel + 1;
        if($level == $lastLevel || $level == $nextLevel){
            return $next($request);
        }
        
        abort(401);
        
    }
}
