<x-app-layout>
    <div class="text-xl">
    {{$student->full_name}}
    </div>

    <div class="p-3">

        <form action="{{route('student.mark.store')}}" method="post">
            @csrf
            <div class="mt-3">
                <div>{{__($tag)}}</div>
            </div>
            <input type="number" name="point" placeholder="النقاط" class="form-input" id="js-point-input">

            <input type="hidden" name="student_id" value="{{$student->id}}">
            <input type="hidden" name="tag" value="{{$tag}}">

            <x-button-primary class="mt-4 w-full">
            حفظ
            </x-button-primary>
        </form>

    </div>

</x-app-layout>