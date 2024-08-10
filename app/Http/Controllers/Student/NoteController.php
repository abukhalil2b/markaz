<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Note;

class NoteController extends Controller
{
    public function index()
    {
        $student = auth()->user();

        //notes
        $notes = Note::where('student_id',$student->id)->latest('id')->paginate(100);
        
        return view('student.note.index', compact('notes'));
    }

}
