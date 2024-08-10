<div class="mt-4 p-1 flex justify-between bg-primary text-white text-xl rounded-t">
    <a class="text-white hover:text-red-800" href="">
        (وَقُلْ رَبِّ زِدْنِي عِلْمًا)
    </a>

</div>
<div class="p-1 border rounded-b shadow-md">
    @foreach($duaacateStudents as $duaacateStudent)
    <div class="p-1">
        <a @if($duaacateStudent->done_at!=NULL)
            href=""
            @endif>
            <div class="p-3 mt-2 border rounded bg-white text-center ">
                <a href="{{route('student.dashboard.duaacate_student_task.index',$duaacateStudent->id)}}">
                    {{$duaacateStudent->title}}
                </a>
            </div>
        </a>
    </div>
    @endforeach
</div>