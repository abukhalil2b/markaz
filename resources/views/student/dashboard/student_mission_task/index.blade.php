<x-student.layout>

    <!-- studentMissions -->
    <div class="p-3">

	<div class="mt-5">
		جدول المهام
	</div>
	@foreach($studentMissionTasks as $studentMissionTask)
	<div class="flex gap-1 items-center">
		<div class="w-7 h-7 rounded-full inline-flex justify-center text-xs items-center border !border-red-900 text-red-900 {{ $studentMissionTask->done_at != null ? ' bg-red-900 !text-white': '' }}">
			{{ $studentMissionTask->task_order }}
		</div>
		<a href="{{ route('student.mission.task.show',$studentMissionTask->id) }}" class="block mt-1 w-full p-1 border rounded-sm text-[10px] {{ $studentMissionTask->done_at != null ? 'bg-[#f7ecd3] !border-[#7f5418]' : ''}}">
			{{ __($studentMissionTask->mission_type) }}
			{{ $studentMissionTask->descr }}
		</a>
	</div>

	@endforeach

    </div>

</x-student.layout>