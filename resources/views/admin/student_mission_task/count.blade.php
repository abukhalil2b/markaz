<x-app-layout>

    <div class="mt-2 p-3 panel flex justify-between text-blue-800 font-bold">
        مجموع المهام المنجزة في مسار حفظ القرآن الكريم
    </div>

    <form action="{{ route('admin.student_mission_task.count') }}" method="POST" class="my-1 flex gap-1 items-end">
        @csrf
        <div class="w-48">
            <label class="text-red-800">من تاريخ</label>
            <input type="date" class="h-12 form-input" name="datefrom">
        </div>
        <div class="w-48">
            <label class="text-red-800">إلى تاريخ</label>
            <input type="date" class="h-12 form-input" name="dateto">
        </div>
        <button class="btn btn-outline-secondary w-full h-12">بحث</button>
    </form>

    <div class="py-2 bg-blue-800 p-1 rounded text-white">
        {{ $info }}
    </div>

    <div class="mt-2 p-3 panel flex justify-between text-blue-800 font-bold">
        <div>الاسم</div>
        <div> عدد المهام المنجزة</div>
    </div>
    @foreach($countDoneStudentTasks as $countDoneStudentTask)
    <div class="mt-2 p-1 panel flex justify-between">
        <a href="{{ route('admin.student.dashboard',$countDoneStudentTask->student_id) }}" class="flex justify-between font-bold p-1 border border-primary rounded w-72">
            <div>{{ $countDoneStudentTask->full_name }}</div>
            <x-svgicon.eye_open />
        </a>
        <div class="text-xl font-bold">{{ $countDoneStudentTask->evaluationCount }}</div>
    </div>
    @endforeach

    @foreach($countNotDoneStudentTasks as $countNotDoneStudentTask)
    <div class="mt-2 p-1 panel flex justify-between">
        <a href="{{ route('admin.student.dashboard',$countNotDoneStudentTask->id) }}" class="flex justify-between font-bold p-1 border border-primary rounded w-72">
            <div>{{ $countNotDoneStudentTask->full_name }}</div>
            <x-svgicon.eye_open />
        </a>
        <div class="text-xl font-bold">0</div>
    </div>
    @endforeach

</x-app-layout>