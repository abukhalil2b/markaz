<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workperiod;
use App\Models\User;
use App\Models\Level;
use App\Models\Student;
use App\Helper\Helperfunction;

class WorkperiodController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$loggedUser = auth()->user();
		$workperiods = $loggedUser->userHasWorkperiods()->get();
		// $workperiods = Workperiod::all();
		return view('workperiod.index', compact('workperiods'));
	}

	public function store(Request $request)
	{
		$adminUsers = User::where('user_type', 'admin')->pluck('id');

		// return $request->all();
		$data = $request->validate([
			'title' => 'required',
			'student_award_time'=>'required',
			'student_should_be_present_at' => 'required',
			'moderator_should_be_present_at' => 'required',
			'teacher_should_be_present_at' => 'required',
			'gender' => 'required',
		]);

		$workperiod = Workperiod::create($data);

		$workperiod->userHasWorkperiods()->attach($adminUsers);

		return back();
	}

	public function update(Workperiod $workperiod, Request $request)
	{
		$data = $request->validate([

			'title' => 'required',

			'student_should_be_present_at' => 'required',

			'moderator_should_be_present_at' => 'required',

			'teacher_should_be_present_at' => 'required'

		]);

		if($workperiod->id == 1 || $workperiod->id == 7){
			abort(403,'this workperiod cannot be updated');
		}

		$workperiod->update($data);
		
		return redirect()->route('workperiod.index');
	}

	public function edit(Workperiod $workperiod)
	{
		return view('workperiod.edit', compact('workperiod'));
	}

	public function destroy(Workperiod $workperiod)
	{

		if ($workperiod->id == 1 || $workperiod->id == 7) {
			abort(403, 'هذه الفترة الإفتراضية ولايمكن حذفها');
		}

		if ($workperiod->userCount() || $workperiod->levelCount()) {
			abort(403, 'يجب أن تحذف الإرتباطات أولا');
		}

		//admin users
		User::where(['workperiod_id'=>$workperiod->id,'user_type'=>'admin'])->update(['workperiod_id'=>1]);
		
		//male users
		User::where(['workperiod_id'=>$workperiod->id,'gender'=>'m'])->update(['workperiod_id'=>1]);

		//female users
		User::where(['workperiod_id'=>$workperiod->id,'gender'=>'f'])->update(['workperiod_id'=>7]);

		$workperiod->userHasWorkperiods()->detach();

		$workperiod->delete();

		return redirect()->route('workperiod.index');
	}

	public function workperiodLevelIndex(Workperiod $workperiod)
	{

		$levels = Level::where('gender', $workperiod->gender)->get();

		return view('workperiod.level_index', compact('workperiod', 'levels'));
	}

	public function workperiodLevelUpdate(Request $request, Workperiod $workperiod)
	{
		// return $request->all();
		if ($request->levelIds) {
			$workperiod->levelHasWorkperiods()->sync($request->levelIds);
		} else {
			$workperiod->levelHasWorkperiods()->detach();
		}

		return back();
	}

	public function workperiodUserIndex(Workperiod $workperiod)
	{

		$users = User::where('gender', $workperiod->gender)->get();

		return view('workperiod.user_index', compact('workperiod', 'users'));
	}

	public function workperiodUserUpdate(Request $request, Workperiod $workperiod)
	{
		// return $request->all();
		if ($request->userIds) {
			$workperiod->userHasWorkperiods()->sync($request->userIds);
			$adminUsers = User::where('user_type', 'admin')->pluck('id');
			$workperiod->userHasWorkperiods()->attach($adminUsers);
		} else {
			$workperiod->userHasWorkperiods()->detach();
			$adminUsers = User::where('user_type', 'admin')->pluck('id');
			$workperiod->userHasWorkperiods()->attach($adminUsers);
		}

		return redirect()->route('workperiod.index')
			->with(['status' => 'success', 'message' => 'تم']);
	}

	public function changeWorkperiod(Workperiod $workperiod)
	{
		$loggedUser = auth()->user();
		if ($loggedUser->user_type != 'admin') {
			$loggedUser->canChangeWorkperiod($workperiod);
		}
		User::find($loggedUser->id)->update(['workperiod_id' => $workperiod->id]);
		return redirect()->route('dashboard');
	}


	public function userHasWorkperiodPermissionUpdate(Request $request, User $user)
	{
		if ($request->workperiodId) {
			$user->userHasWorkperiods()->sync($request->workperiodId);
			$user->update(['workperiod_id' => $request->workperiodId[0]]);
		}
		return redirect()->route('dashboard');
	}
}
