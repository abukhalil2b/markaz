<x-student.layout>
    <div class="p-3">
<div class="flex justify-center text-xl text-red-800">
    ملحوظات
</div>
        @foreach($notes as $note)
        <div class="mt-1 p-1 rounded bg-white border border-black">
            <div>[{{$note->student_id}}] {{$note->student->full_name}}</div>

            <span class="pull-left text-xs">
                {{ $note->created_at->format('Y-m-d') }}
            </span>

            <div class="text-sm">{{$note->title}}</div>

            <div class="text-red-900">
                الإجراء الإداري: {{$note->action}}
            </div>
        </div>
        @endforeach

        <div class="col-md-12 mt-5">
            {{ $notes->links() }}
        </div>
    </div>
</x-student.layout>