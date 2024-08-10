<x-app-layout>

<a href="{{ route('admin.student.dashboard',$student->id) }}" class="btn btn-outline-secondary">
		{{ $student->full_name }}
	</a>

   
        @if( count($duaacate_student_tasks) == 0 )
        <div class="flex text-xl text-red-800 justify-center">
            لايوجد مهام منجزة
        </div>
        @endif

        <!-- loop throgh tasks -->
        @foreach($duaacate_student_tasks as $key => $duaacate_student_task)

        @php

        $barCssClass = "";

        if($duaacate_student_task->done_at != null){
        $barCssClass = " bg-[#f7ecd3] !border-[#7f5418] ";
        }

        if($duaacate_student_task->evaluation == 'لم ينجح'){
        $barCssClass = " bg-gray-400 !border-[#7f5418] ";
        }

        @endphp


        <div class="block mt-1 w-full p-1 border rounded-sm text-[10px] {{ $barCssClass }}">
            <div class="flex items-center justify-between">
                <div class="flex  gap-1 items-center">
                    <div class="w-7 h-7 rounded-full inline-flex justify-center text-xs items-center border !border-red-900 text-red-900 {{ $duaacate_student_task->done_at != null ? ' bg-red-900 text-white': '' }}">
                        {{ $key + 1 }}
                    </div>

                    {{ $duaacate_student_task->title }}
                </div>
            </div>
            <div>
                عدد الأخطاء:
                {{ $duaacate_student_task->numwrong }}
            </div>
            <div>
                التقييم:
                {{ $duaacate_student_task->evaluation }}
            </div>
            <div>
                {{ $duaacate_student_task->note }}
            </div>
        </div>

        @endforeach

</x-app-layout>