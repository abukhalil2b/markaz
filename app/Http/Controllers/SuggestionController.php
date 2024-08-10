<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Suggestion;
use App\Models\Suggestioncate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuggestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function suggestioncateIndex()
    {
        $loggedUser = auth()->user();
        $suggestioncates = Suggestioncate::whereHas('suggestionpermissions', function ($q) use ($loggedUser) {
            $q->where('user_id', $loggedUser->id);
        })->orderby('id', 'desc')->get();
        return view('suggestioncate.index', compact('suggestioncates'));
    }


    public function suggestioncateCreate()
    {
        return view('suggestioncate.create');
    }


    public function suggestioncateStore(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
            ]
        );
        $loggedUser = auth()->user();
        $suggestioncate = Suggestioncate::create($request->all());
        $suggestioncate->suggestionpermissions()->syncWithoutDetaching([$loggedUser->id, 1, 8]);
        return redirect()->route('suggestioncate.index')->with(['status' => 'success', 'message' => 'تم']);
    }


    public function suggestioncateShow(Suggestioncate $suggestioncate)
    {
        $loggedUser = auth()->user();
        //check permission
        $loggedUser->hasPermissionOnSuggestioncate($suggestioncate);

        //male teachers
        $maleteachers = User::where('user_type', 'male_teacher')
            ->whereDoesntHave('suggestionpermissions', function ($q) use ($suggestioncate, $loggedUser) {
                $q->where('suggestioncate_id', $suggestioncate->id);
            })->get();

        //female teachers
        $femaleteachers = User::where('user_type', 'female_teacher')
            ->whereDoesntHave('suggestionpermissions', function ($q) use ($suggestioncate, $loggedUser) {
                $q->where('suggestioncate_id', $suggestioncate->id);
            })->get();

        //male moderators
        $malemoderators = User::where('user_type', 'male_moderator')
            ->whereDoesntHave('suggestionpermissions', function ($q) use ($suggestioncate, $loggedUser) {
                $q->where('suggestioncate_id', $suggestioncate->id);
            })->get();

        //female moderators
        $femalemoderators = User::where('user_type', 'female_moderator')
            ->whereDoesntHave('suggestionpermissions', function ($q) use ($suggestioncate, $loggedUser) {
                $q->where('suggestioncate_id', $suggestioncate->id);
            })->get();
        return view('suggestioncate.show', compact('suggestioncate', 'maleteachers', 'femaleteachers', 'malemoderators', 'femalemoderators'));
    }


    public function suggestioncateEdit(Suggestioncate $suggestioncate)
    {
        return view('suggestioncate.edit', compact('suggestioncate'));
    }


    public function suggestioncateUpdate(Request $request, Suggestioncate $suggestioncate)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
            ]
        );

        $suggestioncate->update($request->all());

        return redirect()->route('suggestioncate.index')->with(['status' => 'success', 'message' => 'تم']);
    }


    //suggestion

    public function suggestionIndex(Suggestioncate $suggestioncate)
    {
        //check permission
        auth()->user()->hasPermissionOnSuggestioncate($suggestioncate);

        $suggestions = $suggestioncate->suggestions()->where('replay', 0)->orderby('id', 'desc')->get();

        return view('suggestion.index', compact('suggestions', 'suggestioncate'));
    }


    public function suggestionCreate(Suggestioncate $suggestioncate)
    {
        return view('suggestion.create', compact('suggestioncate'));
    }


    public function suggestionStore(Request $request)
    {
        $this->validate(
            $request,
            [
                'body' => 'required',
                'suggestioncate_id' => 'required'
            ]
        );
        $loggedUser = auth()->user();
        $request['user_id'] = $loggedUser->id;
        $suggestion = Suggestion::create($request->all());

        return redirect()->route('suggestion.index', ['suggestioncate' => $suggestion->suggestioncate_id])
            ->with(['status' => 'success', 'message' => 'تم']);
    }


    public function suggestionShow(Suggestion $suggestion)
    {
        return view('suggestion.show', compact('suggestion'));
    }


    public function suggestionEdit(Suggestion $suggestion)
    {
        $loggedUser = auth()->user();
        if ($loggedUser->user_type != 'admin' || $loggedUser->user_type != 'male_moderator' || $loggedUser->user_type != 'female_moderator') {
            //check permission
            if ($loggedUser->id == $suggestion->user_id) {
            } else {
                abort(403, 'لاتملك الصلاحية');
            }
        }
        return view('suggestion.edit', compact('suggestion'));
    }


    public function suggestionUpdate(Request $request, Suggestion $suggestion)
    {
        $this->validate(
            $request,
            [
                'body' => 'required',
            ]
        );

        $suggestion->update($request->all());

        return redirect()->route('suggestion.index', ['suggestioncate' => $suggestion->suggestioncate_id])
            ->with(['status' => 'success', 'message' => 'تم']);
    }


    public function suggestionDestroy(Suggestion $suggestion)
    {
        $loggedUser = auth()->user();
        if ($loggedUser->id == $suggestion->user_id) {
            //check if replay or main posts. if main post delete all its replay
            if (!$suggestion->reply) {
                $suggestion->replays()->delete();
            }
            $suggestion->delete();
            return redirect()->route('suggestioncate.index')
                ->with(['status' => 'success', 'message' => 'تم']);
        } else {
            return back()->with(['status' => 'warning', 'message' => 'لاتملك الصلاحية']);
        }
    }

    public function suggestionpermissionStore(Request $request, Suggestioncate $suggestioncate)
    {
        // return $request->all();
        if ($request->user_ids) {

            $suggestioncate->suggestionpermissions()->syncWithoutDetaching($request->user_ids);
        } else {

            DB::table('suggestionpermissions')
                ->where('suggestioncate_id', $suggestioncate->id)
                ->whereNotIn('user_id', [1,8])
                ->delete();
        }
        return redirect()->back();
    }

    public function suggestionpermissionDelete(User $user, Suggestioncate $suggestioncate)
    {
        if ($user->user_type == 'admin') {
            abort(403, 'لا يمكن حذف هذه الصلاحية');
        }
        DB::table('suggestionpermissions')->where(['user_id' => $user->id, 'suggestioncate_id' => $suggestioncate->id])->delete();
        return redirect()->back()->with(['status' => 'success', 'message' => 'تم']);
    }

    /*
        replay
    */
    public function suggestionReplayIndex(Suggestion $suggestion)
    {
        $replays = Suggestion::where(['parent' => $suggestion->id, 'replay' => 1])->get();
        return view('suggestion.replay.index', compact('replays', 'suggestion'));
    }

    public function suggestionReplayStore(Request $request)
    {
        $this->validate(
            $request,
            [
                'body' => 'required',
                'parent' => 'required'
            ]
        );

        $request['replay'] = 1;
        $loggedUser = auth()->user();
        $request['user_id'] = $loggedUser->id;
        Suggestion::create($request->all());

        return redirect()->route('suggestion.replay.index', ['suggestion' => $request->parent])
            ->with(['status' => 'success', 'message' => 'تم']);
    }

    public function suggestionReplayEdit(Suggestion $suggestion)
    {
        return view('suggestion.replay.edit', compact('suggestion'));
    }

    public function suggestionReplayUpdate(Request $request, Suggestion $suggestion)
    {
        $this->validate(
            $request,
            [
                'body' => 'required',
            ]
        );

        $suggestion->update(['body' => $request->body]);
        return redirect()->back()->with(['status' => 'success', 'message' => 'تم']);
        // return redirect()->route('suggestion.replay.index',['suggestion'=>$suggestion->id])
        // ->with(['status'=>'success','message'=>'تم']);
    }
}
