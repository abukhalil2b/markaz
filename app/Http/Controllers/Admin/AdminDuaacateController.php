<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Duaacate;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class AdminDuaacateController extends Controller
{

    public function dashboard()
    {
        $duaacates = Duaacate::whereNull('duaacate_id')
            ->with('childs')
            ->get();

        return view('admin.duaacate.dashboard', compact('duaacates'));
    }

    public function parentStore(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'title' => 'required'
        ]);

        Duaacate::create([
            'title' => $request->title
        ]);

        return back();
    }

    public function parentUpdate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        Duaacate::where(['id' => $request->duaacate_id])
            ->update([
                'title' => $request->title
            ]);

        return back();
    }


    public function childStore(Request $request)
    {
        // return $request->all();

        $this->validate($request, [
            'title' => 'required',
            'duaacate_id' => 'required',
        ]);

        Duaacate::create([
            'title' => $request->title,
            'duaacate_id' => $request->duaacate_id
        ]);

        return back();
    }

    public function childUpdate(Request $request)
    {
        // return $request->all();

        $this->validate($request, [
            'title' => 'required',
            'duaacate_id' => 'required',
        ]);

        Duaacate::where(['id' => $request->duaacate_id])->update([
            'title' => $request->title,
        ]);

        return back();
    }

    public function studentDuaacateDashboard(Student $student)
    {
        $studentDuaacateIds = DB::table('duaacate_student')
            ->where('student_id', $student->id)
            ->pluck('duaacate_id')
            ->toArray();

        $duaacatesWithChilds = Duaacate::whereNull('duaacate_id')
            ->with('childs')
            ->get();

        $duaacates = $duaacatesWithChilds->map(function ($duaacate) use ($studentDuaacateIds) {
            $duaacateObj = new stdClass;

            $duaacateObj->id = $duaacate->id;

            $duaacateObj->title = $duaacate->title;

            $duaacateObj->childs = $duaacate->childs->map(function ($child) use ($studentDuaacateIds) {
                $childObj = new stdClass;

                $childObj->id = $child->id;

                $childObj->title = $child->title;

                $childObj->done = in_array($child->id, $studentDuaacateIds);

                return $childObj;
            });

            return $duaacateObj;
        });

        // return $duaacates;

        return view('admin.student.duaacate.dashboard', compact('duaacates', 'student'));
    }

    public function update(Request $request, Duaacate $duaacate)
    {
        //
    }

    public function destroy(Duaacate $duaacate)
    {
        //
    }
}
