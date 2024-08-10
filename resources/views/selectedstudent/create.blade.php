<x-app-layout>

<form action="{{route('selectedstudent_high_point.store')}}" method="post">
	@csrf
<div class="container">
    <center class="bar2">
        <h3>لوحة الشرف</h3>
    </center>

    <div class="row">
    	<span>الطالب الحاصل على أعلى نقاط</span>
    	@foreach($selectedstudents as $selectedstudent)
    	<div class="col-lg-12">
    		<div class="circle">
	    		<div>{{$selectedstudent->student->fullName}} </div>
	    		<div>{{$selectedstudent->level->title}}</div>
    		</div>
    	</div>
    	@endforeach
    </div>
</div>
</form>
</x-app-layout>
