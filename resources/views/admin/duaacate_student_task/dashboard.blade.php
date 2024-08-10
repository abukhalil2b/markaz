<x-app-layout>

    <div class="p-3">
        <a href="{{ route('admin.student.dashboard',$student->id) }}" class="border p-1 rounded">
            {{ $student->full_name }}
        </a>
    </div>

    <div class="p-3 w-full" style="font-family: hafs;">

        (وَقُلْ رَبِّ زِدْنِي عِلْمًا)

    </div>

    <!-- last not done duaacate task -->
    @if($lastNotDoneDuaacateTask)

    <div class="p-3 text-xl">
        <div class="text-red-800" style="font-family: hafs;">
            {{ $lastNotDoneDuaacateTask->title }}
        </div>
        <div class="mt-3" id="content" style="font-family: hafs;">
            {!! nl2br($lastNotDoneDuaacateTask->content) !!}
        </div>
    </div>


    <form action="{{ route('admin.duaacate_student_task.store') }}" method="POST" x-data="{
            total: 0,
            showAddPoint:false,
            evaluation:'',

            addEvaluation(eval){
                this.evaluation = eval;
                this.showAddPoint = true;
                if(eval == 'لم ينجح'){
                    this.total = 0;
                    this.showAddPoint = false;
                }
            }
        }">
        @csrf
        <div class="mt-5">
            <x-input-add-wrong-number-with-note :allowedWrongNumber="1" />
        </div>

        <div class="mt-5">
            <x-input-add-point-with-valuation />
        </div>

        <div class="">
            <x-textarea-add-note />
        </div>

        <input type="hidden" name="duaacate_task_id" value="{{ $lastNotDoneDuaacateTask->duaacate_task_id }}">

        <input type="hidden" name="duaacate_student_id" value="{{ $duaacateStudent->id }}">

        <div class="flex flex-col items-center">

            <x-button-primary x-cloak x-show=" evaluation != '' " class="mt-2 w-32">
                تم إكمال المهمة
            </x-button-primary>

        </div>

    </form>

    @endif
    <!-- / last not done duaacate task -->

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
            <a href="{{ route('admin.duaacate_student_task.show',$maped_duaacate_student_task->duaacate_student_task_id) }}" class="">
                عرض
            </a>
            @endif
        </div>
    </div>

    @endforeach



    <div class="py-5 flex justify-between">
        <a class="block mt-4" href="{{ route('admin.duaacate_student.toggle_done',$duaacateStudent->id) }}">
            @if($duaacateStudent->done_at)
            <div class="text-orange text-xl flex gap-1 items-center">
                <x-svgicon.note />
                <div class="h-10">
                    إلغاء إتمام المهمة
                </div>
            </div>
            @else
            <div class="text-success  flex gap-1">
                <x-svgicon.done />
                تعين المهمة على أنها منجزة
            </div>
            @endif
        </a>

        @if(auth()->user()->permission('admin.duaacate_student.delete'))
        <div class="p-1">
            @include('admin.duaacate_student._modal_delete')
        </div>
        @endif
    </div>

</x-app-layout>