<div x-data="{show:false}" class="mt-4 bg-white border border-primary p-3 rounded dark:bg-gray-600">
	<div>
		<span class="text-xl text-primary"> {{ $latestRecorddaily->workperiod_title }} </span>
		<span x-show=" ! show" x-cloack @click="show=true" class="cursor-pointer text-blue-800 dark:text-gray-400">تفاصيل</span>
	</div>

	<div x-show="show">

		<div class="card-subtitle">
			وقت حضور الطالب:
			{{ $latestRecorddaily->student_should_be_present_at }}
		</div>

		<div class="card-subtitle">
			وقت حضور المشرف:
			{{ $latestRecorddaily->moderator_should_be_present_at }}
		</div>

		<div class="card-subtitle">
			وقت حضور المدرس:
			{{ $latestRecorddaily->teacher_should_be_present_at }}
		</div>
	</div>

</div>