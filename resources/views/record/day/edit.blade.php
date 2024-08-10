<x-app-layout>

	@php

	$presentTime = $studentHasRecordDaily->present_time == NULL ? 0 : $studentHasRecordDaily->present_time;

	$islate = $studentHasRecordDaily->islate;

	$withExcuse = $studentHasRecordDaily->with_excuse;

	$note = $studentHasRecordDaily->note;

	$id = $studentHasRecordDaily->id;

	@endphp

	<form method="post" action="{{ route('record.day.update') }}" x-data="{present_time:'{{ $presentTime }}'}">
		@csrf

		<div class="py-6">
		{{ Str::substr($studentHasRecordDaily->created_at,0,10) }}
		</div>

		@if($presentTime)
		<div class="py-2 bg-green-100 px-1 text-green-800">
			<span class="font-bold">حاضر، </span>وقت الحضور: {{ date('d-m-Y H:i:s',$presentTime) }}
		</div>
		@endif

		<div class="mt-4">هل غائب؟</div>
		<select id="present_time" class="form-select" name="present_time" x-model="present_time">
			<option @if($presentTime !=0) selected @endif value="{{ $presentTime == 0 ? time() : $presentTime }}">لا</option>
			<option @if($presentTime==0) selected @endif value="0">نعم</option>
		</select>

		<template x-if="present_time != 0">
			<div>
				<div class="mt-4">هل متأخر؟</div>
				<select id="islate" class="form-select" name="islate">
					<option @if($islate==0) selected @endif value="0">لا</option>
					<option @if($islate==1) selected @endif value="1">نعم</option>
				</select>
			</div>
		</template>

		<template x-if="present_time == 0">
			<div>
				<div class="mt-4 ">هل معذور؟</div>
				<select id="with_excuse" class="form-select" name="with_excuse">
					<option @if($withExcuse==0) selected @endif value="0">لا (يجب كتابة السبب)</option>
					<option @if($withExcuse==1) selected @endif value="1">نعم </option>
				</select>

				<div class="mt-4 py-1">الملحوظة أو السبب</div>
				<input name="note" class="form-input" value="{{ $note }}">
			</div>
		</template>


		<input type="hidden" name="id" value="{{ $id }}">
		<button class="mt-4 btn btn-outline-secondary">حفظ التعديلات</button>
	</form>

</x-app-layout>