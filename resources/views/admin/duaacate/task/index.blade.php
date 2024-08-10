<x-app-layout>

    <div class="p-3">
        (وَقُلْ رَبِّ زِدْنِي عِلْمًا)
    </div>
    <div class="p-3">
        <div class="py-1">
            @include('admin.duaacate.task._modal_duaacate_task_create')
        </div>
        @foreach($duaacateTasks as $duaacateTask)
        <div class="mt-2 p-3 rounded border">

            <a href="{{ route('admin.duaacate.task.show',$duaacateTask->id) }}" class="block text-red-600 text-xl">
                {{ $duaacateTask->title ?? 'بدون عنوان' }}
            </a>

        </div>
        @endforeach
    </div>

</x-app-layout>