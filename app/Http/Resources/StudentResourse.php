<?php

namespace App\Http\Resources;
use App\Http\Resources\Report;

use App\Http\Resources\StudentHasRecordDailyCollection;
use App\Http\Resources\MarkResource;
use DB;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Models\Mark;
use App\Models\Recordweekly;
class StudentResourse extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		//inital variables => in case recordweekly returned NULL.
		$presentOnTimesDetails=[];
		$presentOnTimesMarkTotal=0;

		$hardWorksDetails=[];
		$hardWorksMarkTotal=0;

		$knowledgeSharesDetails=[];
		$knowledgeSharesMarkTotal=0;

		$interactionInClassRoomsDetails=[];
		$interactionInClassRoomsMarkTotal=0;

		$achieveReviewMissionsDetails=[];
		$achieveReviewMissionsMarkTotal=0;

		$appearancesDetails=[];
		$appearancesMarkTotal=0;

		$generalsDetails=[];
		$generalsMarkTotal=0;

		$memorizeDuaasDetails=[];
		$memorizeDuaasMarkTotal=0;

		$newTasksDetails=[];
		$newTasksMarkTotal=0;

		$reviewTasksDetails=[];
		$reviewTasksMarkTotal=0;

		$ladiesAffairsDetails=[];
		$ladiesAffairsMarkTotal=0;
		$searchKey = Recordweekly::orderby('id','desc')
		->where('workperiod_id',$this->workperiod_id)
		->first();

		if($searchKey){
			$presentOnTimes = Mark::where(['tag' => 'presentOnTime','student_id'=>$this->id]);
			$presentOnTimesDetails = $presentOnTimes->get();
			$presentOnTimesMarkTotal = $presentOnTimes->sum('point');

			$hardWorks = Mark::where(['tag' => 'hardWork','student_id'=>$this->id]);
			$hardWorksDetails = $hardWorks->get();
			$hardWorksMarkTotal = $hardWorks->sum('point');

			$knowledgeShares = Mark::where(['tag' => 'knowledgeShare','student_id'=>$this->id]);
			$knowledgeSharesDetails = $knowledgeShares->get();
			$knowledgeSharesMarkTotal = $knowledgeShares->sum('point');

			$interactionInClassRooms = Mark::where(['tag' => 'interactionInClassRoom','student_id'=>$this->id]);
			$interactionInClassRoomsDetails = $interactionInClassRooms->get();
			$interactionInClassRoomsMarkTotal = $interactionInClassRooms->sum('point');

			$achieveReviewMissions = Mark::where(['tag' => 'achieveReviewMission','student_id'=>$this->id]);
			$achieveReviewMissionsDetails = $achieveReviewMissions->get();
			$achieveReviewMissionsMarkTotal = $achieveReviewMissions->sum('point');

			$appearances = Mark::where(['tag' => 'appearance','student_id'=>$this->id]);
			$appearancesDetails = $appearances->get();
			$appearancesMarkTotal = $appearances->sum('point');

			$generals = Mark::where(['tag' => 'general','student_id'=>$this->id]);
			$generalsDetails = $generals->get();
			$generalsMarkTotal = $generals->sum('point');

			$memorizeDuaas = Mark::where(['tag' => 'memorizeDuaa','student_id'=>$this->id]);
			$memorizeDuaasDetails = $memorizeDuaas->get();
			$memorizeDuaasMarkTotal = $memorizeDuaas->sum('point');

			$newTasks = Mark::where(['tag' => 'newTask','student_id'=>$this->id]);
			$newTasksDetails = $newTasks->get();
			$newTasksMarkTotal = $newTasks->sum('point');

			$reviewTasks = Mark::where(['tag' => 'reviewTask','student_id'=>$this->id]);
			$reviewTasksDetails = $reviewTasks->get();
			$reviewTasksMarkTotal = $reviewTasks->sum('point');

			$ladiesAffairs = Mark::where(['tag' => 'ladiesAffairs','student_id'=>$this->id]);
			$ladiesAffairsDetails = $ladiesAffairs->get();
			$ladiesAffairsMarkTotal = $ladiesAffairs->sum('point');
		}

		$thisYear = date('Y', time());
		return [
			'full_name' => $this->full_name,
			'id' => $this->id,
			'password' => $this->password,
			'gender' => $this->gender,
			'level_id' => $this->level_id,
			'levelTitle' => $this->level->title,
			'workperiodTitle' => $this->workperiod->title,
			'thisYear' => $thisYear,
			'timesOfAbsent' => $this->dailyRecords()
				->groupBy('month', 'present')
				->whereNull('present_time')
				->where(['year' => $thisYear])
				->select('month', DB::raw('count(id) as total'))->get(),
			'dailyRecords' => new StudentHasRecordDailyCollection($this->dailyRecords()->orderby('id', 'desc')->limit(10)->get()),
	
			'presentOnTimesDetails' =>  MarkResource::collection($presentOnTimesDetails),
			'presentOnTimesMarkTotal' =>  $presentOnTimesMarkTotal,

			'hardWorksDetails' =>  MarkResource::collection($hardWorksDetails),
			'hardWorksMarkTotal' =>  $hardWorksMarkTotal,

			'knowledgeSharesDetails' =>  MarkResource::collection($knowledgeSharesDetails),
			'knowledgeSharesMarkTotal' =>  $knowledgeSharesMarkTotal,

			'interactionInClassRoomsDetails' =>  MarkResource::collection($interactionInClassRoomsDetails),
			'interactionInClassRoomsMarkTotal' =>  $interactionInClassRoomsMarkTotal,

			'achieveReviewMissionsDetails' =>  MarkResource::collection($achieveReviewMissionsDetails),
			'achieveReviewMissionsMarkTotal' =>  $achieveReviewMissionsMarkTotal,

			'appearancesDetails' =>  MarkResource::collection($appearancesDetails),
			'appearancesMarkTotal' =>  $appearancesMarkTotal,

			'generalsDetails' =>  MarkResource::collection($generalsDetails),
			'generalsMarkTotal' =>  $generalsMarkTotal,

			'memorizeDuaasDetails' =>  MarkResource::collection($memorizeDuaasDetails),
			'memorizeDuaasMarkTotal' =>  $memorizeDuaasMarkTotal,

			'newTasksDetails' =>  MarkResource::collection($newTasksDetails),
			'newTasksMarkTotal' =>  $newTasksMarkTotal,

			'reviewTasksDetails' =>  MarkResource::collection($reviewTasksDetails),
			'reviewTasksMarkTotal' =>  $reviewTasksMarkTotal,

			'ladiesAffairsDetails' =>  MarkResource::collection($ladiesAffairsDetails),
			'ladiesAffairsMarkTotal' =>  $ladiesAffairsMarkTotal,


			'markTotal' =>  $presentOnTimesMarkTotal+
			$hardWorksMarkTotal+
			$knowledgeSharesMarkTotal+
			$interactionInClassRoomsMarkTotal+
			$memorizeDuaasMarkTotal+
			$achieveReviewMissionsMarkTotal+
			$appearancesMarkTotal+
			$newTasksMarkTotal+
			$reviewTasksMarkTotal+
			$generalsMarkTotal,

		];
	}

}
