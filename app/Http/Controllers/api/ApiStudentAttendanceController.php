<?php

namespace App\Http\Controllers\api;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helper\Helperfunction;
use App\Models\StudentHasRecordDaily;
use App\Http\Controllers\Controller;
use App\Models\StudentMission;

class ApiStudentAttendanceController extends Controller
{
    public function update(Request $request)
    {

        $studentHasRecordDaily = StudentHasRecordDaily::find($request->id);

        if ($studentHasRecordDaily->present_time == NULL) {

            $studentHasRecordDaily->update(['present_time' => time()]);

            return ['id' => $studentHasRecordDaily->id, 'present' => true];

        } else {

            $studentHasRecordDaily->update(['present_time' => NULL]);

            return ['id' => $studentHasRecordDaily->id, 'present' => false];
        }
    }
}
