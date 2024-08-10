<x-app-layout>
    <div class="p-5">
        @if(auth()->user()->permission('suggestioncate-admin'))

        <a href="{{route('suggestioncate.create')}}">+قاعة جديد</a>

        @endif
    </div>

    @foreach($suggestioncates as $suggestioncate)
    <div class="mt-3 panel">
        <div>
            {{$suggestioncate->title}}
            <span class="text-brownDark">{{$suggestioncate->suggestions->count()}}</span>
        </div>
        <div class="flex gap-3">

            @if(auth()->user()->permission('suggestioncate-admin'))

            <a class="text-brownDark" href="{{route('suggestioncate.edit',['suggestioncate'=>$suggestioncate->id])}}">تعديل العنوان</a>

            <a class="text-brownDark" href="{{route('suggestioncate.show',['suggestioncate'=>$suggestioncate->id])}}">الصلاحيات</a>

            @endif

            <a class="text-brownDark" href="{{route('suggestion.index',['suggestioncate'=>$suggestioncate->id])}}">عرض المحتوى</a>

        </div>
    </div>
    @endforeach

</x-app-layout>