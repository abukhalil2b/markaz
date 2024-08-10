<?php

namespace App\Helper;

use App\Models\DailyEvaluation;
use App\Models\Mark;
use App\Models\Recordmonthly;
use App\Models\Recorddaily;
use App\Models\User;
use App\Models\Workperiod;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Helperfunction
{

    //create mark for student with tags.
    static function createMark($tag, $point, $student_id, $note = NULL, $student_mission_task_id = NULL)
    {

        Mark::create([
            'student_id' => $student_id,
            'tag' => $tag,
            'note' => $note,
            'point' => $point,
            'student_mission_task_id' => $student_mission_task_id
        ]);
    }


    //get number day from string name day
    static function getDayNameAsNumber($dayOfWeek)
    {

        switch ($dayOfWeek) {
            case 'Sun':
                return 1;
            case 'Mon':
                return 2;
            case 'Tue':
                return 3;
            case 'Wed':
                return 4;
            case 'Thu':
                return 5;
            case 'Fri':
                return 6;
            case 'Sat':
                return 7;
            default:
                return 1;
        }
    }


    static function getUserWorkperiod()
    {
        $loggedUser = auth()->user();

        $workperiod = Workperiod::find($loggedUser->workperiod_id);

        if ($workperiod) {
            return $workperiod;
        }

        if ($loggedUser->gender == 'm' || $loggedUser->user_type == 'admin') {
            $loggedUser->update(['workperiod_id' => 1]);
            // workperiod id(1) is default for male and we will not allow to be deleted.
            return Workperiod::find(1);
        }

        if ($loggedUser->gender == 'f') {
            $loggedUser->update(['workperiod_id' => 7]);
            // workperiod id(7) is default for female and we will not allow to be deleted.
            return Workperiod::find(7);
        }
    }


    static function getLastRecordDaily()
    {

        $workperiodId = auth()->user()->workperiod_id;

        return Recorddaily::orderBy('id', 'desc')
            ->where(['workperiod_id' => $workperiodId])
            ->first();
    }

    static function getLastRecordDailyOpenedToday()
    {

        $workperiodId = auth()->user()->workperiod_id;
        $todayDate =  date('Y-m-d');
        return Recorddaily::orderBy('id', 'desc')
            ->whereDate('created_at', $todayDate)
            ->where(['workperiod_id' => $workperiodId])
            ->first();
    }

    static function getWeekDays()
    {
        return [
            'Sun',
            'Mon',
            'Tue',
            'Wed',
            'Thu',
            'Fri',
            'Sat',
        ];
    }

    static function DailyEvaluationStore($level_id,$student_id,$full_name,$evaluation,$studentMissionTaskDescr,$model_type,$studentMissionTaskId){
        DailyEvaluation::create([
			'level_id' => $level_id,
			'student_id' => $student_id,
			'evaluation' => $evaluation,
			'full_name' => $full_name,
			'descr' => $studentMissionTaskDescr,
			'model_type' => $model_type,
			'model_id' => $studentMissionTaskId,
		]);
    }
}
