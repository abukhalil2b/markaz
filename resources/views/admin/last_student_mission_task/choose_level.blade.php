<x-app-layout>
    <div class="p-3">
     اختر القاعة
    </div>


    @foreach($levels as $level)
    <div class="p-1 mt-1 border rounded flex justify-between flex-col sm:flex-row">
        <div class="flex gap-1 items-center">
            <a href="{{ route('admin.last_student_mission_task.index',$level->id) }}">

                {{ $level->title }}

            </a>
        </div>
    </div>
    @endforeach





</x-app-layout>