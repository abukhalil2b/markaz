<x-app-layout>

    <div class="p-3">
        النقل إلى قاعة أخرى
    </div>

    <form action="{{ route('admin.teacher.shiftlevel.update') }}" method="post">
        @csrf

        <div class="panel">
            <div>
                [{{$teacher->id}}] {{$teacher->full_name}}
            </div>

            <div>
                @if($teacher->level) القاعة الحالية: {{$teacher->level->title}}@endif
            </div>
        </div>
        <select name="level_id" class="mt-5 form-select">
            @foreach($levels as $level)
            <option value="{{$level->id}}" @if($teacher->level&&$teacher->level->id == $level->id)
                selected="selected"
                @endif
                >{{$level->title}}
            </option>
            @endforeach
        </select>
        </div>
        <div class="mt-6 ">
            <input type="hidden" name="teacher_id" value="{{$teacher->id}}">
            <input type="hidden" name="user_type" value="{{$teacher->user_type}}">
            <button class="btn w-52 btn-outline-secondary" type="submit">نقل</button>
        </div>

    </form>


</x-app-layout>