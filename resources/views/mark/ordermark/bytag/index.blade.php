<x-app-layout>

	<div class="py-4 text-xl text-center">
محاور النقاط
	</div>


	<div class="mt-3 panel">
		<a href="{{route('mark.mark_orderby_tag_details',['tag'=>'missionTask'])}}">
			<h5 class="text-red-800">{{__('missionTask')}}</h5>
		</a>
	</div>

	<div class="mt-3 panel">
		<a href="{{route('mark.mark_orderby_tag_details',['tag'=>'general'])}}">
			<h5 class="text-red-800">{{__('general')}}</h5>
		</a>
	</div>

	<div class="mt-3 panel">
		<a href="{{route('mark.mark_orderby_tag_details',['tag'=>'appearance'])}}">
			<h5 class="text-red-800">{{__('appearance')}}</h5>
		</a>
	</div>

	<div class="mt-3 panel">
		<a href="{{route('mark.mark_orderby_tag_details',['tag'=>'achieveReviewMission'])}}">
			<h5 class="text-red-800">{{__('achieveReviewMission')}}</h5>
		</a>
	</div>

	<div class="mt-3 panel">
		<a href="{{route('mark.mark_orderby_tag_details',['tag'=>'memorizeDuaa'])}}">
			<h5 class="text-red-800">{{__('memorizeDuaa')}}</h5>
		</a>
	</div>

	<div class="mt-3 panel">
		<a href="{{route('mark.mark_orderby_tag_details',['tag'=>'interactionInClassRoom'])}}">
			<h5 class="text-red-800">{{__('interactionInClassRoom')}}</h5>
		</a>
	</div>

	<div class="mt-3 panel">
		<a href="{{route('mark.mark_orderby_tag_details',['tag'=>'knowledgeShare'])}}">
			<h5 class="text-red-800">{{__('knowledgeShare')}}</h5>
		</a>
	</div>

	@if( $showLadiesAffairs )
	<div class="mt-3 panel">
		<a href="{{route('mark.mark_orderby_tag_details',['tag'=>'ladiesAffairs','gender'=>'f'])}}">
			<h5 class="text-red-800">{{__('ladiesAffairs')}}</h5>
		</a>
	</div>
	@endif





</x-app-layout>