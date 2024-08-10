<x-app-layout>

    <form action="{{route('level.update')}}" method="post">
        @csrf
        <div class="mt-3">العنوان</div>
        <input name="title" class="form-input " value="{{$level->title}}">

        <div class="mt-3">الوصف</div>
        <textarea name="description" class="form-textarea">{{$level->description}}</textarea>

        <input name="id" type="hidden" value="{{$level->id}}">
        <button class="mt-4 btn btn-outline-warning w-100"> حفظ التعديل</button>
    </form>

</x-app-layout>