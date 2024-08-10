@props(['report'=>NULL,'status'=>'ignore'])

@php
use Carbon\Carbon;
if($report != NULL){
    
    //if timing is not ignore
    if( ! $report->ignore_timing){

        //check tobedone date with current date
        $now = Carbon::now();

        $tobedoneAt = Carbon::createFromTimestamp($report->tobedone_at,'Asia/Muscat');

        if($now->greaterThan($tobedoneAt)){
            $status = 'late';
        }else{
            $status = 'onTime';
        }

    }
}

@endphp
<div x-data="{timing_status: '{{ $status }}' }">
    <div class="text-red-700 text-center">التوقيت </div>
    @if($report)
    <div class="w-full text-center text-xs">
				الوقت المتوقع لإنجاز المهمة
		<span>{{date('Y-m-d H:i',$report->tobedone_at)}}</span>
	</div>
    @endif

    <div class="flex gap-1 justify-center items-center">
        <div class="btn-timing-status" @click=" timing_status = 'ignore' " :class="timing_status == 'ignore' ? 'btn-timing-status-active' : '' ">
            تجاهل
        </div>

        <div class="btn-timing-status" @click=" timing_status = 'late' " :class="timing_status == 'late' ? 'btn-timing-status-active' : '' ">
            متأخر
        </div>

        <div class="btn-timing-status" @click=" timing_status = 'onTime' " :class="timing_status == 'onTime' ? 'btn-timing-status-active' : '' ">
            في الوقت
        </div>
    </div>
    <input name="timing_status" type="hidden" x-model="timing_status">
    
</div>