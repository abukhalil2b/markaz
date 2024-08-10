<x-app-layout>

    <form action="{{route('suggestion.store')}}" method="post">
        @csrf
        <textarea name="body" class="h-72 form-textarea"></textarea>
        <input type="hidden" name="suggestioncate_id" value="{{$suggestioncate->id}}">

        <button type="submit" class="mt-4 btn btn-outline-primary ">
            حفظ
        </button>
    </form>

</x-app-layout>