<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Level;
use Illuminate\Support\Facades\DB;
use App\Helper\Helperfunction;
use App\Models\Workperiod;
use Illuminate\Http\Request;

class MarkController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	// by tag 
	public function markOrderbyTag()
	{

		$loggedUser = auth()->user();

		$showLadiesAffairs = 0;

		if ($loggedUser->user_type == 'admin' || $loggedUser->user_type == 'female_teacher' || $loggedUser->user_type == 'female_moderator') {

			$showLadiesAffairs = 1;
		}

		return view('mark.ordermark.bytag.index', compact('showLadiesAffairs'));
	}

	// by tag -- details
	public function markOrderbyTagDetails(Request $request, $tag)
	{
		
		$loggedUser = auth()->user();

		$workperiod = Workperiod::find($loggedUser->workperiod_id);

		$levelIds = $this->getLevelIds($loggedUser);

		$levels = $this->getLevels($loggedUser);

		$date = date('Y-m-d');

		$datefrom = $request->datefrom;

		$dateto = $request->dateto;

		$info = '';

		$marks = [];

		if ($request->isMethod('GET')) {

			$info = 'تم عرض النتائج حسب تاريخ: ' . $date . ' والفترة: ' . $workperiod->title;

			$marks = $this->getMarksCount($tag, $workperiod, $levelIds, $date, null, null,$request);
		} else {
			// return $request->all();
			$request->validate([
				'datefrom' => 'required',
				'dateto' => 'required'
			]);

			$info = 'تم عرض النتائج من تاريخ: ' . $datefrom . ' إلى ' . $dateto . ' والفترة: ' . $workperiod->title;

			$marks = $this->getMarksCount($tag, $workperiod, $levelIds, null, $datefrom, $dateto,$request);
		}


		$userType = $loggedUser->user_type;
		
		return view('mark.ordermark.bytag.details', compact('marks','levels', 'tag', 'info', 'datefrom', 'dateto','userType'));
	}


	public function delete(Mark $mark)
	{
		$mark->delete();
		return redirect()->back()->with(['status' => 'success', 'message' => 'تم']);
	}

	private function getMarksCount($tag, $workperiod, $levelIds, $date, $datefrom, $dateto,$request)
	{
		$whereIn = $levelIds;

		if($request->level_id){
			$whereIn = [$request->level_id];
		}

		if ($date) {
			return Mark::select(DB::raw("SUM(marks.point) as total_point"), 'marks.student_id','levels.title as level_title')
				->join('students', 'marks.student_id', '=', 'students.id')
				->join('levels', 'students.level_id', '=', 'levels.id')
				->where(['tag' => $tag, 'students.workperiod_id' => $workperiod->id])
				->whereIn('students.level_id',$whereIn)
				->whereDate('marks.created_at', '>=', $date)
				->orderby('total_point', 'desc')
				->groupby('marks.student_id')
				->limit(50)
				->get();
		}

		if ($datefrom && $dateto) {

			return  Mark::select(DB::raw("SUM(marks.point) as total_point"), 'marks.student_id','levels.title as level_title')
				->join('students', 'marks.student_id', '=', 'students.id')
				->join('levels', 'students.level_id', '=', 'levels.id')
				->where(['tag' => $tag, 'students.workperiod_id' => $workperiod->id])
				->whereIn('students.level_id',$whereIn)
				->whereBetween('marks.created_at', [$datefrom, $dateto])
				->orderby('total_point', 'desc')
				->groupby('marks.student_id')
				->limit(50)
				->get();
		}
	}

	private function getLevelIds($loggedUser)
	{

		$maleLevelIds = Level::where('gender', 'm')
			->pluck('id');

		$femaleLevelIds = Level::where('gender', 'f')
			->pluck('id');

		if ($loggedUser->user_type == 'admin') {
			return $maleLevelIds->merge($femaleLevelIds);
		}

		//male moderator
		if ($loggedUser->user_type == 'male_moderator') {

			return $maleLevelIds;
		}

		//female moderator
		if ($loggedUser->user_type == 'female_moderator') {

			return $femaleLevelIds;
		}

		//male teacher
		if ($loggedUser->user_type == 'male_teacher') {

			$id = 1;

			foreach($maleLevelIds as $maleLevelId){

				if($loggedUser->level_id == $maleLevelId){

					$id = $maleLevelId;

					break;
				}
			}

			return [$id];
	
		}

		//female teacher
		if ($loggedUser->user_type == 'female_teacher') {

			$id = 1;

			foreach($femaleLevelIds as $femaleLevelId){

				if($loggedUser->level_id == $femaleLevelId){

					$id = $femaleLevelId;

					break;
				}
			}

			return [$id];
		}
	}

	private function getLevels($loggedUser)
	{

		$maleLevels = Level::where('gender', 'm')
			->get();

		$femaleLevels = Level::where('gender', 'f')
			->get();

		if ($loggedUser->user_type == 'admin') {
			return $maleLevels->merge($femaleLevels);
		}

		//male moderator
		if ($loggedUser->user_type == 'male_moderator') {

			return $maleLevels;
		}

		//female moderator
		if ($loggedUser->user_type == 'female_moderator') {

			return $femaleLevels;
		}

		//male teacher
		if ($loggedUser->user_type == 'male_teacher') {

			return $maleLevels->filter(fn($l)=>$loggedUser->level_id == $l->id);
	
		}

		//female teacher
		if ($loggedUser->user_type == 'female_teacher') {

			return $femaleLevels->filter(fn($l)=>$loggedUser->level_id == $l->id);
		}
	}
}
