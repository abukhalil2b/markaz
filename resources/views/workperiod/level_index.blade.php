<x-app-layout>
	<div class="p-3">
		{{$workperiod->title}} - {{__($workperiod->gender)}}
	</div>

	<form action="{{route('workperiod.level_update',$workperiod->id)}}" method="post">
		@csrf

		@foreach($levels as $level)
		<label class="mt-2 p-2 border rounded">
			<input name="levelIds[]" type="checkbox" value="{{$level->id}}" @if($workperiod->hasLevel($level->id)) checked @endif>
			{{$level->title}}
		</label>
		@endforeach


		<button class="mt-4 btn btn-outline-secondary w-100"> تعديل </button>

	</form>

</x-app-layout>