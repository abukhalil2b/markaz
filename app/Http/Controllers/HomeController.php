<?php

namespace App\Http\Controllers;

use App\Models\Frontpage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {


	public function loginToUserAccount(User $user) {
		if($user->id!=1){
			if(auth::user()->user_type=='admin'){
				Auth::onceUsingId($user->id);
				return redirect()->route('welcome');
			}			
		}
		abort(403);
	}


	public function welcome() {

		$frontpage = Frontpage::first();

		return view('welcome',compact('frontpage'));
	}

}
