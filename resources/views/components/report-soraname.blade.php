@props(['report'])
<div>
    <div class="text-3xl text-center">
        {{$report->soraname}}
    </div>

    <div class="mt-1 text-center">
        @if($report->whole)
        كاملة
        @else
        @if(!$report->tasktype=='new-multisora')
        @else من {{$report->ayafrom}} الى {{$report->ayato}}
        @endif
        @endif
    </div>
</div>