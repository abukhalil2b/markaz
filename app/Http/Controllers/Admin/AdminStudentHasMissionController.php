<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminStudentHasMissionController extends Controller
{

	
	public function approvedIndex()
	{

		$loggedUser = auth()->user();

		if($loggedUser->user_type == 'admin'){

			$title = 'الحصص المعتمدة من الإدارة';

			$where = ['student_has_mission.step_approval'=> 2];
		}

		if($loggedUser->user_type == 'male_moderator' || $loggedUser->user_type == 'female_moderator'){

			$title = 'الحصص المعتمدة من المشرف';

			$where = ['student_has_mission.step_approval'=> 1,'students.workperiod_id'=>$loggedUser->workperiod_id];
		}

		$studentHasMissions = DB::table('student_has_mission')
			->select(
				'users.full_name as evaluated_name',
				'student_has_mission.id',
				'student_has_mission.step_approval',
				'done_at',
				'success',
				'start_at',
				'numwrong',
				'wrongs',
				'try_number',
				'stop_number',
				'attention_number',
				'evaluation',
				'notes',
				'students.full_name',
				'workperiods.title as workperiod_title',
				'missions.title as mission_title'
			)
			->join('missions', 'student_has_mission.mission_id', '=', 'missions.id')
			->join('students', 'student_has_mission.student_id', '=', 'students.id')
			->join('workperiods', 'students.workperiod_id', '=', 'workperiods.id')
			->leftjoin('users', 'student_has_mission.evaluatedby_id', '=', 'users.id')
			->where($where)
			->where('student_has_mission.track_type', 'review_hesas')
			->orderby('done_at', 'desc')
			->paginate(50);

		

		return  view('admin.student_has_mission.approved_index', compact('studentHasMissions', 'title'));
	}
}
