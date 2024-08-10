<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Helperfunction;
use App\Http\Controllers\Controller;
use App\Models\Recorddaily;
use App\Models\UserRecorddaily;
use App\Models\Workperiod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $workperiod = Helperfunction::getUserWorkperiod();

        $user = auth()->user();
        
        $latestRecorddaily = Recorddaily::select(
            'workperiods.id as workperiod_id',
            'workperiods.title as workperiod_title',
            'student_should_be_present_at',
            'moderator_should_be_present_at',
            'teacher_should_be_present_at',
            'recorddailies.id as recorddaily_id',
            'recorddailies.title as recorddaily_title',
        )
            ->where('recorddailies.workperiod_id', $workperiod->id)
            ->join('workperiods', 'recorddailies.workperiod_id', '=', 'workperiods.id')
            ->latest('recorddailies.id')
            ->first();

        // return $user->user_type ;
        if (!$latestRecorddaily) {
            return redirect()->route('admin.record.daily.create',$workperiod->id);
        }

        if ($user->user_type == 'admin') {
            return $this->adminDashboard($user,$latestRecorddaily);
        }

        if ($user->user_type == 'male_moderator' || $user->user_type == 'female_moderator') {
            return $this->moderatorDashboard($user,$latestRecorddaily);
        }

        if ($user->user_type == 'male_teacher' || $user->user_type == 'female_teacher') {
            return $this->teacherDashboard($user,$latestRecorddaily);
        }

        abort(403);
    }

    /*-------------------------------------------------------------------------
| Admin Dashboard
|--------------------------------------------------------------------------*/

    private function adminDashboard($user,$latestRecorddaily)
    {

        return view('dashboard', compact(
            'user',
            'latestRecorddaily',
        ));
    }

    /*-------------------------------------------------------------------------
| Moderator Dashboard
|--------------------------------------------------------------------------*/

    private function moderatorDashboard($user,$latestRecorddaily)
    {
        $latestUserRecorddaily = UserRecorddaily::where('user_id', $user->id)
            ->latest('id')
            ->first();

        //if user not in record then we skip
        if ($latestUserRecorddaily) {

            // if today date is same as latestUserRecorddaily created date.
            // then we need check if user is registered as present.
            if (Str::substr($latestUserRecorddaily->created_at, 0, 10) == date('Y-m-d')) {

                if ($latestUserRecorddaily->present_time == NULL) {
                    return view('user_record_daily._user_attendance', compact(
                        'latestUserRecorddaily'
                    ));
                }
            }
        }

        return view('dashboard', compact(
            'user',
            'latestRecorddaily',
        ));
    }

    /*-------------------------------------------------------------------------
| Teacher Dashboard 
|--------------------------------------------------------------------------*/

    private function teacherDashboard($user,$latestRecorddaily)
    {
        $latestUserRecorddaily = UserRecorddaily::where('user_id', $user->id)
            ->latest('id')
            ->first();

        //if user not in record then we skip
        if ($latestUserRecorddaily) {

            // if today date is same as latestUserRecorddaily created date.
            // then we need check if user is registered as present.
            if (Str::substr($latestUserRecorddaily->created_at, 0, 10) == date('Y-m-d')) {

                if ($latestUserRecorddaily->present_time == NULL) {
                    return view('user_record_daily._user_attendance', compact(
                        'latestUserRecorddaily'
                    ));
                }
            }
        }

        return view('dashboard', compact(
            'user',
            'latestRecorddaily',
        ));
    }
}
