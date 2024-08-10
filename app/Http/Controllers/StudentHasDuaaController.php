<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentHasDuaa;
use App\Models\Student;
use App\Models\Duaa;

use App\Helper\Helperfunction;
use PhpParser\Node\Expr\Cast\Object_;

class StudentHasDuaaController extends Controller
{


    public function store(Request $request, Student $student)
    {

        // return $request->all();
        if ($request->ids) {
            $ids = $request->ids;

            foreach ($ids as $id) {
                StudentHasDuaa::create(['duaa_id' => $id, 'student_id' => $student->id, 'start_at' => date('Y-m-d')]);
            }

            return redirect()
                ->route('admin.student.dashboard', $student->id)->with(['status' => 'success', 'message' => 'تم']);
        }

        abort(404);
    }


    public function studentHasDuaaCreate(Student $student)
    {

        $studentDuaasIds = $student->duaas()->pluck('duaas.id')->toArray();

        //some duaa for male and the other is for female
        $duaas = Duaa::where('content_type', 'duaas')
            ->where(function ($q) use ($student) {
                $q->where('view_gender', $student->gender)
                    ->orWhere('view_gender', NULL);
            })->get();

            $doneDuaas = $duaas->map(function ($duaa) use ($studentDuaasIds) {
            $duaaObj['id'] = $duaa->id;
            $duaaObj['title'] = $duaa->title;
            $duaaObj['content'] = $duaa->content;
            $duaaObj['content_type'] = $duaa->content_type;
            $duaaObj['done'] = in_array($duaa->id, $studentDuaasIds);
            return (object) $duaaObj;
        });

        //some mutoons for male and the other is for female
        $mutoons = Duaa::where('content_type', 'mutoons')
            ->where(function ($q) use ($student) {
                $q->where('view_gender', $student->gender)
                    ->orWhere('view_gender', NULL);
            })->get();


        $doneMutoons = $mutoons->map(function ($mutoon) use ($studentDuaasIds) {
            $mutoonObj['id'] = $mutoon->id;
            $mutoonObj['title'] = $mutoon->title;
            $mutoonObj['content'] = $mutoon->content;
            $mutoonObj['content_type'] = $mutoon->content_type;
            $mutoonObj['done'] = in_array($mutoon->id, $studentDuaasIds);
            return  (object) $mutoonObj;
        })->values();

        return view('student_has_duaa.create', compact('student', 'doneDuaas', 'doneMutoons', 'studentDuaasIds'));
    }


    public function edit(StudentHasDuaa $studentHasDuaa)
    {
        return view('student.motoon_memorize_track.edit', compact('studentHasDuaa'));
    }

    public function update(Request $request, StudentHasDuaa $studentHasDuaa)
    {
        $request->validate(['evaluation' => 'required']);

        $message = ['status' => 'success', 'message' => 'تم']; //info for user
        return $request->all();
        if (!$request->done_at) {
            $request['done_at'] = date('Y-m-d H:i:s');
        }
        $request['notes'] = $request->note;
        $studentHasDuaa->update($request->all());

        if ($request->evaluation == 'لم ينجح') {
            $message = ['status' => 'warning', 'message' => 'تنبيه! لم ينجح وتم إعادة المهمة']; //info for user
            $newStudentHasDuaa = $studentHasDuaa->replicate();

            $newStudentHasDuaa->done_at = NULL;
            $newStudentHasDuaa->evaluation = NULL;
            $newStudentHasDuaa->numwrong = NULL;
            $newStudentHasDuaa->notes = NULL;

            $newStudentHasDuaa->save();
        } else {
            if ($request->point) {
                Helperfunction::createMark('memorizeDuaa', $request->point, $studentHasDuaa->student_id, '');
            }
        }

        return redirect()
            ->route('admin.student.dashboard', $studentHasDuaa->student_id)
            ->with($message);
    }


    public function delete(StudentHasDuaa $studentHasDuaa)
    {
        $studentHasDuaa->delete();
        return redirect()
            ->route('admin.student.dashboard', $studentHasDuaa->student_id)
            ->with(['status' => 'success', 'message' => 'تم']);
    }


    public function doneCreate(StudentHasDuaa $studentHasDuaa)
    {

        return view('student_has_duaa.done_create', compact('studentHasDuaa'));
    }
}
