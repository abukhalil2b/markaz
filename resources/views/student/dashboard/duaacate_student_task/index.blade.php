<x-student.layout>

    <div class="p-3 w-full" style="font-family: hafs;">
        (وَقُلْ رَبِّ زِدْنِي عِلْمًا)
    </div>

    @if($lastNotDoneDuaacateTask)

    <div class="p-3 text-xl">
        <div class="text-red-800" style="font-family: hafs;">
            {{ $lastNotDoneDuaacateTask->title }}
        </div>
        <div class="mt-3" id="content" style="font-family: hafs;">
            {!! nl2br($lastNotDoneDuaacateTask->content) !!}
        </div>
    </div>
   

    @endif

    <div class="mt-5">
        جدول المهام ( {{ $duaacate_task_count }} )
    </div>

    <!-- loop throgh tasks -->
    @foreach($maped_duaacate_student_tasks as $key => $maped_duaacate_student_task)

    @php

    $barCssClass = "";

    if($maped_duaacate_student_task->done_at != null){
    $barCssClass = " bg-[#f7ecd3] !border-[#7f5418] ";
    }

    if($maped_duaacate_student_task->evaluation == 'لم ينجح'){
    $barCssClass = " bg-gray-400 !border-[#7f5418] ";
    }

    @endphp


    <div class="block mt-1 w-full p-1 border rounded-sm text-[10px] {{ $barCssClass }}">
        <div class="flex items-center justify-between">
            <div class="flex  gap-1 items-center">
                <div class="w-7 h-7 rounded-full inline-flex justify-center text-xs items-center border !border-red-900 text-red-900 {{ $maped_duaacate_student_task->done_at != null ? ' bg-red-900 text-white': '' }}">
                    {{ $key + 1 }}
                </div>

                {{ $maped_duaacate_student_task->title }}
            </div>

            @if($maped_duaacate_student_task->duaacate_student_task_id)
            <a href="{{ route('student.dashboard.duaacate_student_task.show',$maped_duaacate_student_task->duaacate_student_task_id) }}" class="">
                عرض
            </a>
            @endif
        </div>
    </div>

    @endforeach

</x-student.layout>