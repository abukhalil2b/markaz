<x-app-layout>
    <div class="panel flex justify-between">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            {{$suggestioncate->title}}
        </div>
        <a class="font-bold text-primary" href="{{route('suggestion.create',['suggestioncate'=>$suggestioncate->id])}}">
            +جديد
        </a>
    </div>
    <div class="px-3">
        @foreach($suggestions as $suggestion)
        <div class="mt-4 panel">

            <div class="font-bold">
            {!!nl2br($suggestion->body)!!}
            </div>

            <hr class="mt-4">

            <div class="py-4 text-xs text-gray-600">

                كتبه: @if($suggestion->user){{$suggestion->user->fullName}}@endif
                
                <span class="pull-left">{{$suggestion->created_at->diffForHumans()}}</span>
                
                @if(auth()->user()->id==$suggestion->user_id)
                <a class="mx-2 btn btn-sm btn-outline-warning inline-block" href="{{route('suggestion.edit',['suggestion'=>$suggestion->id])}}">إدارة</a>
                @endif
               
                <a class="mx-2 btn btn-sm btn-outline-secondary inline-block" href="{{route('suggestion.replay.index',['suggestion'=>$suggestion->id])}}">
                    الردود: {{$suggestion->replays->count()}}
                </a>
            </div>

        </div>
        @endforeach
    </div>

</x-app-layout>