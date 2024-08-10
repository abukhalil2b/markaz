<?php

namespace App\Http\Controllers;


use App\Models\StudentHasMission;

use Illuminate\Http\Request;
use App\Helper\Helperfunction;
use Illuminate\Support\Facades\DB;

class HesasController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function reviewCreate(StudentHasMission $studentHasMission)
	{

		// return$studentHasMission;
		return view('student.hesas_review_track.done_create', compact('studentHasMission'));
	}

	public function reviewStore(Request $request, StudentHasMission $studentHasMission)
	{
		// return $request->all();
		$request->validate(['evaluation' => 'required']);

		//data to be update
		$data = [
			'evaluation' => $request->evaluation,
			'notes' => $request->normal_note,
			'stop_number' => $request->stop_number,
			'attention_number' => $request->attention_number,
			'wrongs' => $request->wrongs,
			'done_at' => time(),
			'numwrong' => count(json_decode($request->wrongs)),
			'evaluatedby_id' => auth()->id(),
			'success' => 1
		];

		if ($request->evaluation == 'لم ينجح') {

			$data['success'] = 0;
		}

		// return $data;
		$studentHasMission->update($data);

		// 'يسمح فقط ثلاث محاولات لإعادة المهمة'
		$try_number = $studentHasMission->try_number;

		if ($request->evaluation == 'لم ينجح') {

			$try_number = $try_number + 1;

			if ($try_number <= 3) {
				$newStudentHasMission = $studentHasMission->replicate();
				$newStudentHasMission->evaluation = NULL;
				$newStudentHasMission->done_at = NULL;
				$newStudentHasMission->notes = NULL;
				$newStudentHasMission->try_number = $try_number;
				$newStudentHasMission->start_at = time();
				$newStudentHasMission->save();
			}
		} else {
			if ($request->point > 0) {

				Helperfunction::createMark('achieveReviewMission', $request->point, $studentHasMission->student_id, '');
			}
		}

		return redirect()->route('admin.student.dashboard', ['student' => $studentHasMission->student_id])
			->with(['status' => 'success', 'message' => 'تم']);
	}


	/* start of --waiting approval-- */
	public function reviewWaitingApproval()
	{

		$loggedUser = auth()->user();

		if ($loggedUser->user_type == 'admin') {

			$where = ['student_has_mission.step_approval' => 1];
		} else {

			$where = ['students.workperiod_id' => $loggedUser->workperiod_id, 'student_has_mission.step_approval' => 0];
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
			->whereNotNull('done_at')
			->orderby('done_at', 'desc')
			->get();

		return view('student.mission.hesas.waiting_approval', compact('studentHasMissions'));
	}

	/* start of --waiting approval-- */
	public function reviewNotDone()
	{

		$loggedUser = auth()->user();

		$where = ['students.workperiod_id' => $loggedUser->workperiod_id];

		if ($loggedUser->user_type == 'male_teacher' || $loggedUser->user_type == 'female_teacher') {
			$where = ['students.workperiod_id' => $loggedUser->workperiod_id, 'students.level_id' => $loggedUser->level_id];
		}

		$studentHasMissions = DB::table('student_has_mission')
			->select(
				'student_has_mission.student_id',
				'student_has_mission.id',
				'done_at',
				'start_at',
				'numwrong',
				'evaluation',
				'notes',
				'full_name',
				'workperiods.title as workperiod_title',
				'missions.title as mission_title'
			)
			->join('missions', 'student_has_mission.mission_id', '=', 'missions.id')
			->join('students', 'student_has_mission.student_id', '=', 'students.id')
			->join('workperiods', 'students.workperiod_id', '=', 'workperiods.id')
			->where('student_has_mission.track_type', 'review_hesas')
			->where($where)
			->whereNull('done_at')
			->orderby('start_at', 'desc')
			->get();

		return view('student.mission.hesas.note_done', compact('studentHasMissions'));
	}

	public function reviewApprove(Request $request)
	{
		$userTypes = ['admin', 'male_moderator', 'female_moderator'];

		$loggedUser = auth()->user();

		if (in_array($loggedUser->user_type, $userTypes)) {


			if ($loggedUser->user_type == 'admin') {
				$update = ['step_approval' => 2];
			} else {
				$update = ['step_approval' => 1];
			}

			// return $request->all();

			if ($request->ids) {

				StudentHasMission::whereIn('id', $request->ids)
					->update($update);

				return back();
			}
		} else {
			abort(403, 'لا تملك الصلاحية');
		}

		abort(404);
	}
}
