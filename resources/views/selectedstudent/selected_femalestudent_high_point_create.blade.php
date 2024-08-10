<x-app-layout>

    <form action="{{route('selectedstudent_high_point.femalestudent_high_point_store')}}" method="post">
        @csrf
    <center class="container">
        <h4>{{$student->full_name}}</h4>
        <h6>{{$level->title}}</h6>
        <input type="hidden" name="level_id" value="{{$level->id}}">
        <input type="hidden" name="student_id" value="{{$student->id}}">

        <label class="mt-5 w-full">
            <input class="checkbox" type="checkbox" name="deleteprevious" >
             إزالة الطلاب السابقين
        </label>

        <button class="btn btn-outline-secondary mt-2">ضع هذا الطالب في لوحة الشرف</button>

    </center>
    </form>

    <div class="container mt-5">
        <center>قائمة الطلاب السابقين</center>
        @foreach($selectedstudents as $selectedstudent)
        <div>{{$selectedstudent->student->full_name}}</div>
        @endforeach
    </div>
</x-app-layout>