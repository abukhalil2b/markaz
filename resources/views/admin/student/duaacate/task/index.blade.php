<x-app-layout>
    <div class="p-3">
        (وَقُلْ رَبِّ زِدْنِي عِلْمًا)
    </div>

    <form action="{{ route('admin.duaacate_student.store') }}" method="POST">

        <div class="p-3">
            <div class="py-1">
                {{ $student->full_name }}
            </div>

            <div class="py-1">
                {{ $duaacate->title }}
            </div>

            <p class="text-green-600">حدد المهام التي تريد أن تعفي الطالب منها</p>

            @foreach($duaacateTasks as $duaacateTask)
            <label class="flex items-center gap-1 mt-1 bg-white p-2">
                <input type="checkbox" name="duaacateTaskIds[]" value="{{ $duaacateTask->id }}">
                <div class=" text-red-600 text-xs">
                    {{ $duaacateTask->title ?? 'بدون عنوان' }}
                </div>
                <a href="{{ route('admin.student.duaacate.task.show',['duaacate_task_id'=>$duaacateTask->id,'student'=>$student->id]) }}">
                    مشاهدة
                </a>
            </label>
            @endforeach
        </div>

        <div class="p-3">

            @csrf
            <input type="hidden" name="student_id" value="{{ $student->id }}">
            <input type="hidden" name="duaacate_id" value="{{ $duaacate->id }}">
            <x-button-primary class="w-32">اضف</x-button-primary>

        </div>

    </form>

</x-app-layout>