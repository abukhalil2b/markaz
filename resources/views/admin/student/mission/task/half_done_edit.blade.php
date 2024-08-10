<x-app-layout>

    <div class="p-3">
        <form action="{{ route('admin.student.mission.task.half_done_update',$studentMissionTask->id) }}" method="POST">
            @csrf

            <x-button-primary class="mt-4 w-full">

                تم إكمال نصف المهمة

            </x-button-primary>
        </form>
    </div>

</x-app-layout>