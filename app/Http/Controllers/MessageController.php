<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\MessageReceived;

class MessageController extends Controller
{

    public function index()
    {

        //delete notification
        foreach (auth()->user()->unreadNotifications as $notification) {

            if ($notification->type == "App\Notifications\MessageReceived") {

                $notification->delete();
            }
        }

        $user = auth()->user();

        $receivedMessages = $user->receivedMessages()->orderby('id', 'desc')->get();

        $messageIds = $receivedMessages->pluck('pivot.message_id');

        //read all message
        $user->receivedMessages()->updateExistingPivot($messageIds, ['is_read' => 1]);

        $sentMessages = $user->messages()->orderby('id', 'desc')->get();


        return view('message.index', compact('receivedMessages', 'sentMessages'));
    }

    public function create()
    {

        $admins = User::where('user_type', 'admin')
            ->where('id', '<>', 1)
            ->get();

        $maleTeachers = User::whereHas('receiverPermission', function ($q) {
            $q->where('user_id', auth()->id());
        })
            ->where('user_type', 'male_teacher')
            ->get();

        $femaleTeachers = User::whereHas('receiverPermission', function ($q) {
            $q->where('user_id', auth()->id());
        })
            ->where('user_type', 'female_teacher')
            ->get();

        $maleModerators = User::whereHas('receiverPermission', function ($q) {
            $q->where('user_id', auth()->id());
        })
            ->where('user_type', 'male_moderator')
            ->get();

        $femaleModerators = User::whereHas('receiverPermission', function ($q) {
            $q->where('user_id', auth()->id());
        })
            ->where('user_type', 'female_moderator')
            ->get();

        return view('message.create', compact('admins', 'maleTeachers', 'femaleTeachers', 'maleModerators', 'femaleModerators'));
    }

    public function store(Request $request)
    {
        // return $request->receiverIds;
        $request->validate([
            'content' => 'required',
            'receiverIds' => 'required',
        ]);

        $message = Message::create([
            'content' => $request->content,
            'sender_id' => auth()->id(),
            // 'parent_id' => $request->parent_id,
        ]);

        $message->receivers()->attach($request->receiverIds);

        //notification
        $users = User::whereIn('id', $request->receiverIds)->get();

        foreach ($users as $user) {

            $user->notify(new MessageReceived);
        }

        return redirect()->route('message.index');
    }

    public function replayCreate(Message $message)
    {

        $messageReceiverId = $message->sender_id;

        $messageReceiverName = $message->sender->shortName;

        //check this message if was a replay for other message
        if($message->parent_id){
            //replay will be to this message
            $message = Message::find($message->parent_id);
        }

        // return $message;
        $messageReplays = Message::where('parent_id',$message->id)->get();
        
        return view('message.replay_create', compact('message','messageReplays','messageReceiverId','messageReceiverName'));
    }

    public function replayStore(Request $request)
    {
        // return $request->all();

        $request->validate([
            'content' => 'required',
        ]);

        $message = Message::create([
            'content' => $request->content,
            'sender_id' => auth()->id(),
            'parent_id' => $request->parent_id,
        ]);

        $message->receivers()->attach($request->receiver_id);

        //notification
        $user = User::find($request->receiver_id);

        $user->notify(new MessageReceived);

        return redirect()->route('message.index');
    }

    public function receiverIndex()
    {
        $admins = User::where('user_type', 'admin')
            ->where('id', '>', 1)
            ->get();

        $maleModerators = User::where('user_type', 'male_moderator')->get();

        $femaleModerators = User::where('user_type', 'female_moderator')->get();

        $maleTeachers = User::where('user_type', 'male_teacher')->get();

        $femaleTeachers = User::where('user_type', 'female_teacher')->get();

        return view('message.receiver.index', compact('admins', 'maleModerators', 'femaleModerators', 'maleTeachers', 'femaleTeachers'));
    }

    public function receiverPermissionIndex(User $user)
    {
        $permissionIds = DB::table('message_receiver_permissions')
            ->where(['message_receiver_permissions.user_id' => $user->id])
            ->join('users', 'message_receiver_permissions.receiver_id', '=', 'users.id')
            ->pluck('id')->toArray();

        $users = User::where('id', '>', 1)
            ->where('id', '<>', $user->id)
            ->get();

        $receivers = $users->map(function ($user) use ($permissionIds) {
            if (in_array($user->id, $permissionIds)) {
                $user->can_receive = true;
                return $user;
            } else {
                $user->can_receive = false;
                return $user;
            }
        });

        $admins = $receivers->filter(fn ($receiver) => $receiver->user_type == 'admin');

        $maleModerators = $receivers->filter(fn ($receiver) => $receiver->user_type == 'male_moderator');

        $femaleModerators = $receivers->filter(fn ($receiver) => $receiver->user_type == 'female_moderator');

        $maleTeachers = $receivers->filter(fn ($receiver) => $receiver->user_type == 'male_teacher');

        $femaleTeachers = $receivers->filter(fn ($receiver) => $receiver->user_type == 'female_teacher');

        // return $maleTeachers;

        return view('message.receiver.permission.index', compact('admins', 'maleModerators', 'femaleModerators', 'maleTeachers', 'femaleTeachers', 'user'));
    }

    public function receiverPermissionUpdate(Request $request, User $user)
    {
        if ($request->receiverIds) {

            $user->messageReceiverPermissions()->sync($request->receiverIds);

            return back();
        }
    }


    public function delete($ids)
    {

        $sentMessageIds = Message::where('sender_id', auth()->id())
            ->whereIn('id', $ids)
            ->pluck('id');

        DB::table('message_receiver')->whereIn('message_id', $sentMessageIds)->delete();

        Message::whereIn('id', $sentMessageIds)->delete();


        return 'success';
    }

    public function edit(Message $message)
    {
  
        $message = Message::where([
            'id' => $message->id,
            'sender_id' => auth()->id(),
        ])->first();

        if(! $message){
            abort(401);
        }

        return view('message.edit',compact('message'));
    }

    public function update(Request $request,Message $message)
    {
   
        $request->validate([
            'content' => 'required',
        ]);

        $message = Message::where([
            'id' => $message->id,
            'sender_id' => auth()->id(),
        ])->first();

        if(! $message){
            abort(401);
        }
       
        $message->update([
            'content' => $request->content
        ]);

        return redirect()->route('message.index');
    }
}
