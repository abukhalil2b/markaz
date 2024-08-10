<x-app-layout>

	<div class="p-3">

		@foreach($marks as $mark)
		<div class="bar3">
			<div>[{{ $mark->student_id }}] {{ $mark->student->full_name }} ( {{ $mark->total_point }} نقطة).</div>
		</div>
		@endforeach

	</div>

</x-app-layout>