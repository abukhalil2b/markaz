<?php

namespace App\Http\Controllers\api;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helper\Helperfunction;
use App\Models\MissionTask;
use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Models\StudentMission;

class MissionController extends Controller
{
    public function store(Request $request)
    {
        // freeText => duaa - hesas
        if ($request->selectType == 'duaa' || $request->selectType == 'hesas') {
            $data = [
                'select_type' => $request->selectType,
                'descr' => $request->descr,
                'mission_id' => $request->mission_id,
                'mission_type' => $request->mission_type,
                'allow_wrong' => 1
            ];
        }
        
        if ($request->selectType == 'page') {
            $data = [
                'select_type' => 'page',
                'descr' => $request->descr,
                'mission_id' => $request->mission_id,
                'mission_type' => $request->mission_type,
                'page_number' => $request->page_number,
                'allow_wrong' => $request->allow_wrong
            ];
        }

        if ($request->selectType == 'oneSurat') {
            $data = [
                'select_type' => 'oneSurat',
                'descr' => $request->descr,
                'mission_id' => $request->mission_id,
                'mission_type' => $request->mission_type,
                'surat_id' => $request->oneSurat['id'],
                'allow_wrong' => $request->allow_wrong
            ];
        }

        if ($request->selectType == 'suratToSurat') {
            $data = [
                'select_type' => 'suratToSurat',
                'descr' => $request->descr,
                'mission_id' => $request->mission_id,
                'mission_type' => $request->mission_type,
                'from_surat_id' => $request->fromSurat['id'],
                'to_surat_id' => $request->toSurat['id'],
                'allow_wrong' => $request->allow_wrong
            ];
        }

        if ($request->selectType == 'ayaToAya') {
            $data = [
                'select_type' => 'ayaToAya',
                'descr' => $request->descr,
                'mission_id' => $request->mission_id,
                'mission_type' => $request->mission_type,
                'from_aya_id' => $request->from_aya_id,
                'to_aya_id' => $request->to_aya_id,
                'allow_wrong' => $request->allow_wrong
            ];
        }

        // we want see task_order for last task.
        // find last mission task, if not found then set task order = 1.
        $missionTask = MissionTask::where('mission_id', $request->mission_id)
            ->latest('task_order')
            ->first();

        if ($missionTask) {

            $last_task_order = $missionTask->task_order;

            $selected_mission_task_order = $request->selectedMissionTaskOrder;

            //if user want to order task after last mission task then we need to 
            // update task order for all next mission tasks.
            if ($selected_mission_task_order != null && $selected_mission_task_order < $last_task_order) {

                //get all task which need to update it's (task_order).
                $nextMissionTasks = MissionTask::where('mission_id', $request->mission_id)
                    ->where('task_order', '>', $selected_mission_task_order)
                    ->get();

                foreach ($nextMissionTasks as $nextMissionTask) {

                    MissionTask::where('id', $nextMissionTask->id)->update([
                        'task_order' => $nextMissionTask->task_order + 1
                    ]);
                }

                //store task with selected order
                $data['task_order'] = $selected_mission_task_order + 1;

                MissionTask::create($data);
            } else {
                $data['task_order'] = $last_task_order + 1;

                MissionTask::create($data);
            }
        } else {
            $data['task_order'] = 1;

            MissionTask::create($data);
        }

        // return $data;

        return  MissionTask::where('mission_id', $request->mission_id)
            ->orderby('task_order', 'desc')
            ->get();
    }

    public function delete(Request $request)
    {
        $missionTask = MissionTask::findOrFail($request->id);

        //we need update task order after deleted task
        $missionTasks =  MissionTask::where('task_order', '>', $missionTask->task_order)
            ->where('mission_id', $request->mission_id)
            ->get();

        $missionTask->delete();

        foreach ($missionTasks as $missionTask) {
            MissionTask::where('id', $missionTask->id)
                ->update(['task_order' => $missionTask->task_order - 1]);
        }

        return  MissionTask::where('mission_id', $request->mission_id)
            ->orderby('task_order', 'desc')
            ->get();
    }

    public function studentMissionTaskStore(Request $request)
    {
        $missionId = $request->missionId;

        $studentId = $request->studentId;

        $missionTasks = MissionTask::where('mission_id', $missionId)->get();

        $studentMission = StudentMission::create([
            'student_id' => $studentId,
            'mission_id' => $missionId
        ]);

        foreach ($missionTasks as $missionTask) {

            DB::table('student_mission_tasks')
                ->insert([
                    'student_mission_id' => $studentMission->id,
                    'student_id' => $request->studentId,
                    'mission_task_id' => $missionTask->id,
                    'task_order' => $missionTask->task_order,
                    'descr' => $missionTask->descr,
                    'select_type' => $missionTask->select_type,
                    'mission_type' => $missionTask->mission_type,
                    'from_aya_id' => $missionTask->from_aya_id,
                    'to_aya_id' => $missionTask->to_aya_id,
                    'from_surat_id' => $missionTask->from_surat_id,
                    'to_surat_id' => $missionTask->to_surat_id,
                    'page_number' => $missionTask->page_number,
                    'surat_id' => $missionTask->surat_id,
                    'allow_wrong' => $missionTask->allow_wrong
                ]);
        }

        return 'done';
    }
}
