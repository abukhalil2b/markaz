<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Helper\Helperfunction;
use App\Models\UserRecorddaily;
use App\Models\Recorddaily;
use App\Models\User;
use App\Models\Workperiod;

class AdminUserRecorddailyController extends Controller
{

    public function create(User $user)
    {

        $latestUserRecorddaily = UserRecorddaily::where('user_id', $user->id)
            ->latest('id')
            ->first();

        // return $user->user_type ;
        if (!$latestUserRecorddaily) {
            abort(404);
        }

        return view('admin.user_record_daily.create', compact('user', 'latestUserRecorddaily'));
    }

    public function update(Request $request, UserRecorddaily $userRecorddaily)
    {
        $request->validate([
            'note' => 'required'
        ]);

        $userRecorddaily->update(['present_time' => date('H:i:s'), 'islate' => 1, 'note' => $request->note]);

        return redirect()->route('user_record_daily.teacher.index');
    }
}
