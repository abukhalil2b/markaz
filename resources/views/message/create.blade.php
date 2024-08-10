<x-app-layout>
    <h2 class="text-xl text-gray-800 leading-tight">
        المرسل: {{ auth()->user()->full_name }}
    </h2>
    <form action="{{ route('message.store') }}" method="POST">
        @csrf

        <div class="mt-3 p-3">
            <div>
                <div class="text-xl">الرسالة</div>
                <textarea name="content" class="w-full h-36 block outline-0 p-1 border rounded"></textarea>

                @error('content') <span class="text-red-400">{{ $message }}</span> @enderror

            </div>

            <div class="mt-4 p-1 rounded border">
                <div class="text-xl">المستلمين</div>

                <div class="mt-4 text-xl">الإدارة</div>
                <div class="flex flex-wrap gap-3">
                    @foreach($admins as $admin )
                    <label class="p-1 flex items-center gap-1 bg-white">
                        <input type="checkbox" name="receiverIds[]" value="{{ $admin->id }}">
                        {{ $admin->shortName }}
                    </label>
                    @endforeach
                </div>

                <div class="mt-4 text-xl">المشرفين</div>
                <div class="flex flex-wrap gap-3">
                    @foreach($maleModerators as $maleModerator)
                    <label class="p-1 flex items-center gap-1 bg-white">
                        <input type="checkbox" name="receiverIds[]" value="{{ $maleModerator->id }}">
                        {{ $maleModerator->shortName }}
                    </label>
                    @endforeach
                </div>

                <div class="mt-4 text-xl">المشرفات</div>
                <div class="flex flex-wrap gap-3">
                    @foreach($femaleModerators as $femaleModerator)
                    <label class="p-1 flex items-center gap-1 bg-white">
                        <input type="checkbox" name="receiverIds[]" value="{{ $femaleModerator->id }}">
                        {{ $femaleModerator->shortName }}
                    </label>
                    @endforeach
                </div>

                <div class="mt-4 text-xl">المدرسين</div>
                <div class="flex flex-wrap gap-3">
                    @foreach($maleTeachers as $maleTeacher)
                    <label class="p-1 flex items-center gap-1 bg-white">
                        <input type="checkbox" name="receiverIds[]" value="{{ $maleTeacher->id }}">
                        {{ $maleTeacher->shortName }}
                    </label>
                    @endforeach
                </div>

                <div class="mt-2">المدرسات</div>
                <div class="flex flex-wrap gap-3">
                    @foreach($femaleTeachers as $femaleTeacher)
                    <label class="p-1 flex items-center gap-1 bg-white">
                        <input type="checkbox" name="receiverIds[]" value="{{ $femaleTeacher->id }}">
                        {{ $femaleTeacher->shortName }}
                    </label>
                    @endforeach
                </div>

            </div>

            <div class="mt-5 w-full flex justify-center">
                <x-button-primary class="w-full">
                    ارسل
                </x-button-primary>
            </div>

        </div>

    </form>
</x-app-layout>