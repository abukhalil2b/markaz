<x-app-layout>

<style>
    .monthlysubscription{
    width: 60px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
</style>
<form action="{{route('monthlysubscribe.student.subscribe')}}" method="post">
	@csrf
<div class="container">
    <div class="bar2">
        اضفهم مبلغ الاشتراك الشهري في الخانة ثم اختر الطلاب
    </div>
    <div class="row">
        @foreach($students as $student)
        <label class="col-lg-12 w-full">
        	<input type="checkbox" name="studentIds[]" value="{{$student->id}}">
            {{$student->full_name}}
        </label>
        <hr>
        @endforeach

        <div class="col-lg-12">
            ضع المبلغ: <input type="number" name="monthlysubscription" class="monthlysubscription">
            <button class="btn btn-outline-secondary block mt-3">اضف مبلغ الاشتراك الشهري</button>
        </div>
    </div>
</div>
</form>

<hr>

<div class="container">
    <div class="row">
        @foreach($subscribers as $student)
        <div class="col-lg-12">
            {{$student->full_name}}

            <div class="pull-left">
                <a href="{{route('monthlysubscribe.edit',['student'=>$student->id])}}">
                   <span class="mx-3">تعديل</span>
                </a>
                RO. {{$student->monthlysubscription}}
            </div>
            <div><a href="">مستحقات الإشتراك الشهري</a></div>
             <hr>
        </div>

        @endforeach

    </div>
</div>
</x-app-layout>

