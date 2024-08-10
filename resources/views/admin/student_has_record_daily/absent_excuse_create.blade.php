<x-app-layout>

	<div x-data="{with_excuse:'{{ $student_has_record_daily->with_excuse }}'}">

		<form method="post" action="{{ route('admim.student_has_record_daily.absent_excuse_store') }}">
			@csrf

			<div class="flex gap-3">
				<div class="card cursor-pointer" :class="with_excuse == 1 ? 'selected' : '' " @click="with_excuse=1">معذور</div>
				<div class="card cursor-pointer" :class="with_excuse == 0 ? 'selected' : '' " @click="with_excuse=0">غير معذور</div>
			</div>

			<label class="mt-4" for="note">
				<div class="py-2">السبب</div>
				<input name="note" class="form-input" value="{{ $student_has_record_daily->note ?? '' }}">
			</label>

			<div class="mt-5 text-red-700">
				في حالة اخترت (غير معذور)، يجب كتابة السبب
			</div>

			<button class="mt-4 btn btn-outline-secondary w-48">حفظ</button>

			<input type="hidden" name="with_excuse" x-model="with_excuse">
			<input type="hidden" name="student_has_record_daily_id" value="{{ $student_has_record_daily->id }}">
		</form>

	</div>
</x-app-layout>