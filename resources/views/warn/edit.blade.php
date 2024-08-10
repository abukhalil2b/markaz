<x-app-layout>


<style>
    .warn-btn {
        height: 20px;
        width: 20px;
        border-radius: 50%;
        background-color: #f5f5f5;
        border: 1px solid #b9b9b9;
        display: inline-block;
        margin: 2%;
    }

    .warn-btn-checked {
        border: 1px solid #db2a2a;
        background-color: #f7d2d2;
    }
</style>
<center class="px-3 py-3 ">
    <center>
        <h4>{{$student->full_name}}</h4>
        <div class="mt-5"></div>
        <h5>تحذير من عدد مرات الغياب</h5>
    </center>

    @foreach($warnabsents as $warnabsent)
    <a href="{{route('warn.absent_update',['warnabsent'=>$warnabsent->id])}}">
        <div class="warn-btn @if($warnabsent->absent) warn-btn-checked @endif"></div>
    </a>
    @endforeach

    <div>
        <a href="{{route('warn.absent_clear',['student'=>$student->id])}}">إلغاء الكل</a>
    </div>

</center>
<hr>

<center class="px-3 py-3 ">
    <center>
        <h5>تحذير من عدد مرات التأخر</h5>
    </center>

    @foreach($warnlates as $warnlate)
    <a href="{{route('warn.late_update',['warnlate'=>$warnlate->id])}}">
        <div class="warn-btn @if($warnlate->late) warn-btn-checked @endif"></div>
    </a>
    @endforeach

    <div>
        <a href="{{route('warn.late_clear',['student'=>$student->id])}}">إلغاء الكل</a>
    </div>

</center>

</x-app-layout>