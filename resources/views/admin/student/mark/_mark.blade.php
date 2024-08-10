@if($marks )
<table class="table" style="width: 100%;">
    <tr>
        <td>التاريخ</td>
        <td>المحور</td>
        <td>الملحوظات</td>
        <td>النقاط</td>
        <td>إدارة</td>
    </tr>
    @foreach($marks as $mark)
    <tr>
        <td>
            <div class="text-xs text-gray-400">تاريخ منح النقطة {{$mark->created_at->format('d-m-Y')}}</div>
            <div class="text-xs text-gray-400">


                @if(!isset($student))
                <span class="text-blue-800 font-bold text-sm block">
                    {{$mark->student->full_name}}
                </span>
                @endif
            </div>
        </td>

        <td>
            {{__($mark->tag)}}
        </td>
        <td>
            {{$mark->note}}
        </td>
        <td>
            {{$mark->point}}
        </td>
        <td>
            <a href="{{route('student.mark.delete',['mark'=>$mark->id])}}">حذف</a>
        </td>
    </tr>
    @endforeach

</table>
@endif

<div class="mt-5">
    {{ $marks->links() }}
</div>