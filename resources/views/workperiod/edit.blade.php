<x-app-layout>


	<form action="{{route('workperiod.update',$workperiod->id)}}" method="post">
		@csrf

		<div>
			<input name="title" value="{{$workperiod->title}}" class="form-input">
		</div>

		<div class="py-2">
			وقت حضور الطالب:
			<input type="time" name="student_should_be_present_at" value="{{$workperiod->student_should_be_present_at}}" class="form-input">
		</div>

		<div class="py-2">
			وقت حضور المشرف:
			<input type="time" name="moderator_should_be_present_at" value="{{$workperiod->moderator_should_be_present_at}}" class="form-input">
		</div>

		<div class="py-2">
			وقت حضور المدرس:
			<input type="time" name="teacher_should_be_present_at" value="{{$workperiod->teacher_should_be_present_at}}" class="form-input">
		</div>


		<button class="mt-5 btn btn-outline-secondary"> حفظ </button>


	</form>

</x-app-layout>