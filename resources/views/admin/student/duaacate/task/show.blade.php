<x-app-layout>
 <div class="p-3">
     (وَقُلْ رَبِّ زِدْنِي عِلْمًا)
 </div>

    <div class="p-3">
        <a class="w-32 btn btn-sm btn-outline-primary" href="{{ route('admin.student.duaacate.task.index',['duaacate'=>$duaacateTask->duaacate_id,'student'=>$student->id]) }}">
            رجوع
        </a>

        <div class="text-red-600 text-xl">
            {{ $duaacateTask->title }}
        </div>

        <div class="mt-4 text-gray-600 text-xl" style="font-family: hafs;">
            {{ $duaacateTask->content }}
        </div>

    </div>

</x-app-layout>