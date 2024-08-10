<x-app-layout>

   <div class="text-red-800" style="font-family: hafs;"> {{ $duaacate_student_task->title }} </div>

   <div class="mt-3 text-xl" style="font-family: hafs;"> {!! nl2br($duaacate_student_task->content) !!} </div>

   @if($duaacate_student_task->done_at)
   <div class="mt-4 panel">
      <div class="py-2 text-red-800"> تم انجازها بتاريخ: {{ $duaacate_student_task->done_at }} </div>
      <div class="py-2 text-red-800"> عدد الأخطاء: {{ $duaacate_student_task->numwrong }} </div>
      <div class="py-2 text-red-800"> التقييم: {{ $duaacate_student_task->evaluation }} </div>
      <div class="py-2 text-red-800"> {{ $duaacate_student_task->note }} </div>

      <div class="py-2 text-red-800"> النقاط:
         @if($mark)
         {{ $mark->point }}
         @endif
      </div>

   </div>

   <a class="mt-6 btn btn-danger" href="{{ route('admin.duaacate_student_task.delete',$duaacate_student_task_id) }}">
      إلغاء إنجاز المهمة
   </a>
   @endif



</x-app-layout>