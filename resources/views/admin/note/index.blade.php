<x-app-layout>
    <div class="p-3">
        قائمة الملحوظات
    </div>

    <div class="px-3">

        @foreach($notes as $note)
        <div class="mt-1 border rounded p-3 w-full bg-white">
            <div class="text-blue-700">[{{$note->student_id}}] {{$note->student->full_name}}</div>

            <div class="mt-4 text-sm">{{$note->title}}</div>

            <span class="text-gray-400 text-xs">
                {{date('d-m-Y',$note->note_at)}}
            </span>

            <div class="mt-4 text-red-900">
                الإجراء الإداري: {{ $note->action }}
            </div>

            <div class="mt-4 flex gap-3">
                <a href="{{ route('admin.note.edit',$note->id) }}" class="btn btn-sm btn-outline-danger">
                    كتابة الإجراء الإداري
                </a>

                <div x-data="{ show:false }">
                    <x-button-red x-cloak x-show=" ! show " @click="show = true">
                        حذف
                    </x-button-red>

                    <x-button-link-red href="{{ route('admin.note.delete',$note->id) }}" x-cloak x-show=" show ">
                        تأكيد الحذف
                    </x-button-link-red>
                </div>
            </div>

        </div>
        @endforeach

    </div>


</x-app-layout>