<?php

namespace App\Http\Controllers;

use App\Models\UserRecorddaily;
use Illuminate\Http\Request;
use App\Helper\Helperfunction;
use App\Models\Recorddaily;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class UserRecorddailyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function moderatorIndex()
    {

        $todayDate = date('Y-m-d');

        $userRecordDailies = UserRecorddaily::whereIn('user_type', ['male_moderator','female_moderator'])
            ->whereDate('user_recorddailies.created_at', $todayDate)
            ->select(
                'users.id as user_id',
                'users.full_name as name',
                'users.user_type',
                'user_recorddailies.id as id',
                'user_recorddailies.moderator_seen',
                'user_recorddailies.should_be_present_at',
                'user_recorddailies.present_time',
                'user_recorddailies.note',
                'user_recorddailies.moderator_note'
            )->join('users', 'user_recorddailies.user_id', 'users.id')
            ->get();

        $user_type = 'المشرفين';

        return view('user_record_daily.index', compact('userRecordDailies', 'todayDate', 'user_type'));
    }

    public function teacherIndex()
    {
        $loggedUser = auth()->user();

        $todayDate = date('Y-m-d');

        $userRecordDailies = UserRecorddaily::whereIn('user_type', ['male_teacher','female_teacher'])
            ->whereDate('user_recorddailies.created_at', $todayDate)
            ->select(
                'users.id as user_id',
                'users.full_name as name',
                'users.user_type',
                'user_recorddailies.id as id',
                'user_recorddailies.moderator_seen',
                'user_recorddailies.should_be_present_at',
                'user_recorddailies.present_time',
                'user_recorddailies.note',
                'user_recorddailies.moderator_note'
            )->join('users', 'user_recorddailies.user_id', 'users.id')
            ->get();

        $user_type = 'المدرسين';

        /*--- moderator permissions ---*/
        if($loggedUser->user_type == 'male_moderator'){
            $userRecordDailies = $userRecordDailies->filter(fn($r)=>$r->user_type == 'male_teacher');
        }

        if($loggedUser->user_type == 'female_moderator'){
            $userRecordDailies = $userRecordDailies->filter(fn($r)=>$r->user_type == 'female_teacher');
        }

        return view('user_record_daily.index', compact('userRecordDailies', 'todayDate', 'user_type'));
    }

    public function details(User $user)
    {

        $userRecordDailies = UserRecorddaily::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('user_record_daily.details', compact('userRecordDailies', 'user'));
    }

    public function create()
    {
        return view('user_record_daily.create');
    }

    public function update(Request $request, UserRecorddaily $userRecorddaily)
    {
        if($userRecorddaily->present_time){
            die("<h1>تم تسجيل الحضور مسبقا</h1><a href='/dashboard'>عودة</a>");
        }
        // return $userRecorddaily;
        // return $request->all();
        $user = auth()->user();
        
        //check today
        $createdAt = Carbon::create($userRecorddaily->created_at);
        if(!$createdAt->isToday()){
            abort(403,'ليس تاريخ اليوم');
        }

        $userWorkperiod = Helperfunction::getUserWorkperiod();

        if ($userWorkperiod) {

            if ($user->user_type == 'male_moderator' || $user->user_type == 'female_moderator') {

                $shouldBePresentAt = Carbon::parse($userWorkperiod->moderator_should_be_present_at);
            }
            if ($user->user_type == 'male_teacher' || $user->user_type == 'female_teacher') {

                $shouldBePresentAt = Carbon::parse($userWorkperiod->teacher_should_be_present_at);
            }

            $timenow = Carbon::parse($request->timenow);

            if (!$timenow->lte($shouldBePresentAt)) {

                $length = Str::length($request->note);

                if ( ! $request->note || $length < 3 ) {

                    abort(403, 'إكتب سبب التأخر');

                } else {

                    $userRecorddaily->update(['present_time' => date('H:i:s'), 'islate' => 1, 'note' => $request->note]);
                }
            } else {

                $userRecorddaily->update(['present_time' => date('H:i:s'),'islate' => 0,'note'=>NULL]);
            }

            return redirect()->route('dashboard')->with(['status' => 'success', 'message' => 'تم']);
        }

        abort(404);
    }


    public function updateModeratorSeen(Request $request)
    {
        if ($request->ids) {
            UserRecorddaily::whereIn('id', $request->ids)->update([
                'moderator_seen' => 1
            ]);
        }
        
        return back();
    }

    public function editModeratorNote($userRecorddailyId)
    {
        $userRecorddaily = UserRecorddaily::where('id', $userRecorddailyId)
            ->with('user')
            ->firstOrFail();
        // return $userRecorddaily;
        return view('user_record_daily.moderator_note.edit', compact('userRecorddaily'));
    }

    public function updateModeratorNote(Request $request, UserRecorddaily $userRecorddaily)
    {
        // return $userRecorddaily;
        $userRecorddaily->update([
            'moderator_note' => $request->moderator_note
        ]);

        return redirect()->route('user_record_daily.index');
    }
}
