	<!-- daily-->
	<div class="mt-4 bg-white border border-primary p-3 rounded dark:bg-gray-600">

		<div class="text-primary font-bold">
			<span class="mx-1">
				{{$latestRecorddaily->recorddaily_id}}
			</span>
			{{$latestRecorddaily->recorddaily_title}}
		</div>

		<div class="mt-4 flex flex-wrap gap-5">

			@if(auth()->user()->permission('record-manage'))
			<a class="w-40 btn btn-sm btn-outline-primary" href="{{ route('admin.record.daily.create',$latestRecorddaily->workperiod_id) }}" >
				+ فتح السجل اليومي
			</a>
			@endif

			<a class="w-40 btn btn-sm btn-outline-primary" href="{{ route('student.attendance.student_index',$latestRecorddaily->recorddaily_id) }}">
				عرض السجل للطلاب
			</a>

			<a class="w-40 btn btn-sm btn-outline-primary" href="{{ route('record.day.index',$latestRecorddaily->recorddaily_id) }}">
				عرض السجل للإدارة
			</a>

			<a class="w-40 btn btn-sm btn-outline-primary" href="{{ route('admin.recorddaily.index') }}">
				قائمة السجلات السابقة
			</a>

			<a class="w-40 btn btn-sm btn-outline-danger" href="{{ route('admin.record.daily.tobedelete',$latestRecorddaily->recorddaily_id) }}">
				حذف السجل اليومي
			</a>
		</div>

	</div>