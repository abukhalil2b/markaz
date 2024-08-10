<x-app-layout>
    <h2 class="text-xl text-gray-800 leading-tight">
        متابعة الغياب - {{$user->fullName}}
    </h2>
<div class="px-3">

    <table class="table table-bordered mt-3 small">
        <tr>
            <td>تاريخ السجل</td>
            <td>الحضور</td>
            <td>سبب التأخر إن وجد</td>
        </tr>
    @foreach($userRecordDailies as $userRecordDaily)

        <tr>
            <td>
                <small>{{$userRecordDaily->created_at->format('Y-m-d')}}</small>
            </td>
            <td>
                @if($userRecordDaily->present_time)

               <div class="{{ $userRecordDaily->islate? 'bg-red-100' : ''}}">
               {{$userRecordDaily->present_time}}
               </div>

                <div class="text-xs text-gray-400">
                    يجب أن يحضر قبل
                    {{$userRecordDaily->should_be_present_at}}
                </div>

                @else
                غائب
                @endif
            </td>
            <td>
                <small>{{$userRecordDaily->note}}</small>
            </td>
        </tr>

    @endforeach
     </table>

</div>
</x-app-layout>