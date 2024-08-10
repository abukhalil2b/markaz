<?php

namespace App\Http\Middleware;

use App\Models\Student;
use Closure;

class GenderPermission {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {

		$loggedUser = auth()->user();
		if ($loggedUser === null) {
			return redirect('login');
		}
		if($request->student_id){
			$student = Student::findOrFail($request->student_id);
		}else{
			$student =$request->student;
		}

		if($loggedUser->user_type=='female_moderator'||
			$loggedUser->user_type=='female_teacher'){
				if ($student->gender =='m') {
					return response("<center><h1>لاتملك صلاحيات النوع </h1></center>", 401);
				}
		}


		if($loggedUser->user_type=='male_moderator'||
			$loggedUser->user_type=='male_teacher'){
				if ($student->gender =='f') {
					return response("<center><h1>لاتملك صلاحيات النوع </h1></center>", 401);
				}
		}
		

		return $next($request);
	}
}
