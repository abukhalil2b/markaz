<x-app-layout>

    <div class="text-xl text-gray-800 leading-tight">
        <a class="btn btn-outline-primary" href="{{ route('message.create') }}">+ جديد</a>
    </div>

    <div class="mt-3 ml-5">
        <div x-data="{ showSentMessages: false,showReceiverMessages:true }">

            <div class="flex gap-2">
                <div @click="showReceiverMessages = true; showSentMessages = false" class="btn-option" :class="showReceiverMessages ? 'btn-option-selected' : '' ">الرسائل المستلمة</div>
                <div @click="showSentMessages = true; showReceiverMessages = false" class="btn-option" :class="showSentMessages ? 'btn-option-selected' : '' ">الرسائل المرسلة</div>
            </div>

            <div x-cloak x-show="showReceiverMessages" class="mt-5">
                @foreach($receivedMessages as $receivedMessage)
                <div class="mt-1 border rounded p-1 overflow-x-scroll">
                    <div>{!! nl2br($receivedMessage->content) !!}</div>
                    <div class="mt-2 text-xs text-gray-400">{{ $receivedMessage->sender->shortName }} . {{ $receivedMessage->created_at }}</div>
                    <div>
                        <a href="{{ route('message.replay_create',$receivedMessage->id) }}" class="text-xs text-blue-700">
                            كتابة رد
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div x-cloak x-show="showSentMessages" class="mt-5">
                @foreach($sentMessages as $sentMessage)
                <div class="mt-1 border rounded p-1 overflow-x-scroll">
                    <div>{!! nl2br($sentMessage->content) !!}</div>
                    <div class="mt-2 text-xs text-gray-400">{{ $sentMessage->created_at }}</div>

                    <span class="text-xs">المستلمين:</span>
                    <div class="flex overflow-x-scroll h-8">
                        @foreach($sentMessage->receivers as $receiver)
                        <div class="whitespace-nowrap p-1 text-xs text-center {{ $receiver->pivot->is_read == 1 ? 'text-green-600' : 'text-gray-400' }}">{{ $receiver->shortName }}</div>
                        @endforeach
                    </div>
                    <a class="block mt-4 text-warning text-xs" href="{{ route('message.edit',$sentMessage->id) }}">تعديل</a>
                </div>
                @endforeach
            </div>

        </div>
    </div>

</x-app-layout>