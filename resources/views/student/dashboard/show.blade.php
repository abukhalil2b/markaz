<x-student.layout>
<x-student-info-card :student="$student" />
	<!-- header -->
	<div class="bg-white w-full p-1">


		<div class="mt-2 flex justify-start items-center text-xs">
			أيام الدراسة:
			@if($student->study_days)
			@foreach( json_decode($student->study_days) as $day )

			<div class="mx-1"> {{ __($day) }} </div>

			@endforeach
			@endif
		</div>
		@if($attendance)
		<div class="mt-2 text-red-900">
			سجل:
			{{ $attendance->created_at->format('Y-m-d') }} .
			{{ $attendance->present_time ? 'حاضر ' . date('H:i',$attendance->present_time) : 'غائب' }}

		</div>
		@endif

		عدد مرات الغياب
		{{ $timesOfAbsence }}
		<a href="{{ route('student.dashboard.absence_details') }}" class="text-xs text-gray-500">التفاصيل</a>

		<div class="mt-2">
			<a href="{{ route('student.warning.absence_warn') }}" class="text-xs text-gray-500"> التحذير من عدد مرات الغياب والتأخر </a>
		</div>

	</div>



	<!-- memorize quran -->
	@include('student.dashboard.student_mission._quran')

	<!-- duaacate -->
	@include('student.dashboard.student_mission._duaa')


	<!-- hesas -->
	@include('student.dashboard.student_mission._hesas')

</x-student.layout>