        <div class="mt-4 p-1 flex justify-between bg-primary text-white text-xl rounded-t">

            <div class="text-white">
                حفظ القرآن الكريم
            </div>

            <div>
                <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                    <button type="button" @click="toggle">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-90 opacity-70">
                            <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                            <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                            <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                        </svg>
                    </button>
                    <ul x-cloak="" x-show="open" x-transition="" x-transition.duration.300ms="" class="whitespace-nowrap ltr:right-0 rtl:left-0 text-xs">
                        <li>
                            @if( auth()->user()->permission('admin.student.mission.index') )
                            <a class="flex gap-1 items-center" href="{{route('admin.student.mission.index',['student'=>$student->id])}}">
                                <x-svgicon.new />
                                جديد
                            </a>
                            @endif
                            @if( auth()->user()->permission('admin.student.mission.index') )
                            <a class="flex gap-1 items-center" href="{{route('admin.student.mission.index_test',['student'=>$student->id])}}">
                                <x-svgicon.new />
                                جديد
                                (عرض تجريبي)
                            </a>
                            @endif
                        </li>
                        <li>
                            <a class="flex gap-1 items-center" href="{{route('admin.student.mission.history',['student'=>$student->id])}}">
                                <x-svgicon.done />
                                المنجزة
                            </a>
                        </li>
                    </ul>

                </div>

            </div>

        </div>
        
        <div class="p-1 border rounded-b shadow-md">

            <div class="w-full">
                @foreach($studentMissions as $studentMission)

                <div class="p-3 border rounded bg-white text-center {{$studentMission->done?'mission-btn-done':''}}">
                    <div class="text-blue-600 text-xl font-bold">
                        {{$studentMission->mission->title}}
                    </div>
                    <div class="mt-2 flex justify-center gap-2 flex-col">
                        <div class="text-xs">بدأت: {{ $studentMission->start_at }}</div>
                        <div>@if($studentMission->done_at!=null)تمت: {{ $studentMission->done_at }}@endif</div>
                    </div>

                    <div class="flex justify-between">
                        <a class="flex gap-1 items-center text-primary" href="{{ route('admin.student.task.dashboard',$studentMission->id) }}">
                            <x-svgicon.task />
                            المهام
                        </a>

                        @if(auth()->user()->permission('manage-mission'))
                        <a class="flex gap-1 items-center text-success" href="{{ route('admin.student_mission.show',$studentMission->id) }}">
                            <x-svgicon.eye_open />
                            عرض
                        </a>
                        @endif

                        @if(auth()->user()->permission('manage-mission'))
                        <div class="p-1">
                            @include('admin.student._modal_delete_student_mission')
                        </div>
                        @endif

                    </div>

                </div>

                @endforeach
            </div>
        </div>