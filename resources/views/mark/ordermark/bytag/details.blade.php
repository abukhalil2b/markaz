<x-app-layout>
	<div class="py-4 text-xl">
		محور <span class="text-red-800">{{ __($tag) }}</span>
	</div>

	<form action="{{ route('mark.mark_orderby_tag_details',$tag) }}" method="POST" class="my-1 flex flex-col gap-1 items-end md:flex-row">
		@csrf
		<div class="w-full md:w-48">
			<label class="text-red-800">من تاريخ</label>
			<input type="date" class="h-12 form-input" name="datefrom" value="{{ $datefrom }}">
		</div>
		<div class="w-full  md:w-48">
			<label class="text-red-800">إلى تاريخ</label>
			<input type="date" class="h-12 form-input" name="dateto" value="{{ $dateto }}">
		</div>

		@if($userType == 'admin' || $userType == 'male_moderator' || $userType == 'female_moderator')
		<div class="w-full">
		<label class="text-red-800">القاعة</label>
			<select name="level_id" class="form-select h-12">
				<option value=""></option>
				@foreach($levels as $level)
				<option value="{{ $level->id }}">{{ $level->title }}</option>
				@endforeach
			</select>
		</div>
		@endif
		
		<button class="btn btn-outline-secondary w-full h-12">بحث</button>
	</form>

	<div class="py-2 bg-blue-800 p-1 rounded text-white text-xs">
		{{ $info }} . يتم عرض 50 طالبا فقط
	</div>

	@foreach($marks as $mark)
	<div class="mt-3 panel">
		<div>[{{$mark->student_id}}] {{$mark->student->full_name}} ( {{$mark->total_point}} نقطة).</div>
		<div class="text-red-800 text-xs">{{$mark->level_title}}</div>
	</div>
	@endforeach


</x-app-layout>