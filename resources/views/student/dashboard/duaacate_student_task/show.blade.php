<x-student.layout>

<div class="text-red-800" style="font-family: hafs;"> {{ $duaacate_task->title }} </div>

<div class="mt-3 text-xl" style="font-family: hafs;"> {!! nl2br($duaacate_task->content) !!} </div>

@if($duaacate_task->done_at)
<div class="mt-4 panel">
   <div class="py-2 text-red-800"> تم انجازها بتاريخ: {{ $duaacate_task->done_at }} </div>
   <div class="py-2 text-red-800"> عدد الأخطاء: {{ $duaacate_task->numwrong }} </div>
   <div class="py-2 text-red-800"> التقييم: {{ $duaacate_task->evaluation }} </div>
   <div class="py-2 text-red-800"> {{ $duaacate_task->note }} </div>

   <div class="py-2 text-red-800"> النقاط:
      @if($mark)
      {{ $mark->point }}
      @endif
   </div>

</div>

@endif


</x-student.layout>