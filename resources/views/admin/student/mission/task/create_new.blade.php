<x-app-layout>

    <div class="p-3">
        <form action="{{ route('admin.student.mission.task.store_new',$studentMissionTask->id) }}" method="POST">
            @csrf

            <span class="text-red-800 mx-2">
            من بعد
            </span>
            {{ $studentMissionTask->descr }}
            <span class="text-red-800 mx-2">
            أضف
            </span>
            <input name="descr" class="rounded border w-full">

            <x-button-primary class="mt-4 w-full">
                حفظ
            </x-button-primary>
        </form>
    </div>

</x-app-layout>