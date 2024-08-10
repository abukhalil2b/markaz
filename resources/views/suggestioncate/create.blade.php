<x-app-layout>


    <form action="{{route('suggestioncate.store')}}" method="post">
        @csrf
        <input name="title" class="form-input">
        <button class="mt-4 btn btn-outline-primary" type="submit">حفظ</button>
    </form>


</x-app-layout>