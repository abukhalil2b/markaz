<x-app-layout>

    <a href="{{ route('admin.student.dashboard',$student->id) }}" class="btn btn-outline-secondary">
        {{ $student->full_name }}
    </a>

    <div class="p-1">

        <div class="">
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
            @if($studentMissionTask->mark)
            {{ $studentMissionTask->mark->point }}
            @endif
        </div>


         <!-- mission is done -->
        @if($studentMissionTask->done_at)

            <!-- free text -->
            @if($studentMissionTask->select_type == 'freeText')
                <div class="mt-4 flex gap-6">
                <!-- incase free text will need tobe deleted -->
                @include('admin.student.mission.task._modal_delete_task')

                @else

                <!-- other cases let it tobe update -->
                @include('admin.student.mission.task._modal_update_task')
                @include('admin.student.mission.task._modal_delete_task')
            </div>
            @endif
        @endif
        <!-- / mission is done -->


    </div>

</x-app-layout>