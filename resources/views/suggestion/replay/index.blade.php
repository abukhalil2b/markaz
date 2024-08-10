<x-app-layout>

    <div class="panel">
        {!!nl2br($suggestion->body)!!}
    </div>

    <div class="p-3 text-warning">
        الردود:
    </div>
    @foreach($replays as $replay)
    <div class="mt-2">
        {!!nl2br($replay->body)!!}

        <div class="py-3">
            <span class="text-red-800 italic text-xs">
                كتبه:
                @if($replay->user)
                {{$replay->user->first_name}}
                @endif
            </span>
            @if(auth()->user()->id==$replay->user_id)
            <a class="mx-4 bold text-red-700" href="{{route('suggestion.replay.edit',['suggestion'=>$replay->id])}}">إدارة</a>
            @endif
            <span class="text-xs text-gray-500">{{$replay->created_at->diffForHumans()}}</span>
        </div>

        <hr class="py-3">
    </div>
    @endforeach


    <div class="p-3">
        كتابة رد.
    </div>
    <form action="{{route('suggestion.replay.store')}}" method="post">
        @csrf

        <x-textarea name="body" />
        <input type="hidden" name="parent" value="{{$suggestion->id}}">
        <x-button-primary class="mt-5 w-full">
            حفظ
        </x-button-primary>

    </form>


</x-app-layout>