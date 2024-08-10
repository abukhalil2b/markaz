<x-student.layout>

    <div>
        <div class="py-2 text-2xl text-red-800">
            {{ $student->full_name }}
        </div>
        <div class="py-2 text-blue-800">
            {{ $level->title }}
        </div>
    </div>

    <div class="mt-4 panel">

        <div class="py-2 text-xl">
            {{ $studentMissionTask->descr }}
        </div>

        <div>
            @if($studentMissionTask->done_at!=null)
            <p>
                <span class="text-red-800">تمت بتاريخ:</span>
                {{ $studentMissionTask->done_at }}
            </p>
            @endif
        </div>

        @if($studentMissionTask->wrongs)
        <span class="text-red-800">
            الأخطاء:
        </span>

        @foreach( json_decode($studentMissionTask->wrongs) as $wrong)
        <div class="inline-block">
            {{ $wrong->note }}
        </div>
        @endforeach
        @endif

        <div>
            <span class="text-red-800">
                التقييم:
            </span>

            {{ $studentMissionTask->evaluation == 'لم ينجح' ? 'لم ينجح' : $studentMissionTask->evaluation }}
        </div>

        <div>
            <span class="text-red-800">
                ملحوظات:
            </span>

            {{ $studentMissionTask->note }}
        </div>

        <div>
            <span class="text-red-800">
                النقاط:
            </span>

            @if($studentMissionTask->mark)
            {{ $studentMissionTask->mark->point }}
            @endif
        </div>


    </div>
</x-student.layout>