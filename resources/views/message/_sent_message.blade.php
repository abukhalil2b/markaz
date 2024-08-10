<div x-cloak x-show="!showReceivedMessages" class="px-3 py-3">
    @foreach($sentMessages as $sentMessage)

    <div class="bg-white shadow-sm mt-2 p-1 border rounded hover:bg-white/80 hover:border hover:border-brownDark" :class="messageIds.includes({{ $sentMessage->id }})? 'bg-orangeLight border font-bold border-brownDark shadow-none' : '' " @click="selectMessageId({{ $sentMessage->id }})">
        <div class="flex justify-between">
            <div class="w-full">
                
            {!! nl2br($sentMessage->content) !!}
               
            </div>

            <div class="mt-3 text-xs text-gray-400 w-20 text-left">
                {{ $sentMessage->created_at->format('d-m-Y') }}
            </div>
        </div>
        <div class="text-xs italic">
            <span class="text-red-700">المستلمين:</span>
            <div>
                @foreach( $sentMessage->receivers as $receiver )

                <span class="mx-1 {{ $receiver->pivot->is_read == 1 ? 'text-green-400' : ''  }}">{{ $receiver->fullName }}</span>

                @endforeach
            </div>
        </div>
    </div>

    @endforeach



    <div class="mt-3 flex justify-center">

        <div x-cloak x-show="loading" class="loader"></div>

        <x-button-red @click="handleDelete()" x-cloak x-show="messageIds.length > 0 && !loading" class="mt-3">
            حذف (<span x-text="messageIds.length"></span>)
        </x-button-red>

    </div>

</div>