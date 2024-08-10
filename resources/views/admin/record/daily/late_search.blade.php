<x-app-layout>

    @include('admin.record.daily._modal_search_for_late')

    <div class="text-info"> {{ $searchDate }} </div>

    @foreach($students as $student)
    <div class="mt-1 p-1 border rounded bg-white flex flex-row justify-between text-xs">

        <div>
            <span class="student-number">{{$student->student->id}}</span>
            {{$student->student->full_name}}
        </div>

        <div>
            عدد مرات التأخر: {{$student->lateTimes}}
        </div>

    </div>
    @endforeach

</x-app-layout>