<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Requestleave;
use Illuminate\Http\Request;
use App\Notifications\UserLeave;


class RequestleaveController extends Controller
{

    public function userCreateLeave()
    {
        $loggedUserId = auth()->id();

        $requestleaves = Requestleave::where('user_id', $loggedUserId)
            ->latest('id')
            ->get();
        return view('requestleave.user_create_leave', compact('requestleaves'));
    }

    public function updateStatus(Requestleave $requestleave,$status)
    {
        $requestleave->update(['status'=>$status]);

        return back();
    }

    public function index()
    {

        //delete notification
        foreach (auth()->user()->unreadNotifications as $notification) {

            if ($notification->type == "App\Notifications\UserLeave") {

                $notification->delete();
            }
        }

        $requestleaves = Requestleave::orderBy('id', 'desc')
            ->get();

        $newRequestleaves = $requestleaves->filter(fn ($requestleave) => $requestleave->status == 'new');

        $approvedRequestleaves = $requestleaves->filter(fn ($requestleave) => $requestleave->status == 'approved');

        $rejectedRequestleaves = $requestleaves->filter(fn ($requestleave) => $requestleave->status == 'rejected');

        return view('admin.requestleave.index', compact('newRequestleaves', 'approvedRequestleaves', 'rejectedRequestleaves'));
        // return view('requestleave.index', compact('requestleaves'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'description' => 'required',
            'datefrom' => 'required',
            'dateto' => 'required'
        ]);

        $requestleave = Requestleave::create([
            'description'  => $request->description,
            'datefrom' => $request->datefrom,
            'dateto' => $request->dateto,
            'status' => 'new',
            'user_id' => auth()->id(),
            'gender' => auth()->user()->gender
        ]);

        //notify admin
        $user = User::find(8);

        $user->notify(new UserLeave($requestleave));

        return back()->with(['status' => 'success', 'message' => 'تم']);
    }


    public function destroy(Requestleave $requestleave)
    {
        $requestleave->delete();
        return back()->with(['status' => 'success', 'message' => 'تم']);
    }
}
