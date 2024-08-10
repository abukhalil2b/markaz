<x-app-layout>

    <form action="{{ route('message.update',$message->id) }}" method="POST">
        @csrf

        <div class="text-xl">الرسالة</div>
        <textarea name="content" class="mt-4 form-textarea h-32">{{ $message->content }}</textarea>
        @error('content') <span class="text-red-400">{{ $message }}</span> @enderror

        <x-button-primary class="mt-4 w-full">
            تحديث
        </x-button-primary>

    </form>
</x-app-layout>