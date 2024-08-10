<x-app-layout>
    @php
    $loggedUserHasPermission = auth()->user()->permission('manage-mission');
    @endphp
    @foreach($studentHasMissions as $studentHasMission)

    <div>
        @php
        if ($studentHasMission->done_at == null) {
        $bgCss = 'bg-white';
        }
        else
        {
        $bgCss = $studentHasMission->success == 1 ? 'bg-green-100 border-green-600' : 'bg-gray-200 border-gray-400';
        }

        $moderatorCssClass = ' bg-gray-200 ';

        $adminCssClass = ' bg-gray-200 ';

        if($studentHasMission->step_approval == 1 || $studentHasMission->step_approval == 2){
            $moderatorCssClass = ' bg-green-200 border-green-600 ';
        }

        if($studentHasMission->step_approval == 2){
            $adminCssClass = ' bg-green-200 border-green-600 ';
        }

        @endphp

    </div>


    <div class="mt-1 p-1 border rounded  {{ $bgCss }}">

        <div class="flex gap-3">
            <div class="border rounded mt-3 p-1 {{ $moderatorCssClass }} ">
                اعتماد المشرف
            </div>

            <div class="border rounded mt-3 p-1 {{ $adminCssClass }} ">
                اعتماد الإدارة
            </div>
        </div>


        <div class="flex justify-between">
            <div class="text-xl text-red-800"> {{$studentHasMission->mission_title}}</div>
            <div>{{$studentHasMission->id}}</div>
        </div>

        <div class="mt-3 text-xs">بدأت: {{date('d-m-Y',$studentHasMission->start_at)}}</div>

        <div class="text-xs">
            @if($studentHasMission->done_at!=null)
            <div>تمت: {{date('d-m-Y',$studentHasMission->done_at)}}</div>
            <div class="mt-3">
                التقدير: {{ $studentHasMission->evaluation }}
            </div>

            @endif

            <div class="text-xs">عدد المحاولات:
                {{$studentHasMission->try_number}}
            </div>
            <div class="text-xs">عدد الأخطاء:
                {{$studentHasMission->numwrong}}
            </div>
            <div class="text-xs">عدد التنبيهات:
                {{$studentHasMission->attention_number}}
            </div>
            <div class="text-xs">عدد التوقفات:
                {{$studentHasMission->stop_number}}
            </div>

            <div class="text-xs mt-3 py-3">{{$studentHasMission->notes}}</div>

            @if( $studentHasMission->wrongs && count( json_decode($studentHasMission->wrongs) ) )
            @foreach(json_decode($studentHasMission->wrongs) as $wrong)
            <div class="text-xs">{{ $wrong->note }}</div>
            @endforeach
            @endif

        </div>

        <div>
            @if($loggedUserHasPermission)

            @if($studentHasMission->step_approval == 1 || $studentHasMission->step_approval == 2 )
            <div class="p-1 text-[10px]">لايمكن حذف أو تعديل ما تم إعتماده</div>
            @else
            <div class="mt-4 flex gap-5">
                <a class="btn btn-sm btn-outline-danger" href="{{ route('admin.student.mission_hesas.delete',['studentHasMission'=>$studentHasMission->id]) }}">
                    حذف
                </a>
                <a class="btn btn-sm btn-outline-warning" href="{{ route('admin.student.mission_hesas.edit',['studentHasMission'=>$studentHasMission->id]) }}">
                    تعديل
                </a>
            </div>
            @endif
            @endif
        </div>

    </div>

    @endforeach


</x-app-layout>