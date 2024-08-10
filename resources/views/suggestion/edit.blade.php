<x-app-layout>

    <form action="{{route('suggestion.update',['suggestion'=>$suggestion->id])}}" method="post">
        @csrf
        <textarea name="body" class="form-textarea">{!!$suggestion->body!!}</textarea>
        <div class="mt-4 flex gap-4">
            <button class="btn btn-secondary" type="submit">حفظ</button>
            <a class="btn btn-danger" href="{{route('suggestion.destroy',$suggestion->id)}}">حذف</a>
        </div>
    </form>

</x-app-layout>