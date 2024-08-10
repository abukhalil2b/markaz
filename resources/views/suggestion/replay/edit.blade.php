<x-app-layout>

    <form action="{{route('suggestion.replay.update',['suggestion'=>$suggestion->id])}}" method="post">
        @csrf
        <textarea name="body" class="h-32 form-textarea" style="height: 200px !important;">{!!$suggestion->body!!}</textarea>
        <div class="mt-4 flex">
            <button class="btn btn-secondary block ml-5" type="submit">تعديل</button>
            <a class="btn btn-danger" href="{{route('suggestion.destroy',$suggestion->id)}}">حذف</a>
        </div>
    </form>
</x-app-layout>