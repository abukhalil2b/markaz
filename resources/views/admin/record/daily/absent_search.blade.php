<x-app-layout>

    @include('admin.record.daily._modal_search_for_absent')

    <div class="text-info"> {{ $searchDate }} </div>

    @foreach($students as $student)
    <div class="mt-1 p-1 border rounded bg-white flex flex-row justify-between items-center text-xs">

        <div>
            <span class="student-number rounded">{{$student->student->id}}</span>
            {{$student->student->full_name}}
        </div>

        <div class="space-y-2">
            <div> بدون عذر: {{$student->absent_without_excuse}}</div>
            <div> ب عذر: {{$student->absent_with_excuse}}</div>
            <a class=" text-red-800 block" href="{{ route('days_of_student_absent',$student->student_id) }}">عرض السجلات</a>
        </div>

    </div>
    @endforeach

</x-app-layout>