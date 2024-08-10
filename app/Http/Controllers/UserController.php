<?php

namespace App\Http\Controllers;


use App\Models\Level;
use App\Models\Role;
use App\Models\User;
use App\Models\Workperiod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function userCreate()
    {

        $workperiods  = Workperiod::all();

        $levels  = Level::join('level_has_workperiod', 'levels.id', 'level_has_workperiod.level_id')
            ->select('levels.id', 'levels.title', 'workperiod_id')
            ->get();

        return view('admin.user.create', compact('workperiods', 'levels'));
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'user_type' => 'required',

            'first_name' => 'required',

            'second_name' => 'required',

            'third_name' => 'required',

            'last_name' => 'required',

            'gender' => 'required',

            'national_id' => 'required',

            'email' => 'required|unique:users',

        ]);
        // return $request->all();

        $user_type = $request->user_type;

        $first_name = $request->first_name;

        $second_name = $request->second_name;

        $third_name = $request->third_name;

        $last_name = $request->last_name;

        $gender = $request->gender;

        $national_id = $request->national_id;

        $email = $request->email;

        $workperiodIds = $request->workperiodIds ? json_decode($request->workperiodIds) : [1];
        // return $workperiodIds;
        //user will have first workperiod as default
        $workperiod_id =  $workperiodIds[0];

        $password = Hash::make('abcd1234');

        $plain_password = 'abcd1234';

        $bin = ' بن ';

        if ($gender == 'f') {
            $bin = ' بنت ';
        }

        $full_name = $first_name . $bin .  $second_name . ' بن ' . $third_name . ' ' . $last_name;

        $user = User::create([
            'user_type' => $user_type,
            'first_name' => $first_name,
            'second_name' => $second_name,
            'third_name' => $third_name,
            'last_name' => $last_name,
            'gender' => $gender,
            'national_id' => $national_id,
            'email' => $email,
            'workperiod_id' => $workperiod_id,
            'password' => $password,
            'plain_password' => $plain_password,
            'full_name' => $full_name,
        ]);

        $user->userHasWorkperiods()->attach($workperiodIds);

        switch ($user_type) {
            case 'male_moderator':
                $user->roles()->sync(2);
                break;

            case 'male_teacher':
                $user->roles()->sync(4);
                break;

            case 'female_moderator':
                $user->roles()->sync(3);
                break;

            case 'female_teacher':
                $user->roles()->sync(5);
                break;
        }
        return back();
    }


    /*  Admin    */
    public function userAdminIndex()
    {
        $users = user::where('user_type', 'admin')->where('id', '<>', 1)->get();

        $usergroup = 'الإدارة';

        return view('admin.user.index', compact('users', 'usergroup'));
    }

    /*  Teacher    */
    public function userMaleTeacherIndex()
    {

        $users = user::where(['user_type' => 'male_teacher'])->get();
        $usergroup = 'المدرسين';
        return view('admin.user.index', compact('users', 'usergroup'));
    }
    public function userFemaleTeacherIndex()
    {

        $users = user::where(['user_type' => 'female_teacher'])->get();
        $usergroup = 'المدرسات';
        return view('admin.user.index', compact('users', 'usergroup'));
    }

    /*  Moderator    */
    public function userMaleModeratorIndex()
    {

        $users = user::where(['user_type' => 'male_moderator'])
            ->get();
        $usergroup = 'المشرفين';
        return view('admin.user.index', compact('users', 'usergroup'));
    }
    public function userFemaleModeratorIndex()
    {

        $users = user::where(['user_type' => 'female_moderator'])->get();
        $usergroup = 'المشرفات';
        return view('admin.user.index', compact('users', 'usergroup'));
    }

    //impersonate
    public function enableImpersonate(User $user)
    {

        // Guard against administrator impersonate
        if (!$user->isAdministrator()) {
            auth()->user()->setImpersonating($user);
        } else {
            abort(403, 'لايمكن الدخول إلى هذا الحساب');
        }

        return redirect()->route('dashboard');
    }

    public function disableImpersonate()
    {
        auth()->user()->stopImpersonating();

        return redirect()->route('dashboard');
    }


    public function delete(User $user)
    {
        if (auth()->id() == 8 or auth()->id() == 1) {

            if ($user->user_type == 'admin' || $user->id == 1 || $user->id == 8) {
                abort(403, 'لايمكن حذف المستخدم.. هذا حساب اداري');
            }

            $this->userRelationTable($user, 'delete');

            return redirect()->route('dashboard');
        }
        abort(403, 'لاتملك الصلاحية');
    }

    public function adminProfile()
    {
        $user = auth()->user();

        return view('admin.profile', compact('user'));
    }

    /*  User    */
    public function show(User $user)
    {
        $workperiods = Workperiod::all();

        $userRelationTable = $this->userRelationTable($user, 'get-user-relation-table');

        // الرسائل المستلمة
        $messageReceiverCount = count($userRelationTable['messageReceiver']);

        // الرسائل المرسلة
        $messagesCount = count($userRelationTable['messages']);

        $notesCount = count($userRelationTable['notes']);

        $requestleavesCount = count($userRelationTable['requestleaves']);

        $storednotesCount = count($userRelationTable['storednotes']);

        $suggestionsCount = count($userRelationTable['suggestions']);

        $userRecorddailiesCount = count($userRelationTable['userRecorddailies']);

    
        return view('admin.user.show', compact(
            'workperiods',
            'user',
            'messageReceiverCount',
            'messagesCount',
            'notesCount',
            'requestleavesCount',
            'storednotesCount',
            'suggestionsCount',
            'userRecorddailiesCount'
        ));
    }



    private function userRelationTable($user, $operation)
    {

        $messageReceiverPermissions = DB::table('message_receiver_permissions')
            ->where('user_id', $user->id)
            ->orWhere('receiver_id', $user->id);

        $messageReceiver = DB::table('message_receiver')
            ->where('receiver_id', $user->id);

        $messages  = DB::table('messages')
            ->where('sender_id', $user->id);

        $notes  =   DB::table('notes')
            ->where('user_id', $user->id);

        $notifications  =   DB::table('notifications')
            ->where('notifiable_type', 'App\Models\User')
            ->where('notifiable_id', $user->id);

        $personalAccessToken  =  DB::table('personal_access_tokens')
            ->where('tokenable_type', 'App\Models\User')
            ->where('tokenable_id', $user->id);

        $requestleaves =  DB::table('requestleaves')
            ->where('user_id', $user->id);


        $storednotes =  DB::table('storednotes')
            ->where('user_id', $user->id);


        $suggestionpermissions =  DB::table('suggestionpermissions')
            ->where('user_id', $user->id);


        $suggestions =  DB::table('suggestions')
            ->where('user_id', $user->id);


        $userHasPermissions =  DB::table('user_has_permissions')
            ->where('user_id', $user->id);


        $userHasRoles =  DB::table('user_has_roles')
            ->where('user_id', $user->id);


        $userRecorddailies =  DB::table('user_recorddailies')
            ->where('user_id', $user->id);


        $userHasWorkperiod =  DB::table('user_has_workperiod')
            ->where('user_id', $user->id);

        if ($operation == 'delete') {

            $messageReceiverPermissions->delete();

            $messageReceiver->delete();

            $ids = $messages->pluck('id');

            $messageReceiver
                ->orWhereIn('message_id', $ids)
                ->delete();

            $messages->delete();

            $notes->delete();

            $notifications->delete();

            $personalAccessToken->delete();

            $requestleaves->delete();

            $storednotes->delete();

            $suggestionpermissions->delete();

            $suggestions->delete();

            $userHasPermissions->delete();

            $userHasRoles->delete();

            $userRecorddailies->delete();

            $userHasWorkperiod->delete();

            DB::table('users')
                ->where('id', $user->id)
                ->delete();

            return 'done';
        }

        if ($operation == 'get-user-relation-table') {

            $data['messageReceiver'] = $messageReceiver->get();

            $data['messages'] = $messages->get();

            $data['notes'] = $notes->get();

            $data['requestleaves'] = $requestleaves->get();

            $data['storednotes'] = $storednotes->get();

            $data['suggestions'] = $suggestions->get();

            $data['userRecorddailies'] =  $userRecorddailies->get();

            return $data;
        }

        abort(403);
    }
}
