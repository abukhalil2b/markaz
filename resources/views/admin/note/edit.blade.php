<x-app-layout>


    <div class="p-3">

        <form action="{{route('admin.note.update',$note->id)}}" method="post">
            @csrf
            <input name="action" class="mt-2 rounded w-full h-10" value="{{$note->action}}">
            <x-button-primary class="mt-3 w-full">
                حفظ
            </x-button-primary>
        </form>

    </div>
</x-app-layout>