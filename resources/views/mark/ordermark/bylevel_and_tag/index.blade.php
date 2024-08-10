<x-app-layout>
	<div>
		النقاط التي بدأت بتاريخ {{ $searchKey }}

		@include('mark.ordermark._modal_change_search_date')
	</div>

	<div class="px-3 text-xl">
		{{$level->title}}
	</div>



		<div class="mt-3 panel">
			<a class="hover:text-red-800" href="{{route('mark.mark_orderby_level_and_tag_details',['level'=>$level->id,'tag'=>'general'])}}">
				<h5 class="border rounded border-blue-800 bg-blue-50">{{__('general')}}</h5>
			</a>
			@foreach($general as $mark)
			<div class="border rounded p-1">
				<div>[{{$mark->student_id}}] {{$mark->student->full_name}} ( {{$mark->total_point}} نقطة).</div>
				<span class="small">{{$mark->student->level->title}}</span>
			</div>
			@endforeach
		</div>

		<div class="mt-3 panel">
			<a class="hover:text-red-800" href="{{route('mark.mark_orderby_level_and_tag_details',['level'=>$level->id,'tag'=>'appearance'])}}">
				<h5 class="border border-blue-800 bg-blue-50">{{__('appearance')}}</h5>
			</a>
			@foreach($appearance as $mark)
			<div class="border rounded p-1">
				<div>[{{$mark->student_id}}] {{$mark->student->full_name}} ( {{$mark->total_point}} نقطة).</div>
				<span class="small">{{$mark->student->level->title}}</span>
			</div>
			@endforeach
		</div>

		<div class="mt-3 panel">
			<a class="hover:text-red-800" href="{{route('mark.mark_orderby_level_and_tag_details',['level'=>$level->id,'tag'=>'achieveReviewMission'])}}">
				<h5 class="border border-blue-800 bg-blue-50">{{__('achieveReviewMission')}}</h5>
			</a>
			@foreach($achieveReviewMission as $mark)
			<div class="border rounded p-1">
				<div>[{{$mark->student_id}}] {{$mark->student->full_name}} ( {{$mark->total_point}} نقطة).</div>
				<span class="small">{{$mark->student->level->title}}</span>
			</div>
			@endforeach
		</div>

		<div class="mt-3 panel">
			<a class="hover:text-red-800" href="{{route('mark.mark_orderby_level_and_tag_details',['level'=>$level->id,'tag'=>'memorizeDuaa'])}}">
				<h5 class="border border-blue-800 bg-blue-50">{{__('memorizeDuaa')}}</h5>
			</a>
			@foreach($memorizeDuaa as $mark)
			<div class="border rounded p-1">
				<div>[{{$mark->student_id}}] {{$mark->student->full_name}} ( {{$mark->total_point}} نقطة).</div>
				<span class="small">{{$mark->student->level->title}}</span>
			</div>
			@endforeach
		</div>

		<div class="mt-3 panel">
			<a class="hover:text-red-800" href="{{route('mark.mark_orderby_level_and_tag_details',['level'=>$level->id,'tag'=>'interactionInClassRoom'])}}">
				<h5 class="border border-blue-800 bg-blue-50">{{__('interactionInClassRoom')}}</h5>
			</a>
			@foreach($interactionInClassRoom as $mark)
			<div class="border rounded p-1">
				<div>[{{$mark->student_id}}] {{$mark->student->full_name}} ( {{$mark->total_point}} نقطة).</div>
				<span class="small">{{$mark->student->level->title}}</span>
			</div>
			@endforeach
		</div>

		<div class="mt-3 panel">
			<a class="hover:text-red-800" href="{{route('mark.mark_orderby_level_and_tag_details',['level'=>$level->id,'tag'=>'knowledgeShare'])}}">
				<h5 class="border border-blue-800 bg-blue-50">{{__('knowledgeShare')}}</h5>
			</a>
			@foreach($knowledgeShare as $mark)
			<div class="border rounded p-1">
				<div>[{{$mark->student_id}}] {{$mark->student->full_name}} ( {{$mark->total_point}} نقطة).</div>
				<span class="small">{{$mark->student->level->title}}</span>
			</div>
			@endforeach
		</div>

		<div class="mt-3 panel">
			<a class="hover:text-red-800" href="{{route('mark.mark_orderby_level_and_tag_details',['level'=>$level->id,'tag'=>'missionTask'])}}">
				<h5 class="border border-blue-800 bg-blue-50">{{__('missionTask')}}</h5>
			</a>
			@foreach($missionTask as $mark)
			<div class="border rounded p-1">
				<div>[{{$mark->student_id}}] {{$mark->student->full_name}} ( {{$mark->total_point}} نقطة).</div>
				<span class="small">{{$mark->student->level->title}}</span>
			</div>
			@endforeach
		</div>

		@if(count($ladiesAffairsMarks))
		<div class="mt-3 panel">
			<a class="hover:text-red-800" href="{{route('mark.mark_orderby_level_and_tag_details',['level'=>$level->id,'tag'=>'ladiesAffairs'])}}">
				<h5 class="border border-blue-800 bg-blue-50">{{__('ladiesAffairs')}}</h5>
			</a>
			@foreach($ladiesAffairsMarks as $mark)
			<div class="border rounded p-1">
				<div>[{{$mark->student_id}}] {{$mark->student->full_name}} ( {{$mark->total_point}} نقطة).</div>
				<span class="small">{{$mark->student->level->title}}</span>
			</div>
			@endforeach
		</div>
		@endif





</x-app-layout>