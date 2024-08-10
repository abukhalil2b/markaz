<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Sowar;
use App\Models\Student;
use App\Models\StudentHasMission;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\MissionTask;
use App\Models\StudentMission;

class MissionController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}



	public function create()
	{
		$missionSods = Mission::where(['status' => 'active', 'track_cate' => 'sods'])->get();

		$missionThomon = Mission::where(['status' => 'active', 'track_cate' => 'thomon'])->get();

		$missionThomonAndHalf = Mission::where(['status' => 'active', 'track_cate' => 'thomon_and_half'])->get();

		$missionRob = Mission::where(['status' => 'active', 'track_cate' => 'rob'])->get();

		$missionNis = Mission::where(['status' => 'active', 'track_cate' => 'nis'])->get();

		$missionAll = Mission::where(['status' => 'active', 'track_cate' => 'all'])->get();
		// 

		$missionSodsAsc = Mission::where(['status' => 'active', 'track_cate' => 'asc_sods'])->get();

		$missionThomonAsc = Mission::where(['status' => 'active', 'track_cate' => 'asc_thomon'])->get();

		$missionThomonAndHalfAsc = Mission::where(['status' => 'active', 'track_cate' => 'asc_thomon_and_half'])->get();

		$missionRobAsc = Mission::where(['status' => 'active', 'track_cate' => 'asc_rob'])->get();

		$missionNisAsc = Mission::where(['status' => 'active', 'track_cate' => 'asc_nis'])->get();

		$missionAllAsc = Mission::where(['status' => 'active', 'track_cate' => 'asc_all'])->get();

		$missionTests = Mission::where(['status' => 'active', 'track_cate' => 'test'])->get();
		return view('admin.mission.create', compact(
			'missionSods',
			'missionThomon',
			'missionThomonAndHalf',
			'missionRob',
			'missionNis',
			'missionAll',
			'missionSodsAsc',
			'missionThomonAsc',
			'missionThomonAndHalfAsc',
			'missionRobAsc',
			'missionNisAsc',
			'missionAllAsc',
			'missionTests'
		));
	}

	public function orderEdit($id)
	{

		$missionTasks = MissionTask::where('mission_id', $id)
			// ->orderby('task_order', 'ASC')
			->orderby('id', 'ASC')
			->get();

		//[ ] need to enhance
		$mission_id = $id;
		return view('admin.mission.order_edit', compact('missionTasks', 'mission_id'));
	}

	public function orderUpdate(Request $request)
	{

		if ($request->task_orders) {

			$missionTasks = MissionTask::where('mission_id', $request->mission_id)
				->orderby('id', 'ASC')
				->get();

			foreach ($request->task_orders as $key => $order) {

				MissionTask::where('id', $missionTasks[$key]->id)
					->update([
						'task_order' => $order
					]);
			}
		}

		return back();
	}


	public function reOrder($id)
	{

		$missionTasks = MissionTask::where('mission_id', $id)
			->orderby('task_order', 'ASC')
			->get();

		return view('admin.mission.reorder', compact('missionTasks'));
	}

	public function print($id)
	{
		$mission = Mission::findOrFail($id);

		$missionTasks = MissionTask::where('mission_id', $id)
			->orderby('task_order', 'ASC')
			->get();

		return view('admin.mission.print', compact('missionTasks', 'mission'));
	}

	public function printAllActiveASC()
	{
		$missions = Mission::with(['missionTasks' => fn ($q) => $q->orderby('task_order', 'ASC')])
			->where('track_cate', 'LIKE', '%asc%')
			->where('status', 'active')

			->get();



		return view('admin.mission.print_all', compact('missions'));
	}

	public function studentMissionIndex(Student $student)
	{

		$studentMissionIds = StudentMission::where('student_id', $student->id)->pluck('mission_id');

		$missionSods = Mission::where(['track_cate' => 'sods'])
			->whereNotIn('id', $studentMissionIds)
			->where('missions.status', 'active')
			->get();

		$missionThomon = Mission::where(['track_cate' => 'thomon'])
			->whereNotIn('id', $studentMissionIds)
			->where('missions.status', 'active')
			->get();

		$missionThomonAndHalf = Mission::where(['track_cate' => 'thomon_and_half'])
			->whereNotIn('id', $studentMissionIds)
			->where('missions.status', 'active')
			->get();

		$missionRob = Mission::where(['track_cate' => 'rob'])
			->whereNotIn('id', $studentMissionIds)
			->where('missions.status', 'active')
			->get();

		$missionNis = Mission::where(['track_cate' => 'nis'])
			->whereNotIn('id', $studentMissionIds)
			->where('missions.status', 'active')
			->get();

		$missionAll = Mission::where(['track_cate' => 'all'])
			->whereNotIn('id', $studentMissionIds)
			->where('missions.status', 'active')
			->get();
		// 

		$missionSodsAsc = Mission::where(['track_cate' => 'asc_sods'])
			->whereNotIn('id', $studentMissionIds)
			->where('missions.status', 'active')
			->get();

		$missionThomonAsc = Mission::where(['track_cate' => 'asc_thomon'])
			->whereNotIn('id', $studentMissionIds)
			->where('missions.status', 'active')
			->get();

		$missionThomonAndHalfAsc = Mission::where(['track_cate' => 'asc_thomon_and_half'])
			->whereNotIn('id', $studentMissionIds)
			->where('missions.status', 'active')
			->get();

		$missionRobAsc = Mission::where(['track_cate' => 'asc_rob'])
			->whereNotIn('id', $studentMissionIds)
			->where('missions.status', 'active')
			->get();

		$missionNisAsc = Mission::where(['track_cate' => 'asc_nis'])
			->whereNotIn('id', $studentMissionIds)
			->where('missions.status', 'active')
			->get();

		$missionAllAsc = Mission::where(['track_cate' => 'asc_all'])
			->whereNotIn('id', $studentMissionIds)
			->where('missions.status', 'active')
			->get();

		return view('admin.student.mission.index', compact(
			'student',
			'missionSods',
			'missionThomon',
			'missionThomonAndHalf',
			'missionRob',
			'missionNis',
			'missionAll',
			'missionSodsAsc',
			'missionThomonAsc',
			'missionThomonAndHalfAsc',
			'missionRobAsc',
			'missionNisAsc',
			'missionAllAsc'
		));
	}

	public function studentMissionIndexTest(Student $student)
	{

		$studentMissionIds = StudentMission::where('student_id', $student->id)
			->pluck('mission_id');

		$descMissions = Mission::whereIn('track_cate', ['sods', 'thomon', 'thomon_and_half', 'rob', 'nis', 'all'])
			->whereNotIn('id', $studentMissionIds)
			->where('missions.status', 'active')
			->get();

		// 

		$ascMissions = Mission::whereIn('track_cate', ['asc_sods', 'asc_thomon', 'asc_thomon_and_half', 'asc_rob', 'asc_nis', 'asc_all'])
			->whereNotIn('id', $studentMissionIds)
			->where('missions.status', 'active')
			->get();

		$missionsTests = Mission::where('track_cate', 'test')
			->get();

		return view('admin.student.mission.index_test', compact(
			'student',
			'descMissions',
			'ascMissions',
			'missionsTests'
		));
	}

	public function studentMissionHistory(Student $student)
	{

		$studentMissions = StudentMission::where('student_id', $student->id)->get();

		return view('admin.student.mission.history', compact('studentMissions', 'student'));
	}

	public function taskFreeText(Mission $mission)
	{
		$missionTasks = MissionTask::where('mission_id', $mission->id)
			->orderby('task_order', 'DESC')
			->get();

		$lastMissionTask = count($missionTasks) == 0 ? NULL : $missionTasks[0];

		return view('admin.mission.task.free_text', compact('mission', 'missionTasks', 'lastMissionTask'));
	}

	public function taskOneSurat(Mission $mission)
	{

		$suratFrom = 1;

		$suratTo = 144;

		// if ($suratTo  < $suratFrom ) {
		// 	//to get surats we need make first param grater than second
		// 	$suratFrom = $mission->endto;

		// 	$suratTo = $mission->startfrom;
		// }

		$surats = DB::connection('secondDB')->table('quran_surats')
			->whereBetween('id', [$suratFrom, $suratTo])
			->get();

		$missionTasks = MissionTask::where('mission_id', $mission->id)
			->orderby('task_order', 'DESC')
			->get();

		$surats = json_encode($surats);

		$lastMissionTask = count($missionTasks) == 0 ? NULL : $missionTasks[0];

		return view('admin.mission.task.one_surat', compact('mission', 'missionTasks', 'surats', 'lastMissionTask'));
	}

	public function taskSuratToSurat(Mission $mission)
	{

		$suratFrom = 1;

		$suratTo = 144;

		// if ($suratTo  < $suratFrom ) {
		// 	//to get surats we need make first param grater than second
		// 	$suratFrom = $mission->endto;

		// 	$suratTo = $mission->startfrom;
		// }

		$surats = DB::connection('secondDB')->table('quran_surats')
			->whereBetween('id', [$suratFrom, $suratTo])
			->get();

		$missionTasks = MissionTask::where('mission_id', $mission->id)
			->orderby('task_order', 'DESC')
			->get();

		$surats = json_encode($surats);


		$lastMissionTask = count($missionTasks) == 0 ? NULL : $missionTasks[0];

		return view('admin.mission.task.surat_to_surat', compact('mission', 'missionTasks', 'surats', 'lastMissionTask'));
	}

	public function taskAyaToAya(Mission $mission)
	{

		$suratFrom = 1;

		$suratTo = 144;

		// if ($suratTo  < $suratFrom ) {
		// 	//to get surats we need make first param grater than second
		// 	$suratFrom = $mission->endto;

		// 	$suratTo = $mission->startfrom;
		// }

		$surats = DB::connection('secondDB')->table('quran_surats')
			->whereBetween('id', [$suratFrom, $suratTo])
			->get();

		$quran_ayas = DB::connection('secondDB')->table('quran_ayas')
			->whereBetween('quran_surat_id', [$suratFrom, $suratTo])
			->get();

		$missionTasks = MissionTask::where('mission_id', $mission->id)
			->orderby('task_order', 'DESC')
			->get();

		$surats = json_encode($surats);

		$lastMissionTask = count($missionTasks) == 0 ? NULL : $missionTasks[0];

		// $quran_ayas = json_encode($quran_ayas);

		return view('admin.mission.task.aya_to_aya', compact('mission', 'missionTasks', 'surats', 'quran_ayas', 'lastMissionTask'));
	}
}
