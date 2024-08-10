<x-app-layout>

	<h5 class="panel panel-success">{{__($tag)}}</h5>

	@foreach($marks as $mark)
	<div class="mt-3 panel">
		<div>[{{$mark->student_id}}] {{$mark->student->full_name}} ( {{$mark->total_point}} نقطة).</div>
	</div>
	@endforeach

</x-app-layout>