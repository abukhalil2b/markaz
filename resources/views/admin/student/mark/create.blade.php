<x-app-layout>


    <div class="font-semibold text-xl text-gray-800 leading-tight p-5">
        {{$student->full_name}}
    </div>


    <style>
        .mark-container {
            width: 250px;
            height: 250px;
            border-radius: 50%;
            border: #dda51d 1px solid;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .mark-link {
            padding: 5px;
            font-size: 11px;
        }

        .mark-title {
            font-weight: bold;
            color: #dda51d;
        }

        .mark-container-small {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: #dda51d 1px solid;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    </style>

    <div class="flex flex-wrap justify-center gap-3">

        <div class="mark-container">
            <div class="text-center mark-title">{{__('memorizeDuaa')}}</div>
            <a href="{{route('student.mark.addpointbytag',['student'=>$student->id,'tag'=>'memorizeDuaa','point'=>5])}}" class="text-center block mark-link ">
                الحصول على ممتاز في التحصيل (5 نقاط)
            </a>
            <a href="{{route('student.mark.addpointbytag',['student'=>$student->id,'tag'=>'memorizeDuaa','point'=>3])}}" class="text-center block mark-link ">
                الحصول على جيد جدا في التحصيل (3 نقاط)
            </a>
            <a href="{{route('student.mark.addpointbytag',['student'=>$student->id,'tag'=>'memorizeDuaa','point'=>2])}}" class="text-center block mark-link ">
                الحصول على جيد في التحصيل (2 نقاط)
            </a>
        </div>

        <div class="mark-container">
            <div class="text-center  mark-title">{{__('achieveReviewMission')}}</div>
            <a href="{{route('student.mark.addpointbytag',['student'=>$student->id,'tag'=>'achieveReviewMission','point'=>20])}}" class="text-center block mark-link ">
                الحصول على ممتاز في التحصيل (20 نقاط)
            </a>
            <a href="{{route('student.mark.addpointbytag',['student'=>$student->id,'tag'=>'achieveReviewMission','point'=>10])}}" class="text-center block mark-link ">
                الحصول على جيد جدا في التحصيل (10 نقاط)
            </a>
            <a href="{{route('student.mark.addpointbytag',['student'=>$student->id,'tag'=>'achieveReviewMission','point'=>5])}}" class="text-center block mark-link ">
                الحصول على جيد في التحصيل (5 نقاط)
            </a>
        </div>

    </div>


    <div class="mt-4 flex flex-wrap justify-center gap-3">

        <div class="mark-container-small">
            <a href="{{route('student.mark.addpointbytag',['student'=>$student->id,'tag'=>'interactionInClassRoom','point'=>5])}}">
                <div class="text-center mark-title" style="font-size:12px; padding-top: 10px;">
                    {{__('interactionInClassRoom')}}
                    <div>(5 نقاط)</div>
                </div>
            </a>
        </div>

        <div class="mark-container-small">
            <a href="{{route('student.mark.addpointbytag',['student'=>$student->id,'tag'=>'general','point'=>0])}}">
                <div class="text-center mark-title" style="font-size:12px; padding-top: 8px;">
                    {{__('general')}}
                </div>
            </a>
        </div>

        @if($student->gender=='f')

        <div class="mark-container-small">
            <a href="{{route('student.mark.addpointbytag',['student'=>$student->id,'tag'=>'ladiesAffairs','point'=>0])}}">
                <div class="text-center mark-title" style="font-size:14px; padding-top: 8px;">
                    {{__('ladiesAffairs')}}
                </div>
            </a>
        </div>

        @endif
    </div>

    <div class="mt-4 flex flex-wrap justify-center gap-3">

        <div class="mark-container-small">
            <a href="{{route('student.mark.addpointbytag',['student'=>$student->id,'tag'=>'presentOnTime','point'=>2])}}">
                <div class="text-center mark-title">
                    {{__('presentOnTime')}}
                    <div>(نقطتان)</div>
                </div>
            </a>
        </div>

        <div class="mark-container-small">
            <a href="{{route('student.mark.addpointbytag',['student'=>$student->id,'tag'=>'knowledgeShare','point'=>0])}}">
                <div class="text-center mark-title">
                    {{__('knowledgeShare')}}
                </div>
            </a>
        </div>

        <div class="mark-container-small">
            <a href="{{route('student.mark.addpointbytag',['student'=>$student->id,'tag'=>'appearance','point'=>0])}}">
                <div class="text-center mark-title" style="font-size:13px;">
                    {{__('appearance')}}
                </div>
            </a>
        </div>

    </div>



    @include('admin.student.mark._mark')

</x-app-layout>