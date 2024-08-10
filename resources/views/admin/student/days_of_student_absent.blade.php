<x-app-layout>

    <div class="py-2 text-xl">
        السجلات التي تم فيها رصد غياب للطالب
        <span class="text-red-800 dark:text-red-300">
            {{ $student->id}}
            {{ $student->full_name}}
        </span>
    </div>

    <div class="py-2">
        هذه النتائج تُظهر كل السجلات التي رصد فيها غياب الطالب
    </div>

    <div class="mt-4 p-3 bg-primary text-primary-light font-bold">
        أولا: الغياب <span class="text-red-400 bg-red-50">بدون عذر</span> ({{ count($withoutExcuseStudentRecords) }})
    </div>
    @foreach($withoutExcuseStudentRecords as $withoutExcuseStudentRecord)
    <div class="border rounded bg-white px-3 py-1 my-2 flex justify-between dark:bg-gray-600 dark:text-gray-400">
        <div>
            <div>{{$withoutExcuseStudentRecord->title}}</div>
            <div class="text-red-800 text-xs dark:text-red-300">ملحوظة: {{$withoutExcuseStudentRecord->note}}</div>
        </div>

        <div class="flex flex-col gap-3">
            <a class="btn btn-sm btn-outline-warning text-[10px]" href="{{ route('record.day.index',$withoutExcuseStudentRecord->recorddaily_id) }}">
                عرض السجل نسخة الإدارة
            </a>
            <a class="btn btn-sm btn-outline-warning text-[10px]" href="{{ route('student.attendance.student_index',$withoutExcuseStudentRecord->recorddaily_id) }}">
                عرض السجل نسخة الطلاب
            </a>
        </div>

    </div>
    @endforeach


    <div class="mt-4 p-3 bg-primary text-primary-light font-bold">
        ثانيا: الغياب بعذر ({{ count($withExcuseStudentRecords) }})
    </div>
    @foreach($withExcuseStudentRecords as $withExcuseStudentRecord)
    <div class="border rounded bg-white px-3 py-1 my-1 flex justify-between dark:bg-gray-600 dark:text-gray-400">
        <div>
            <div>{{$withExcuseStudentRecord->title}}</div>
            <div class="text-red-800 text-xs dark:text-red-300">ملحوظة: {{$withExcuseStudentRecord->note}}</div>
        </div>
        <div class="flex flex-col gap-3">
            <a class="btn btn-sm btn-outline-warning text-[10px] " href="{{ route('record.day.index',$withExcuseStudentRecord->recorddaily_id) }}">
                عرض السجل نسخة الإدارة
            </a>
            <a class="btn btn-sm btn-outline-warning text-[10px] " href="{{ route('student.attendance.student_index',$withExcuseStudentRecord->recorddaily_id) }}">
                عرض السجل نسخة الطلاب
            </a>
        </div>
    </div>
    @endforeach

</x-app-layout>