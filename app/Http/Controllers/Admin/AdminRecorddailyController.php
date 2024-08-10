<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Helper\Helperfunction;
use App\Models\Recorddaily;

class AdminRecorddailyController extends Controller {

	public function index() {

		$workperiod = Helperfunction::getUserWorkperiod();

		$recorddailies = Recorddaily::where('workperiod_id',$workperiod->id)->get();

		return view('admin.recorddaily.index',compact('recorddailies'));
	}

}
