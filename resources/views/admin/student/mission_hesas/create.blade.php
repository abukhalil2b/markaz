<x-app-layout>
    <div class="p-3">
        {{$student->full_name}}
    </div>
    <div class="flex flex-col">
        <div class="text-xl">{{$mission->title}}</div>
        <div class="text-gray-500 text-sm">{{$mission->note}}</div>
    </div>

    <form action="{{route('admin.student.mission_hesas.store')}}" method="post">
        @csrf
        <input type="hidden" name="student_id" value="{{ $student->id }}">
        <input type="hidden" name="mission_id" value="{{ $mission->id }}">
        <x-button-primary class="mt-2 w-[224px]">
            سجل مهمة جديدة
        </x-button-primary>
    </form>


</x-app-layout>