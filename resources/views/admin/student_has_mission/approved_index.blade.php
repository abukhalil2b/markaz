<x-app-layout>

	<div class="py-5 text-xl">
		{{ $title }} ( {{ count($studentHasMissions) }} )
	</div>

	@foreach($studentHasMissions as $studentHasMission)

	@php

	if($studentHasMission->success == 0){
		$bgCssClass = 'bg-gray-200';
	}else{
		$bgCssClass = 'bg-green-100';
	}

	$moderatorCssClass = ' bg-gray-200 ';

	$adminCssClass = ' bg-gray-200 ';

	if($studentHasMission->step_approval == 1 || $studentHasMission->step_approval == 2){
		$moderatorCssClass = ' bg-green-200 border-green-600 ';
	}

	if($studentHasMission->step_approval == 2){
		$adminCssClass = ' bg-green-200 border-green-600 ';
	}

	@endphp
	<div class="mt-1 p-1">
		<div class="border border-green-800 rounded p-1 mt-3 w-full shadow {{$bgCssClass}}">
			<div>{{ $studentHasMission->id }}</div>

			<div class="flex gap-3">
				<div class="border rounded mt-3 p-1 {{ $moderatorCssClass }} ">
					اعتماد المشرف
				</div>

				<div class="border rounded mt-3 p-1 {{ $adminCssClass }} ">
					اعتماد الإدارة
				</div>
			</div>

			<div class="py-1 text-sm">{{$studentHasMission->full_name}}</div>

			<div class="py-1 text-xs text-gray-400">{{$studentHasMission->workperiod_title}}</div>

			<div class="py-1 text-red-800 font-bold"> {{$studentHasMission->mission_title}} </div>

			<div class="py-1 text-xs">بدأت: {{date('d-m-Y',$studentHasMission->start_at)}}</div>

			<div class="py-1">انتهت: {{date('d-m-Y',$studentHasMission->done_at)}}</div>

			<div class="py-1 text-xs">عدد المحاولات:
				{{$studentHasMission->try_number}}
			</div>

			<div class="py-1 text-xs">عدد التنبيهات:
				{{$studentHasMission->attention_number}}
			</div>

			<div class="py-1 text-xs">عدد التوقفات:
				{{$studentHasMission->stop_number}}
			</div>

			<div class="py-2 text-xs">عدد الأخطاء:
				{{$studentHasMission->numwrong}}

				@foreach(json_decode($studentHasMission->wrongs) as $wrong)
				<div>
					{{ $wrong->id }})
					{{ $wrong->note }}
				</div>
				@endforeach
			</div>

			<div class="py-1">التقييم: {{$studentHasMission->evaluation}}</div>

			<div class="py-1"> التقييم بواسطة: {{$studentHasMission->evaluated_name}}</div>

			<div class="py-1">ملحوظات: {{$studentHasMission->notes}}</div>
		</div>

		<div>
			@if(auth()->user()->permission('manage-mission'))

			<div class="mt-1 flex gap-5">
				<a class="btn btn-sm btn-outline-danger" href="{{ route('admin.student.mission_hesas.delete',['studentHasMission'=>$studentHasMission->id]) }}">
					حذف
				</a>
				<a class="btn btn-sm btn-outline-warning" href="{{ route('admin.student.mission_hesas.edit',['studentHasMission'=>$studentHasMission->id]) }}">
					تعديل
				</a>
			</div>

			@endif
		</div>
	</div>

	@endforeach

</x-app-layout>