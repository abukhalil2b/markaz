<x-app-layout>

    <div class="p-4 text-xl">
        {{ $studentMission->mission->title }}
    </div>

    <div class="py-6 flex gap-3">
        <div class="">بدأت: {{ Str::substr($studentMission->start_at,0,10) }}</div>
        <div class="">@if($studentMission->done_at!=null)تمت: {{ $studentMission->done_at }}@endif</div>
    </div>

    <a class="block mt-4" href="{{ route('admin.student_mission.toggle_done',$studentMission->id) }}">
        @if($studentMission->done_at)
        <div class="text-orange text-xl flex gap-1 items-center">
            <x-svgicon.note />
            <div class="h-10">
                إلغاء إتمام المهمة
            </div>
        </div>
        @else
        <div class="text-success  flex gap-1">
        <x-svgicon.done/>
            تعين المهمة على أنها منجزة
        </div>
        @endif
    </a>


    <!--جدول المهام -->
    <div class="mt-5">
        جدول المهام
    </div>
    @foreach($studentMissionTasks as $studentMissionTask)

    @php

    $barCssClass = "";

    if($studentMissionTask->done_at != null){
    $barCssClass = " bg-[#f7ecd3] !border-[#7f5418] ";
    }

    if($studentMissionTask->evaluation == 'لم ينجح'){
    $barCssClass = " bg-gray-400 !border-[#7f5418] ";
    }

    @endphp
    <div class="flex gap-1 items-center">
        <div class="block mt-1 w-full p-1 border rounded-sm text-[10px] {{ $barCssClass }}">
            <div class="w-7 h-7 rounded-full inline-flex justify-center text-xs items-center border !border-red-900 text-red-900 {{ $studentMissionTask->done_at != null ? ' bg-red-900 text-white': '' }}">
                {{ $studentMissionTask->task_order }}
            </div>
            
          <div>
          {{ __($studentMissionTask->mission_type) }}
            {{ $studentMissionTask->descr }}
          </div>

            @if($studentMissionTask->wrongs)
            الأخطاء:
            @foreach(json_decode($studentMissionTask->wrongs) as $wrong)
            <div class="inline-block border p-1 rounded">
                {{ $wrong->note }}
            </div>
            @endforeach
            @endif

            <div>
                التقييم:

                {{ $studentMissionTask->evaluation == 'لم ينجح' ? 'لم ينجح' :  $studentMissionTask->evaluation }}
            </div>

            <div>
                ملحوظات:
                {{ $studentMissionTask->note }}
            </div>

            <div>
                تمت بتاريخ:
                {{ $studentMissionTask->done_at }}
            </div>

            <div>
                النقاط:
                {{ $studentMissionTask->point }}
            </div>

        </div>
    </div>

    @endforeach

</x-app-layout>