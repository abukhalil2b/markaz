<x-app-layout>


<div class="container">

	<div class="bar3">
		<h6>{{$studentHasMotoon->student->full_name}}</h6>
		<h6>{{$studentHasMotoon->motoon->title}}</h6>
	</div>

	<form action="{{route('student.motoon_memorize_track.store',$studentHasMotoon->id)}}" method="post">
	@csrf
		<div class="row">
			<div class="col-lg-3">
				<div class="input-container ">
				<span class="text-danger">التقدير</span>
					<select name="evaluation"  class="form-control">
						<option value="ممتاز">ممتاز</option>
						<option value="جيد جدا">جيد جدا</option>
						<option value="جيد">جيد </option>
						<option value="لم ينجح"> لم ينجح</option>
					</select>
				</div>
			</div>

			<div class="col-lg-3">
				<div class="input-container ">
					<span class="text-danger">عدد الأخطاء</span>
					<input class="form-control" type="number" name="numwrong" value="" >
				</div>
			</div>


			@if(!$studentHasMotoon->ignore_timing)
			<div class="col-lg-3 row">
				<div class="col-lg-6 p-0">
					<small style="font-size: 11px;">
					الوقت المتوقع لإنجاز المهمة
						<div>{{date('Y-m-d H:i',$studentHasMotoon->tobedone_at)}}</div>
					</small>
				</div>
				<div class="col-lg-6 p-0">
					التأخير
					<select name="timing_status" class="form-control">
						<option></option>
						<option value="late">متأخر</option>
					</select>
				</div>
			</div>
			@endif


			<div class="col-lg-3">
				<div class="input-container">
					<span class="text-danger">نقاط حصص المراجعة </span>
					<select name="point" class="form-control">
						<option></option>
						<option value="20">الحصول على ممتاز في التحصيل (20 نقاط)</option>
						<option value="10">الحصول على جيد جدا في التحصيل (10 نقاط)</option>
						<option value="5">الحصول على جيد في التحصيل (5 نقاط)</option>
					</select>
				</div>
			</div>


			<div class="col-lg-12">
				<div class="input-container">
					<span class="text-danger">الملحوظة </span>
					<textarea name="note" style="width:100%;height: 80px;border-radius: 5px;"></textarea>
				</div>
			</div>

		</div>
		<input type="hidden" name="done" value="1">
		<input type="hidden" name="done_at" value="{{time()}}">

	<div class="col-lg-3">
		<div class="input-container ">
			<button class="btn0 input-mt">
				حفظ
			</button>
		</div>
	</div>
	</form>
</div>



</x-app-layout>