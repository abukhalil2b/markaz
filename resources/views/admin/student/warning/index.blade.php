<x-app-layout>

    <div class="panel">
        <span class="student-number">{{$student->id}}</span>
        {{$student->full_name}}
    </div>


    <div class="mt-4 p-1 text-white bg-info">
        إجراء المعلم
    </div>
    <div class="p-1 mt-2 {{$w1?'bg-orange text-white':'bg-white'}}">
        [1] <a href="{{route('admin.student.warning.create',['student'=>$student->id,'level'=>'1'])}}">إشعار رقم 1</a>
        @if($w1)
        <div>
            {{$w1->description}}
            <i class="text-xs"> {{$w1->created_at->diffForHumans()}} </i>
        </div>
        @endif

    </div>

    <div class="p-1 mt-2 {{$w2?'bg-orange text-white':'bg-white'}}">
        [2] <a href="{{route('admin.student.warning.create',['student'=>$student->id,'level'=>'2'])}}">إشعار رقم 2</a>
        @if($w2)
        <div style="font-size: 10px;">{{$w2->description}}
            <i style="color:#ededed;padding:3px">{{$w2->created_at->diffForHumans()}}</i>
        </div>
        @endif
    </div>

    <div class="mt-4 p-1 text-white bg-info">
        إجراء الإدارة
    </div>
    <div class="p-1 mt-2 {{$w3?'bg-orange text-white':'bg-white'}}">
        [3] <a href="{{route('admin.student.warning.create',['student'=>$student->id,'level'=>'3'])}}">تنبيه رقم 1</a>
        @if($w3)
        <div style="font-size: 10px;">{{$w3->description}}
            <i style="color:#ededed;padding:3px">{{$w3->created_at->diffForHumans()}}</i>
        </div>
        @endif
    </div>

    <div class="p-1 mt-2 {{$w4?'bg-orange text-white':'bg-white'}}">
        [4] <a href="{{route('admin.student.warning.create',['student'=>$student->id,'level'=>'4'])}}">تنبيه رقم 2</a>
        @if($w4)
        <div style="font-size: 10px;">{{$w4->description}}
            <i style="color:#ededed;padding:3px">{{$w4->created_at->diffForHumans()}}</i>
        </div>
        @endif
    </div>

    <div class="p-1 mt-2 {{$w5?'bg-red-400 text-white':'bg-white'}}">
        [5] <a href="{{route('admin.student.warning.create',['student'=>$student->id,'level'=>'5'])}}">استدعاء ولي أمر الطالب</a>
        @if($w5)
        <div style="font-size: 10px;">{{$w5->description}}
            <i style="color:#ededed;padding:3px">{{$w5->created_at->diffForHumans()}}</i>
        </div>
        @endif
    </div>

    <div class="p-1 mt-2 {{$w6?'bg-red-400 text-white':'bg-white'}}">
        [6] <a href="{{route('admin.student.warning.create',['student'=>$student->id,'level'=>'6'])}}">فصل</a>
        @if($w6)
        <div style="font-size: 10px;">{{$w6->description}}
            <i style="color:#ededed;padding:3px">{{$w6->created_at->diffForHumans()}}</i>
        </div>
        @endif
    </div>


</x-app-layout>