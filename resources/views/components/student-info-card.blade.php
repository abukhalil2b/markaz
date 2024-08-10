<div class="flex gap-1 border rounded-sm p-1 shadow-sm">

    <div>
        @if($student->gender == 'm')
        <img src="{{ asset('assets/images/avatar/avatar.png') }}" width="75">
        @else
        <img src="{{ asset('assets/images/avatar/avatar-female.png') }}" width="75">
        @endif
    </div>

    <div class="flex flex-col gap-1">
        <div class="student-number  {{ $student->under_observation ? 'bg-red-800 text-white' : ''}}">{{$student->id}}</div>

        <div> {{$student->full_name}}</div>

        <div> {{$student->level->title}} </div>
    </div>

</div>