    <div class=" text-red-700 text-center">
        الإجازة في القراءة
    </div>
    <div class="mt-4 flex justify-center gap-3">
        <a href="{{ route('admin.student.mission.task.update_pass_reading',['studentMissionTask'=>$studentMissionTask->id,'status'=>'pass']) }}" class="block text-center w-32 btn-option {{ $studentMissionTask->pass_reading == 'pass' ? 'btn-option-selected' : '' }}">
            مجاز
        </a>
        <a href="{{ route('admin.student.mission.task.update_pass_reading',['studentMissionTask'=>$studentMissionTask->id,'status'=>'not-pass']) }}" class="block text-center w-32 btn-option {{ $studentMissionTask->pass_reading == 'not-pass' ? 'btn-option-selected' : '' }}">
            لم يُجز
        </a>
    </div>