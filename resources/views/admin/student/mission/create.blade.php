<x-app-layout>
	<div class="p-3">
		{{ $student->full_name }}
	</div>

	<!-- mission tasks -->
	<div class="text-red-800 text-xl font-bold">
		{{ $mission->title }}
	</div>

	@if(count($missionTasks))
	<div x-data="adminStudentMissionTask" x-init="storeUrl = '{{ route('api.admin.student.mission_task_store') }}';
				missionId = {{ $mission->id }};
				studentId = {{ $student->id }}">

		<div x-data="{ show:false }">

			<div @click="show=true" class="mt-3 text-gray-500 text-xs hover:cursor-pointer">
				عرض خطة الحفظ التي سيمشي عليها الطالب
			</div>

			<div x-cloak x-show=" show " class="mt-2">
				@foreach($missionTasks as $key => $task)

				<div class="p-1 border rounded bg-white text-right text-xs">
					<div class="w-5 h-5 rounded-full inline-flex justify-center text-xs items-center bg-red-900 text-white">
						{{ $task->task_order }}
					</div>
					{{ $task->descr }}
				</div>

				@endforeach
			</div>

		</div>

		<div x-show="loading" class="mt-5 flex justify-center">
			<div class="loader"></div>
		</div>
		<div x-show=" ! loading && ! saved">

			<x-button-primary @click="save" class="mt-5 w-full">
				اعطاء الطالب هذه المهام
			</x-button-primary>
		</div>
		<div x-text="savedMessage" class="flex justify-center text-green-400"></div>

		<div x-cloak x-show="showRedirectUrl" class="mt-5 flex justify-center ">
			<a href="{{ route('admin.student.dashboard',$student->id) }}">
				صفحة الطالب
			</a>
		</div>

	</div>
	@else
	<div class="py-6 text-red-600 text-xl">
	لم يتم كتابة مهام
	</div>
	@endif

</x-app-layout>