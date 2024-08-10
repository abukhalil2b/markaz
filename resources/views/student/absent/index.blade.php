<x-app-layout>

   <h3>قائمة الغياب</h3>

        @if($lastRecord)
        <p>{{$lastRecord->title}}</p>
        <div class="row ">
            <div class="col-lg-12">
                @foreach($absentStudents as $student)
                    <div class="bar2">
                        {{$student->id}}-{{$student->first_name}} {{$student->second_name}} {{$student->last_name}}
                    </div>
                @endforeach
            </div>
        </div>
        @endif

</x-app-layout>
