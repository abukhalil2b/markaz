<x-app-layout>

    <div class="p-3">
        أيام دراسة <span class="text-red-800"> {{ $student->full_name }} </span>
    </div>

    <form method="post" action="{{route('student.week_days.update',$student->id)}}">
        @csrf
        <div class="py-5 flex flex-wrap gap-3">
            @foreach($weekDays as $day)
            <label class="inline-flex items-center gap-1 mx-2 panel">
                <input type="checkbox" name="weekdays[]" value="{{$day}}" style="width: 20px;height: 20px;" @if($student->checkHasWeekDay($day))
                checked
                @endif
                >
                {{__($day)}}
            </label>
            @endforeach
        </div>
        @if( auth()->user()->permission('student-update-study-days') )
        <button class="mt-5 btn btn-outline-primary w-full" type="submit">حفظ التعديل</button>
        @endif
    </form>


</x-app-layout>