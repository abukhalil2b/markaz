<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Recorddaily;
use App\Models\Recordmonthly;
use App\Models\Student;
use App\Models\StudentHasMission;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MissionHesasController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function studentMissionHesasIndex(Student $student)
	{
		// http://127.0.0.1:8000/admin/student/mission_hesas/create/5/88
		// return$studentMissionIds = StudentHasMission::where('student_id', $student->id)
		// ->pluck('mission_id');
		$missionReviewSods = Mission::where(['track_cate' => 'hesas_sods'])->get();

		$missionReviewThomon = Mission::where(['track_cate' => 'hesas_thomon'])->get();

		$missionReviewThomonAndHalf = Mission::where(['track_cate' => 'hesas_thomon_and_half'])->get();

		$missionReviewThomonAndHalfAsc = Mission::where(['track_cate' => 'asc_hesas_thomon_and_half'])->get();

		$missionReviewRob = Mission::where(['track_cate' => 'hesas_rob'])->get();

		$missionReviewNis = Mission::where(['track_cate' => 'hesas_nis'])->get();

		$missionReviewAll = Mission::where(['track_cate' => 'hesas_all'])->get();


		return view('admin.student.mission_hesas.index', compact(
			'missionReviewAll',
			'missionReviewNis',
			'missionReviewRob',
			'missionReviewThomon',
			'missionReviewThomonAndHalf',
			'missionReviewThomonAndHalfAsc',
			'missionReviewSods',
			'student'
		));
	}

	public function studentMissionHesasIndexTest(Student $student)
	{
		// http://127.0.0.1:8000/admin/student/mission_hesas/create/5/88
		// return$studentMissionIds = StudentHasMission::where('student_id', $student->id)
		// ->pluck('mission_id');
		$hesasMissions = Mission::whereIn('track_cate',['hesas_sods','hesas_thomon','hesas_thomon_and_half','asc_hesas_thomon_and_half','hesas_rob','hesas_nis','hesas_all'])
		->get();


		return view('admin.student.mission_hesas.index_test', compact(
			'hesasMissions','student'
		));
	}

	public function studentMissionHesasCreate(Student $student, Mission $mission)
	{
		return view('admin.student.mission_hesas.create', compact('student', 'mission'));
	}

	public function studentMissionHesasStore(Request $request)
	{
		// return $request->all();

		$student_id = $request->student_id;

		$mission = Mission::findOrFail($request->mission_id);

		$missionIsTaken = StudentHasMission::where(['student_id' => $student_id, 'mission_id' => $mission->id])
			->first();

		if ($missionIsTaken) {
			return die('<h2><center>تم اختيار المهمة سابقا</center></h2>');
		}

		StudentHasMission::create([
			'start_at' => time(),
			'student_id' => $student_id,
			'mission_id' => $mission->id,
			'mission_title' => $mission->title,
			'mission_description' => $mission->note,
			'track_type' => $mission->track_type,
			'track_cate' => $mission->track_cate
		]);

		return redirect()->route('admin.student.dashboard', ['student' => $student_id]);
	}


	public function studentMissionHesasHistory(Student $student)
	{

		$studentHasMissions = DB::table('student_has_mission')
			->where([
				'student_id' => $student->id,
				'track_type' => 'review_hesas'
			])->get();

		return view('admin.student.mission_hesas.history', compact('studentHasMissions', 'student'));
	}

	public function delete(StudentHasMission $studentHasMission)
	{
		// return$studentHasMission;
		$studentHasMission->delete();
		return back();
	}

	public function edit(StudentHasMission $studentHasMission)
	{
		// return$studentHasMission;
		return view('admin.student.mission_hesas.edit', compact('studentHasMission'));
	}

	public function update(Request $request, StudentHasMission $studentHasMission)
	{
		// return $request->all();

		$studentHasMission->update([
			'notes' => $request->notes,
			'evaluation' => $request->evaluation,
		]);

		return redirect()
			->route('admin.student.mission_hesas.history', $studentHasMission->student_id);
	}


}
