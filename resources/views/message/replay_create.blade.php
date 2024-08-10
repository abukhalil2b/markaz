<x-app-layout>

       <h2 class="text-xl text-gray-800 leading-tight">
            المرسل: {{ auth()->user()->full_name }}
        </h2>
    <form action="{{ route('message.replay_store') }}" method="POST">
        @csrf

        <div class="mt-3 p-3">

            <div>
                <div class="text-xl text-blue-800">الرسالة</div>
                <div class="mt-1 p-1 rounded border bg-white">
                    {!! nl2br($message->content) !!}
                    <div class="text-xs text-gray-400">المرسل: {{ $message->sender->shortName }} . {{ $message->created_at }}</div>
                </div>

            </div>

            @if(count($messageReplays))
            <div class="mt-5">
                <div class="text-xl text-blue-800">الردود</div>
                @foreach($messageReplays as $messageReplay)
                <div class="mt-1 border rounded p-1">
                    <div>{!! nl2br($messageReplay->content) !!}</div>
                    <div class="text-xs text-gray-400">{{ $messageReplay->sender->shortName }} . {{ $messageReplay->created_at }}</div>
                    
                    @if($messageReplay->sender_id == auth()->id())
                    <a class="block mt-4 text-warning text-xs" href="{{ route('message.edit',$messageReplay->id) }}">تعديل</a>
                    @endif
                </div>
                @endforeach
            </div>
            @endif

            <div class="mt-4 text-xl text-blue-800 p-1">كتابة رد</div>
            <textarea name="content" class="w-full h-36 block outline-0 p-1 border rounded"></textarea>

            @error('content') <span class="text-red-400">{{ $message }}</span> @enderror



            <!-- مستلم الرد -->
            <input type="hidden" name="receiver_id" value="{{ $messageReceiverId }}">
            <input type="hidden" name="parent_id" value="{{ $message->id }}">

            <div class="mt-4 w-full flex justify-center">
                <x-button-primary class="w-full">
                    <span class="text-blue-800"> ارسل رد لـ </span> ( {{ $messageReceiverName }} )
                </x-button-primary>
            </div>

        </div>

    </form>


</x-app-layout>