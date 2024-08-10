<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Warning;
class StudentUnderObservationController extends Controller
{

    public function setUnderObservation(Student $student)
    {
        $student->under_observation = 1;

        $student->save();

        return back();
    }

    public function removeUnderObservation(Student $student)
    {
        $student->under_observation = 0;

        $student->save();

        return back();
    }

}
