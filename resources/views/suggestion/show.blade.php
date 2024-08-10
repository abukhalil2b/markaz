<x-app-layout>

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$suggestioncate->title}}
        </h2>
        <a href="{{route('suggestion.create',['suggestioncate'=>$suggestioncate->id])}}">+جديد</a>


    <div class="px-3">
        @foreach($suggestioncate->suggestions as $suggestion)
        <div class="border p-1 rounded w-full">
            {{$suggestion->body}}
        </div>
        @endforeach
    </div>

</x-app-layout>