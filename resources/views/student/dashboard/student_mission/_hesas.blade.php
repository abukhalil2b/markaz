<div class="mt-4 p-1 flex justify-between bg-primary text-white text-xl rounded-t">
    <a class="text-white hover:text-red-800" href="">
        مسار إنجاز الحصص
    </a>

</div>
<div class="p-1 border rounded-b shadow-md">
    @foreach($hesasReviewMissions as $reviewMission)

        @php

            if($reviewMission->success == 1){
                $cssClass = 'bg-green-100 border-green-600';
            }else{
                $cssClass = 'bg-gray-200 border-gray-600';
            }

            if($reviewMission->done_at == NULL){
                $cssClass = '';
            }

            $moderatorCssClass = ' bg-gray-200 ';

            $adminCssClass = ' bg-gray-200 ';

            if($reviewMission->step_approval == 1 || $reviewMission->step_approval == 2){
                $moderatorCssClass = ' bg-green-200 border-green-600 ';
            }

            if($reviewMission->step_approval == 2){
                $adminCssClass = ' bg-green-200 border-green-600 ';
            }

		@endphp

    <div class="mt-1 p-3 border rounded text-center  {{ $cssClass }}">

        <div class="flex gap-3">
            <div class="border rounded mt-3 p-1 {{ $moderatorCssClass }} ">
                اعتماد المشرف
            </div>

            <div class="border rounded mt-3 p-1 {{ $adminCssClass }} ">
                اعتماد الإدارة
            </div>
        </div>

        <div class="text-blue-600 text-xl font-bold"> {{ $reviewMission->mission_title }} </div>

        <p>{{ $reviewMission->mission_description }}</p>

        <div>
            بدأت: {{date('Y-m-d',$reviewMission->start_at)}}
        </div>

        @if($reviewMission->done_at!=null)
        <p>تمت: {{ date('Y-m-d',$reviewMission->done_at) }}</p>


        @if($reviewMission->step_approval == 2)
        <div>

            <div>{{ $reviewMission->notes }}</div>
            <div class="text-xs">عدد المحاولات:
                {{$reviewMission->try_number}}
            </div>
            <div class="text-xs">عدد الأخطاء:
                {{$reviewMission->numwrong}}
            </div>
            <div class="text-xs">عدد التنبيهات:
                {{$reviewMission->attention_number}}
            </div>
            <div class="text-xs">عدد التوقفات:
                {{$reviewMission->stop_number}}
            </div>

            <div>التقييم: {{$reviewMission->evaluation}}</div>

            <div>ملحوظات: {{$reviewMission->notes}}</div>
        </div>
        @endif
        @endif


    </div>

    @endforeach
</div>