<x-app-layout>

  <div class="p-3">
    آخر مهام ( {{ count($lastStudentMissionTasks) }} ) طالب
  </div>
  @foreach($lastStudentMissionTasks as $lastStudentMissionTask)
  <div class="p-1 mt-1 border rounded flex justify-between flex-col sm:flex-row">
    <div class="flex gap-1 items-center">
      <a href="{{route('admin.student.dashboard',['student'=>$lastStudentMissionTask->student_id])}}">
        <div>
          <span class="student-number ">{{$lastStudentMissionTask->student_id}}</span>
          {{ $lastStudentMissionTask->student_name }}
          <div class="mt-1 text-xs">
            {{ $lastStudentMissionTask->descr }}
          </div>
          <div class="mt-1 text-xs ">
            <span class="text-orange">التقدير: </span>
            {{ $lastStudentMissionTask->evaluation }}
          </div>
          @if($lastStudentMissionTask->done_at)
          <div class="mt-1 text-xs ">
            {{ Carbon\Carbon::parse($lastStudentMissionTask->done_at)->diffForHumans() }}
          </div>
          @endif
        </div>
      </a>
    </div>
  </div>
  @endforeach

</x-app-layout>