<x-app-layout>
	<h2 class="font-semibold text-xl text-gray-800 leading-tight">
		الطلاب المعطلين {{count($students)}}
	</h2>

	<div>
		@foreach($students as $student)
		<div>
			<span class="text-blue-800 font-bold">{{ $student->id }}</span> 
			{{ $student->full_name }}
		</div>
		@endforeach
	</div>

</x-app-layout>