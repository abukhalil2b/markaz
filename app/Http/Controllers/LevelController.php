<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Workperiod;
use App\Models\User;
use App\Models\Level;
use App\Models\Student;
use App\Models\Recorddaily;
use App\Helper\Helperfunction;
class LevelController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		$userWorkperiod = Helperfunction::getUserWorkperiod();
		
		$levels = $userWorkperiod->levelHasWorkperiods()->get();

		$workperiods = Workperiod::get();
		return view('level.index', compact('levels','workperiods','userWorkperiod'));
	}

	public function store(Request $request) {
		$request->validate(['title'=>'required']);
		$userWorkperiod = Helperfunction::getUserWorkperiod();
		if($userWorkperiod->gender == 'm'){
			$request['gender'] = 'm';
		}else{
			$request['gender'] = 'f';
		}
		$level = Level::create($request->all());
		$level->levelHasWorkperiods()->attach($userWorkperiod->id);
		return redirect()->back()
		->with(['status' => 'success','message'=>'تم']);
	}

	public function edit($id) {
		$workperiods = Workperiod::all();
		$level = Level::find($id);
		return view('level.edit', compact('level','workperiods'));
	}

	public function update(Request $request) {
		Level::where('id', $request->id)
		->update([
			'title' => $request->title,
			'description'=>$request->description
		]);
		return redirect()->route('level.index')
		->with(['status' => 'success','message'=>'تم']);
	}

	public function levelStudent(Level $level) {
		$userWorkperiod = Helperfunction::getUserWorkperiod();

		//check user has permission on level
		$level->levelHasWorkperiodPermission(auth()->user()->workperiod_id);

		$students = Student::where([
			'level_id' => $level->id,
			'status' => 'active',
			'workperiod_id'=>$userWorkperiod->id
		])->get();

		return view('level.student', compact('students',  'level'));
	}

	public function shiftStudentToOtherLevelCreate(Level $level){
		$students = $level->students()->get();
		$levels = Level::all();
		$loggedUser = auth()->user();
		if($loggedUser->user_type !='admin'){
			$loggedUser->load('userHasWorkperiods.levelHasWorkperiods');
			$levels = $loggedUser->userHasWorkperiods
			->pluck('levelHasWorkperiods')
			->collapse();
			// return $levels;
		}else{
			$levels = Level::all();
		}
		return view('level.shift_student_to_other_level_create',compact('level','students','levels'));
	}

	public function shiftStudentToOtherLevelStore(Request $request){
		// return $request->all();

		$studentIds = $request->studentIds;
		$level = Level::findOrFail($request->level_id);
		if($studentIds){
			Student::whereIn('id',$studentIds)->update(['level_id'=>$level->id]);
		}
		
		return redirect()->route('level.index')
		->with(['status'=>'success','message'=>'تم']);
	}
	
}