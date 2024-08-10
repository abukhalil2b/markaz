<x-app-layout>

    <form action="{{route('suggestioncate.update',['suggestioncate'=>$suggestioncate->id])}}" method="post">
        @csrf
        <input name="title" class="form-input" value="{{$suggestioncate->title}}">
        <button class="mt-4 btn btn-outline-primary" type="submit">حفظ</button>
    </form>
</x-app-layout>