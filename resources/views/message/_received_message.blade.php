<div x-cloak x-show="showReceivedMessages" class="px-3 py-3">
    @foreach($receivedMessages as $receivedMessage)

    <div class="bg-white shadow-sm mt-2 p-1 rounded">

        {!! nl2br($receivedMessage->content) !!}

        <div class="mt-3 text-xs italic">{{ $receivedMessage->sender->fullName }} . {{ $receivedMessage->created_at->format('d-m-Y') }}</div>

    </div>

    @endforeach
</div>