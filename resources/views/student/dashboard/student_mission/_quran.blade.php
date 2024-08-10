        
        <div class="mt-4 p-1 flex justify-between bg-primary text-white text-xl rounded-t">
            <a class="text-white hover:text-red-800" href="">
                حفظ القرآن الكريم
            </a>
        </div>
        <div class="p-1 border rounded-b shadow-md">

            <div class="w-full">
                @foreach($studentMissions as $studentMission)

                <div class="p-3 border rounded bg-white text-center {{$studentMission->done?'mission-btn-done':''}}">
                    <div class="text-blue-600 text-xl font-bold">
                        {{$studentMission->mission->title}}
                    </div>
                    <div class="mt-2 flex justify-center gap-2 flex-col">
                        <div>بدأت: {{ $studentMission->start_at }}</div>
                        <div>تنتهي: {{ $studentMission->tobedone_at }}</div>
                        <div>@if($studentMission->done_at!=null)تمت: {{ $studentMission->done_at }}@endif</div>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('student.dashboard.student_mission_task.index',['studentMission'=>$studentMission->id]) }}" class="btn btn-outline-primary">
                            المهام
                        </a>

                    </div>

                </div>

                @endforeach
            </div>
        </div>