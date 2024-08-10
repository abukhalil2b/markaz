<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function roleIndex()
	{

		$roles = Role::all();

		return view('role.index',
		 compact('roles'));
	}

	public function rolePermissionIndex($id)
	{
		$role = Role::find($id);
		$userPermissions = Permission::whereCate('user')->get();
		$teacherPermissions = Permission::whereCate('teacher')->get();
		$studentPermissions = Permission::whereCate('student')->get();
		$reportPermissions = Permission::whereCate('report')->get();
		$recordPermissions = Permission::whereCate('record')->get();
		$permissionPermissions = Permission::whereCate('permission')->get();
		$moderatorPermissions = Permission::whereCate('moderator')->get();
		$missionPermissions = Permission::whereCate('mission')->get();
		$levelPermissions = Permission::whereCate('level')->get();
		$busPermissions = Permission::whereCate('bus')->get();
		$appPermissions = Permission::whereCate('app')->get();
		$questionPermissions = Permission::whereCate('question')->get();
		$selectedstudentPermissions = Permission::whereCate('selectedstudent')->get();
		$monthlysubscribes = Permission::whereCate('monthlysubscribe')->get();
		$suggestions = Permission::whereCate('suggestion')->get();
		$requestleavePermissions = Permission::whereCate('requestleave')->get();
		$workperiodPermissions = Permission::whereCate('workperiod')->get();
		$coursePermissions = Permission::whereCate('course')->get();
		$semesterPermissions = Permission::whereCate('semester')->get();
		$dailyEvaluationPermissions = Permission::whereCate('daily_evaluation')->get();
		$subscriptionfeePermissions = Permission::whereCate('subscriptionfee')->get();
		$frontpagePermissions = Permission::whereCate('frontpage')->get();
		
		return view('role.permission.index',
		 compact('role',
		 'questionPermissions',
		 'busPermissions',
		 'levelPermissions',
		 'missionPermissions',
		 'moderatorPermissions',
		 'permissionPermissions',
		 'recordPermissions',
		 'reportPermissions',
		 'studentPermissions',
		 'teacherPermissions',
		 'userPermissions',
		 'appPermissions',
		 'selectedstudentPermissions',
		 'monthlysubscribes',
		 'suggestions',
		 'requestleavePermissions',
		 'workperiodPermissions',
		 'coursePermissions',
		 'semesterPermissions',
		 'dailyEvaluationPermissions',
		 'subscriptionfeePermissions',
		 'frontpagePermissions'
		));
	}

	public function rolePermissionStore(Request $request)
	{
		Role::find($request->role_id)->permissions()->sync($request->permission_ids);
		return redirect(route('role.index'));
	}
}
