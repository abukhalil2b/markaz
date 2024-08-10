<?php
namespace App\Http\Controllers;

 use Illuminate\Support\Facades\DB;

class FollowupController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	public function didMissionLateCount($level_id) {
		return DB::table('reports')
			->whereRaw('reports.tobedone_at < reports.done_at')
			->where(['done' => 1, 'seen' => 0])
			->leftjoin('students', 'reports.student_id', 'students.id')
			->leftjoin('sowars', 'reports.sowar_id', 'sowars.id')
			->where(['students.gender' => 'm', 'students.level_id' => $level_id])
			->select('students.id as student_id', 'full_name', 'tobedone_at', 'title', 'done_at', 'soraname', 'reports.id as report_id', 'islate', 'ayafrom', 'ayato', 'whole')
			->limit(100)->count();
	}
}