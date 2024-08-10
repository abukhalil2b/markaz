<x-app-layout>
@include('requestleave._add_requestleave_modal')

		@foreach($requestleaves as $requestleave)
		<div class="mt-1 panel">
				<div class="row justify-center">
				
				<div class="mt-2 flex gap-1">
					الوصف
					<span class="text-pink-600 small">
						{{$requestleave->description}}
					</span>
				</div>
				<div class="mt-2 flex gap-1">
					من <span class="text-pink-600 small">{{$requestleave->datefrom}}</span>
					إلى <span class="text-pink-600 small">{{$requestleave->dateto}}</span>
				</div>

				<div class="mt-2 flex gap-1">
					تاريخ الطلب <span class="text-pink-600 small">{{$requestleave->created_at}}</span>
				</div>

				<div class="mt-2 flex gap-1">
					الحالة
					@if($requestleave->status=='new')
					<span class="text-pink-600 small">قيد الدراسة</span>
					@elseif($requestleave->status=='approved')
					<span class="text-green-400 font-bold">تمت الموافقة</span>
					@else
					<span class="text-red-400">تم الرفض</span>
					@endif
				</div>
				<a onclick="return confirm('هل متأكد من الحذف');"
					href="{{route('requestleave.destroy',$requestleave->id)}}" 
				 class="mt-5 btn-sm btn btn-outline-danger w-100" href="">حذف</a>
			</div>
		</div>
		@endforeach

	
</x-app-layout>