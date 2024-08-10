<x-app-layout>
    <div class="p-3">
        {{ $student->full_name }}
    </div>

    <div class="text-xs mb-4 mt-2 grid grid-cols-1 sm:grid-cols-2 gap-1">
        @foreach($studentMissions as $studentMission)

        <div class="panel {{$studentMission->done_at != null ?'bg-green-200':''}}">
            <b>{{$studentMission->mission->title}}</b>
            <div class="mt-2">بدأت: {{ $studentMission->start_at }}</div>
            <div>@if($studentMission->done_at!=null)تمت: {{ $studentMission->done_at }}@endif</div>

            <div class="mt-4 flex justify-center">
                <a class="flex gap-1 items-center text-success" href="{{ route('admin.student_mission.show',$studentMission->id) }}">
                    <x-svgicon.eye_open />
                    عرض
                </a>
            </div>
        </div>

        @endforeach
    </div>

</x-app-layout>