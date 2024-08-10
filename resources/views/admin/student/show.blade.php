<x-app-layout>

    <h2 class="py-4 font-bold text-xl text-gray-800">
        {{ $student->full_name }}
    </h2>

    <div class="bg-red-100 text-xs">
    <div>
        <div class="mt-2 py-1 text-xl"> مسار إنجاز الحصص </div>
        @foreach($student_has_missions as $student_has_mission)
        <div class="p-1 mt-1 rounded border">
            <div> {{ $student_has_mission->mission_title }}</div>
            <div> {{ date('d-m-Y',$student_has_mission->start_at) }}</div>
            <div class="text-[9px]"> {{ $student_has_mission->mission_id }} - {{ $student_has_mission->track_type }}</div>
        </div>
        @endforeach
    </div>
    <div>
        <div class="mt-2 py-1 text-xl"> مسار حفظ القرآن </div>
        @foreach($student_missions as $student_mission)
        <div class="p-1 mt-1 rounded border">
            <div> {{ $student_mission->mission_title }}</div>
            <div> {{ $student_mission->start_at }}</div>
            <div class="text-[9px]"> {{ $student_mission->mission_id }} - {{ $student_mission->track_type }}</div>
        </div>
        @endforeach
    </div>
    </div>

   
</x-app-layout>