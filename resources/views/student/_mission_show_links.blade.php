
<a class="block dropdown-item" href="{{route('student_has_mission.delete',['studentHasMission'=>$newMission->id])}}">
    حذف
</a>

<a class="block dropdown-item" href="{{route('student.mission.toggleDone',['student_id'=>$student->id,'mission_id'=>$newMission->mission_id])}}">
    @if($newMission->done) تغير إلى مهمة غير مكتملة @else تغير إلى مهمة مكتملة @endif
</a>