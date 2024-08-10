<x-app-layout>
 <div class="p-3">
      نقاط الطالب
 </div>

    <div class="col-md-12 mt-5">

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
                    <div class="extra-small">تاريخ المناسبة {{$mark->day}}-{{$mark->month}}-{{$mark->year}}</div>
                    <div class="extra-small text-gray-400">تاريخ منح النقطة {{$mark->created_at->format('d-m-Y')}}</div>
                    <div class="extra-small text-gray-400">
                        @if($mark->recordweekly)
                        {{$mark->recordweekly->title}}
                        @else
                        <span class="text-red-800 font-bold text-sm">لايوجد سجل اسبوعي</span>
                        @endif

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

    </div>

    <div class="col-md-12 mt-5">
        {{ $marks->links() }}
    </div>


</x-app-layout>