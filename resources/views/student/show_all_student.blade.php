<x-app-layout>

    <div class="w-full flex gap-1 py-2 text-xs text-center justify-between items-center">
        <div class="border p-1 rounded w-36">
            عدد الطلاب: {{count($students)}}
        </div>

        <div class="border p-1 rounded w-36">
            اليوم: {{__(date('D'))}}
        </div>

        <a class="btn btn-sm btn-outline-secondary" href="#" onclick="window.print();">طباعة</a>
    </div>

    @foreach($students as $student)
    <div class="overflow-hidden mt-1 border rounded flex justify-between flex-col sm:flex-row">

        <div class="flex gap-1 items-center">
            <a href="{{route('admin.student.dashboard',['student'=>$student->id])}}">
                @if($student->gender == 'm')
                <img src="{{ asset('assets/images/avatar/avatar.png') }}" width="45">
                @else
                <img src="{{ asset('assets/images/avatar/avatar-female.png') }}" width="45">
                @endif
            </a>

            <div class="flex items-center gap-1">
                <div class="rounded border w-12 h-8 p-1 border-black {{ $student->under_observation ? 'bg-red-800 text-white' : ''}}">{{$student->id}}</div>

                <div>
                    <div class="text-md"> {{ $student->full_name }} </div>
                    <div class="text-xs"> {{ $student->level_title }} </div>
                </div>

                <div>
                    @if($student->status == 'disabled')
                    <span class="text-danger">معطل</span>
                    @endif
                </div>

            </div>
        </div>

    </div>
    @endforeach


</x-app-layout>