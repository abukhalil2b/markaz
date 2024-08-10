<x-app-layout>

    @if($warning)
    <div class="p-3">
        <div>{{$warning->title}}</div>
        <div class="text-xs text-gray-400">{{$warning->date}}</div>
        <div>
            {{$warning->description}}
        </div>
        <div class="mt-5">
            <a class="text-danger" href="{{route('admin.student.warning.delete',['warning'=>$warning->id])}}">حذف</a>
        </div>
    </div>

    @else
    <form action="{{route('admin.student.warning.store')}}" method="post">
        @csrf
        <div class="p-3">
            <div class="mt-4">
            <div class="text-xl">
            {{$student->full_name}}
            </div>

                <div class="mt-4">
                    الوصف
                    <x-input name="description"/>
                </div>

            </div>

            <div class="mt-4">
                التأريخ
                <x-input type="date" name="date"/>
                <input type="hidden" name="student_id" value="{{$student->id}}">
                <input type="hidden" name="level" value="{{$level}}">

            </div>

            <div class="mt-4">
            <x-button-primary type="submit" class="w-full">
                    حفظ
                </x-button-primary>
            </div>

        </div>
    </form>
    @endif
</x-app-layout>