<x-app-layout>

    <div class="p-3">
     اختر القاعة
    </div>

    @foreach($duaacateTasks as $duaacateTask)
    <div class="p-1 mt-1 border rounded flex justify-between flex-col sm:flex-row">
        <div class="flex gap-1 items-center">
            <a href="{{ route('admin.last_student_mission_task.index',$duaacateTask->id) }}">

                {{ $duaacateTask->title }}

            </a>
        </div>
    </div>
    @endforeach

</x-app-layout>