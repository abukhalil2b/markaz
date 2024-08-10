<x-app-layout>

    <div class="py-3 text-md">
            القاعات الموجودة في هذه الفترة
        <span class="text-red-800">
            {{ $userWorkperiod->title }}
        </span>
    </div>

    <div class="px-3">
        @if(auth()->user()->permission('add-edit-level'))
        @include('level._add_level_modal')
        @endif
    </div>


    @foreach($levels as $level)
    <div class="mt-4 panel">
        <a href="{{route('level.student',['level'=>$level->id])}}" class="block text-xl {{$level->gender == 'm' ? 'text-blue-900' : 'text-red-900'}}">
            {{$level->title}}
        </a>
        <div class="text-sm">
            <span class="text-red-900">الوصف:</span> {{$level->description}}
        </div>
        <div>
            عدد الطلاب: {{$level->students->count()}}
        </div>
        <div>
            المعلمين: {{$level->teachers->count()}}

            @foreach($level->teachers as $teacher)
            <span class="bg-slate-100 inline-block p-2 rounded"> {{$teacher->full_name}} </span>
            @endforeach

        </div>
        @if(auth()->user()->permission('add-edit-level'))
        <a href="{{route('level.edit',['id'=>$level->id])}}">تعديل</a>
        @endif
    </div>
    @endforeach

</x-app-layout>