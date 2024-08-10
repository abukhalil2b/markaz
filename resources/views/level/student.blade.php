<x-app-layout>

    <div class="panel">
        <div>
            القاعة: {{ $level->title }}
        </div>
        <div>
            العدد: {{ count($students) }} | الأساتذة: @foreach($level->teachers as $teacher) ( {{ $teacher->first_name }} ) @endforeach
        </div>
    </div>

    @foreach($students as $student)

    <div class="bg-white mt-2 border rounded p-1">
        {{$student->full_name}}
    </div>
    @endforeach

</x-app-layout>