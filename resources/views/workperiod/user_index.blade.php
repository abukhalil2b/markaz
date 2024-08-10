<x-app-layout>
	<div class="py-3 text-xl">
		{{$workperiod->title}} - {{__($workperiod->gender)}}
	</div>


	<form action="{{route('workperiod.user_update',$workperiod->id)}}" method="post">
		@csrf



		@foreach($users as $user)
		<label class="mt-4 panel hover:scale-y-95">
			<input name="userIds[]" type="checkbox" value="{{$user->id}}" @if($workperiod->hasUser($user->id)) checked @endif>
			{{$user->full_name}}
			<div class="text-xs text-gray-400">{{__($user->user_type)}}</div>
		</label>

		@endforeach


		<button class="mt-4 btn btn-outline-warning w-100"> تعديل </button>


	</form>

</x-app-layout>