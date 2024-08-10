<x-app-layout>


    <div class="px-3">

        @include('storednote._new')

        @foreach($storednotes as $storednote)
        <div class="mt-2 border rounded p-1 flex justify-between">
            <div>
                <div>{{ $storednote->content }}</div>
                <div class="text-xs text-gray-300">{{ $storednote->user->fullName }}</div>
            </div>
            <div x-data="{show:false}">
                <div x-cloak x-show=" ! show" @click="show = true" class="w-14 bg-red-50 rounded border text-red-600 !border-red-600 cursor-pointer  p-1 text-center">حذف</div>
                <a x-cloak x-show="show" href="{{ route('storednote.delete',$storednote->id) }}" class="text-red-400">أكيد الحذف</a>
            </div>
        </div>
        @endforeach

    </div>
</x-app-layout>