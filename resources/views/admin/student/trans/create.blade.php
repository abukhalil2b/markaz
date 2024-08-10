<x-app-layout>
   

    <div>
        <span class="text-red-600">الاسم: </span>
        {{$student->full_name}}
    </div>

    <div>
        <span class="text-red-600">القاعة الحالية: </span>
        @if($student->level) {{$student->level->title}} @endif
    </div>

    <h2 class="mt-4 font-semibold text-xl text-gray-800 leading-tight">
    اختر القاعة لتنقله إليها
    </h2>

    @foreach($workperiods as $workperiod)

    <div class="mt-4 p-1 flex justify-between bg-primary text-white text-xl rounded-t">
        {{$workperiod->title}}
    </div>

    <div class="p-1 border rounded-b shadow-md">
        <!-- levels  -->
        @foreach($workperiod->levelHasWorkperiods()->get() as $level)
        <a href="{{route('admin.student.trans.update',['student'=>$student->id,'workperiodId'=>$workperiod->id,'levelId'=>$level->id])}}">
            <div class="mt-2 border rounded bg-white text-center ">
                {{$level->title}}
            </div>
        </a>
        @endforeach
    </div>
    @endforeach


</x-app-layout>