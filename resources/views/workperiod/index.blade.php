<x-app-layout>

	<!-- start of create new workperiod -->
	@if(auth()->user()->permission('create_and_edit_workperiod'))
	@include('workperiod._add_workperiod_modal')
	@endif
	<!-- end of create new workperiod -->



	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="bar3"> فترات العمل
					<span> ({{ count($workperiods) }})</span>
					<div class="text-xs text-gray-400">
						تظهر هذه القائمة حسب الصلاحيات التي لديك
					</div>
				</div>

				@foreach($workperiods as $workperiod)
				<div class="mt-3 panel shadow {{$workperiod->gender=='m'? 'border-blue': 'border-orange'}}">
					{{$workperiod->id}} - {{$workperiod->title}}
					<div>
						@if($workperiod->gender == 'm')
						ذكور
						@else
						إناث
						@endif
					</div>
					<div class="mt-3 flex gap-2">
						<a class="btn btn-outline-secondary" href="{{route('workperiod.level_index',$workperiod->id)}}">
							القاعات
							({{$workperiod->levelCount()}})
						</a>
						<a class="btn btn-outline-secondary" href="{{route('workperiod.user_index',$workperiod->id)}}">
							الطاقم الإاري
							({{$workperiod->userCount()}})
						</a>
						<a class="btn btn-outline-secondary" href="{{route('workperiod.edit',$workperiod->id)}}">تعديل</a>
						<a class="btn btn-outline-secondary" onclick="return confirm('are u sure')" href="{{route('workperiod.destroy',$workperiod->id)}}">حذف</a>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>


</x-app-layout>