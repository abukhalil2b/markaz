<x-app-layout>
<div class="p-3">
     قائمة الملحوظات
</div>

    <div class="px-3">

        @foreach($notes as $note)
        <div class="bar2">
            <div>[{{$note->student_id}}] {{$note->student->full_name}}</div>

            <span class="pull-left text-xs">
                {{ $note->created_at->format('Y-m-d') }}
            </span>

            <div class="text-sm">{{$note->title}}</div>



            <a href="{{route('note.edit_action',['note'=>$note->id])}}">
                <div class="text-red-900">
                    الإجراء الإداري: {{$note->action}}
                </div>
            </a>
            <a class="mt-3 inline-block hover:text-red-600" onclick="return confirm('تأكيد');" href="{{route('note.delete',$note->id)}}"> حذف </a>
        </div>
        @endforeach

    </div>


</x-app-layout>