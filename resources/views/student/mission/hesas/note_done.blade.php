<x-app-layout>
	<h2 class="font-semibold text-xl text-gray-800 leading-tight">
		مسار الحصص التي لم تنجز
	</h2>
	@if(count($studentHasMissions))



				@foreach($studentHasMissions as $studenthasMission)

				<label class="border border-black bg-white my-3 w-full shadow
						{{$studenthasMission->done_at != NULL ?
							$studenthasMission->evaluation == 'لم ينجح'?
							'bg-gray-400'
							:
							'bg-green-200'
						 : ''}}
						">

					@if($studenthasMission->done_at != NULL)
					<div class="bg-green-400">
						تم إنجاز المهمة
					</div>
					@endif


					<a href="{{ route('admin.student.dashboard',$studenthasMission->student_id) }}">
						<div class="py-6 p-1 text-sm bg-[#d8d8d8]">
							<span class="student-number">{{ $studenthasMission->student_id }}</span>
							{{ $studenthasMission->full_name }}
						</div>
					</a>

					<div class="text-xs p-1 text-gray-400">{{$studenthasMission->workperiod_title}}</div>
					<div class="text-red-800 font-bold p-1"> {{$studenthasMission->mission_title}} </div>

					<div class="text-xs p-1">بدأت: {{date('d-m-Y',$studenthasMission->start_at)}}</div>
					@if($studenthasMission->done_at != NULL)
					<div>انتهت: {{date('d-m-Y',$studenthasMission->done_at)}}</div>

					@endif


				</label>

				@endforeach

	@endif

</x-app-layout>