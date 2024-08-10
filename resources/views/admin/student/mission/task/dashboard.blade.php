<x-app-layout>
	<a href="{{ route('admin.student.dashboard',$student->id) }}" class="btn btn-outline-secondary">
		<x-svgicon.back_arrow />
		<span class="mx-2">{{ $student->full_name }}</span>
	</a>

	<!-- info -->
	@if($studentMissionTask)
	<div>
		<div>
			@if($studentMissionTask->half_done_at)
			<div class="text-sm p-3 flex justify-center bg-orangeLight text-red-800">
				أنجز نصف المهمة بتاريخ: {{ $studentMissionTask->half_done_at }}
			</div>
			<div class="text-red-400 text-center">
				{!! nl2br($studentMissionTask->note) !!}
			</div>
			@endif
		</div>
		<div class="text-center text-brown py-2 text-xl">
			{{ __($studentMissionTask->mission_type) }}
		</div>
		<div class="text-center text-xl font-bold">
			{{ $studentMissionTask->descr }}
		</div>
		<!-- reading status -->
		<div class="mt-2 text-red-700 text-xs text-center">
			{{ $studentMissionTask->pass_reading == 'not-pass' ? 'لم يُجز في التلاوة' : '' }}
		</div>
	</div>
	@else
	<div class="p-5 flex justify-center">
		<div class="flex gap-1 items-center">
			<div class="rounded-full bg-red-900 p-1.5 text-white ltr:mr-3 rtl:ml-3">
				<x-svgicon.done />
			</div>

			<div class="h-10 text-xl">تم إنجاز جميع المهام</div>
		</div>
	</div>
	@endif

	@if($studentMissionTask)
	<div class="p-1">

		@if( !in_array($studentMissionTask->select_type,['duaa','hesas']) )
		<div class="w-full mt-6 flex justify-center">
			<a href="{{ route('admin.student.task.quran',$studentMissionTask->id) }}" target="_blank" class="block w-32 border rounded text-center">
				عرض الآيات
			</a>
		</div>
		@endif

		<!-- mission task half done -->
		@if( !in_array($studentMissionTask->select_type,['duaa','hesas']) )
		<div class="mt-6 flex justify-center">
			<a class="flex justify-center w-32 border rounded" href="{{ route('admin.student.mission.task.half_done_edit',$studentMissionTask->id) }}"> نصف المهمة</a>
		</div>
		@endif

		<!-- free text -->
		@if( in_array($studentMissionTask->select_type,['duaa','hesas']) )

		<div class="mt-6">
			@include('admin.student.mission.task._update_free_text')
		</div>

		@else

		<!-- free text -->
		<div>
			@if($studentMissionTask->mission_type == 'review')
			@include('admin.student.mission.task._done')
			@else
			<div>
				@if($studentMissionTask->pass_reading == 'pass')
				<div>
					@include('admin.student.mission.task._done')
				</div>
				@else
				<div class="mt-6">
					@include('admin.student.mission.task._update_reading_status')
				</div>
				@endif
			</div>
			@endif
		</div>

		@endif

	</div>
	@endif

	<!--جدول المهام -->
	<div class="mt-5">
		جدول المهام
	</div>
	@foreach($studentMissionTasks as $studentMissionTask)

	@php

	$barCssClass = "";

	if($studentMissionTask->done_at != null){
	$barCssClass = " bg-[#f7ecd3] !border-[#7f5418] ";
	}

	if($studentMissionTask->evaluation == 'لم ينجح'){
	$barCssClass = " bg-gray-400 !border-[#7f5418] ";
	}

	if($studentMissionTask->select_type == 'hesas' || $studentMissionTask->select_type == 'duaa'){
	$barCssClass = " !bg-[#ffd576] ";
	}

	@endphp

	<div class="flex gap-1 items-center">
		<a href="{{ route('admin.student.mission.task.show',$studentMissionTask->id) }}" class="flex justify-between mt-1 w-full p-1 border rounded-sm text-[10px] {{ $barCssClass }}">
			<div>
				<div class="w-7 h-7 rounded-full inline-flex justify-center text-xs items-center border !border-red-900 text-red-900 {{ $studentMissionTask->done_at != null ? ' bg-red-900 text-white': '' }}">
					{{ $studentMissionTask->task_order }}
				</div>
				{{ __($studentMissionTask->mission_type) }}
				{{ $studentMissionTask->descr }}
			</div>
			@if($studentMissionTask->done_at)
			<div class="mr-8 text-[10px] text-red-800">تمت بتاريخ: {{ $studentMissionTask->done_at }}</div>
			@endif
		</a>
	</div>




	<a href="{{ route('admin.student.mission.task.create_new',$studentMissionTask->id) }}" class="flex items-center h-3 opacity-0 hover:opacity-100 hover:h-6">
		<span class="p-2 w-6 h-6 flex items-center justify-center text-xl">+</span>
	</a>
	@endforeach

</x-app-layout>