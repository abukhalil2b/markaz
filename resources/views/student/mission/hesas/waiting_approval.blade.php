<x-app-layout>
	<div class="py-4 font-bold text-xl text-gray-800 leading-tight">
		مسار الحصص التي تم انجازها ( {{ count($studentHasMissions) }} ) الغير معتمدة
	</div>
	<label class="p-3 cursor-pointer flex items-center gap-1 w-full bg-white">
		<input type="checkbox" onclick="studentCheckbox(this);" class="checkbox">
		<span class="bold">تحديد الكل</span>
	</label>
	@if(count($studentHasMissions))
	<form action="{{route('student.hesas_review_approve')}}" method="post">
		@csrf

		<div>
			@foreach($studentHasMissions as $studentHasMission)

			@php

				if($studentHasMission->success == 1){
					$cssClass = 'bg-green-100 border-green-600';
				}else{
				$cssClass = 'bg-gray-200 border-gray-600';
				}

				if($studentHasMission->done_at == NULL){
					$cssClass = '';
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

			<label class="border border-gray-100 rounded p-1 my-3 w-full shadow {{$cssClass}}">
				<div>{{ $studentHasMission->id }}</div>

				<input type="checkbox" name="ids[]" value="{{$studentHasMission->id}}" style="height: 22px; width: 22px;" class="studentCheckbox">

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

				@if($studentHasMission->done_at != NULL)
				<div class="py-1">انتهت: {{date('d-m-Y',$studentHasMission->done_at)}}</div>
				@endif

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

					@if($studentHasMission->wrongs)
					@foreach(json_decode($studentHasMission->wrongs) as $wrong)
					<div>
						{{ $wrong->id }})
						{{ $wrong->note }}
					</div>
					@endforeach
					@endif
				</div>

				<div class="py-1">التقييم: {{$studentHasMission->evaluation}}</div>

				<div class="py-1"> التقييم بواسطة: {{$studentHasMission->evaluated_name}}</div>

				<div class="py-1">ملحوظات: {{$studentHasMission->notes}}</div>


			</label>

			@endforeach


			<button class="btn btn-outline-secondary w-full">اعتمد</button>
		</div>
	</form>
	@endif


	<script>
		function studentCheckbox(source) {
			var checkboxes = document.querySelectorAll('.studentCheckbox');
			for (var i = 0; i < checkboxes.length; i++) {
				if (checkboxes[i] != source)
					checkboxes[i].checked = source.checked;
			}
		}
	</script>

</x-app-layout>