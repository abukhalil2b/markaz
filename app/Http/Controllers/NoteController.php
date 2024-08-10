<?php

namespace App\Http\Controllers;

use App\Helper\Helperfunction;
use App\Models\Note;

use Illuminate\Http\Request;

class NoteController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}
	
	public function show(Note $note) {
		return view('admin.note.show',compact('note'));
	}

	public function delete(Note $note) {
		$note->delete();
		return redirect()->route('admin.note.index');
	}



	public function edit(Note $note) {
		return view('admin.note.edit',compact('note'));
	}

	public function update(Request $request,Note $note) {

		$note->update([
			'action' => $request->action,
		]);
		
		return redirect()->route('admin.note.index');
	}

	public function index()
	{
		$userWorkperiod = Helperfunction::getUserWorkperiod();

		$whereFields = ['students.workperiod_id' => $userWorkperiod->id];

		$loggedUser = auth()->user();

		if ($loggedUser->user_type == 'male_teacher' || $loggedUser->user_type == 'female_teacher') {
			$whereFields = ['students.workperiod_id' => $userWorkperiod->id, 'students.level_id' => $loggedUser->level_id];
		}

		$notes = Note::whereHas('student', function ($q) use ($whereFields) {
			$q->where($whereFields);
		})->orderby('id', 'desc')
			->get();

		return view('admin.note.index', compact('notes'));
	}


}
