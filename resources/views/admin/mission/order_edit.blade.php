<x-app-layout>
    <div class="text-xl text-red-800">تعديل ترتيب المهام</div>

    <form action="{{ route('admin.mission.order_update') }}" method="POST">
        @csrf

        <div class="text-md">
            ترتيب المهام تظهر من الأصغر إلى الأكبر
        </div>

        <div class="gap-1">
            @foreach($missionTasks as $missionTask)

            <div class="text-xs mt-1 p-1 border rounded bg-white">
                <input type="number" name="task_orders[]" value="{{ $missionTask->task_order }}" class="form-input w-24 h-8 text-center border">
                {{ $missionTask->descr}}
            </div>

            @endforeach
        </div>

        <input type="hidden" name="mission_id" value="{{ $mission_id }}">

        <x-button-primary class="mt-5 w-full">حفط الترتيب</x-button-primary>
    </form>
</x-app-layout>