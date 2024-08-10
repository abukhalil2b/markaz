@props(['title','missions','student','collapseId'])
<div class="mt-1 space-y-2 font-semibold">

    <div class="rounded border border-[#d3d3d3] dark:border-[#1b2e4b]">
        <button type="button" class="flex w-full items-center p-4 text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === {{$collapseId}}}" x-on:click="active === {{$collapseId}} ? active = null : active = {{$collapseId}}">
            {{ $title }}
            <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === {{$collapseId}} }">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4">
                    <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </button>
        <div x-cloak x-show="active === {{$collapseId}}" x-collapse>
            <div class="border-t border-[#d3d3d3] p-4 text-[13px] dark:border-[#1b2e4b]">

                <div class="flex flex-wrap gap-2">
                    @foreach($missions as $mission)

                    <a class="w-44 mt-1 p-1 border rounded bg-white" href="{{route('admin.student.mission_hesas.create',['student'=>$student->id,'mission'=>$mission->id])}}">
                        <div class="text-black">
                            {{$mission->title}}
                        </div>
                        <div class="text-xs text-gray-400">
                            {{$mission->note}}
                        </div>
                    </a>

                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>