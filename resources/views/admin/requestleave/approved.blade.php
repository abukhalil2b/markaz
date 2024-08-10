@foreach($approvedRequestleaves as $requestleave)
<div class="mt-3 flex flex-col sm:flex-row w-full items-center justify-between rounded-xl bg-white p-3 font-semibold text-gray-500 shadow-[0_0_4px_2px_rgb(31_45_61_/_10%)] transition-all duration-300 hover:scale-[1.01] hover:text-primary dark:bg-[#1b2e4b]">


    <div>

        <div>
            {{ $requestleave->user->fullname }}
        </div>

        <div class="mt-2 flex flex-col gap-1 text-xs">
            <div class="text-blue-600 ">من {{ $requestleave->datefrom }}</div>
            <div class="text-pink-600 ">إلى {{ $requestleave->dateto }}</div>
            <div class="text-gray-400 ">تاريخ الطلب {{ $requestleave->created_at->format('d-m-Y') }}</div>
        </div>

    </div>

    <div class="text-xs">
        {{ $requestleave->description }}
    </div>

    <!-- permission -->
    @if(auth()->user()->permission('decide-requestleave'))

    <div x-data="{ open:false,toggle(){this.open = !this.open} }" @click.outside="open = false">
        <button :class="open? 'hidden' : ''" @click="toggle">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 opacity-70">
                <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.0"></circle>
                <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.0"></circle>
                <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.0"></circle>
            </svg>
        </button>
        <ul x-cloak x-show="open" class="flex flex-col gap-1">
            <li><a class="btn btn-outline-primary w-20" href="{{ route('admin.requestleave.update_status',['requestleave'=>$requestleave->id,'status'=>'new']) }}" @click="toggle"> <span class="text-xs">قيد الدراسة</span> </a></li>
            <li><a class="btn btn-outline-danger w-20" href="{{ route('admin.requestleave.update_status',['requestleave'=>$requestleave->id,'status'=>'rejected']) }}" @click="toggle"> <span class="text-xs">رفض</class=> </a></li>
        </ul>
    </div>

    @endif

</div>
@endforeach