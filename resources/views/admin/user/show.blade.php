<x-app-layout>
<div class="p-3">
     {{$user->fullName}} - {{$user->userType()}}
</div>

    <form action="{{route('user_has_workperiod_permission.update',$user->id)}}" method="post">
        @csrf

        <div class="container">

            <div class="row ">
                @foreach($workperiods as $workperiod)
                <label class="col-md-3 w-full">

                    <input name="workperiodId[]" @if($user->hasWorkperiod($workperiod->id)) checked @endif type="checkbox" class="checkbox" value="{{$workperiod->id}}">
                    {{$workperiod->title}}

                </label>
                @endforeach
            </div>

            <x-button-primary class="w-full mt-5">
                حفظ
            </x-button-primary>

        </div>

    </form>

    <div class="mt-5 border p-3 rounded">
        <div class="font-bold text-xl"> حذف المستخدم مع كل الارتباطات </div>

        <div>
            @if($messageReceiverCount)
            الإشعارات والتنبيه - مستلمة {{ $messageReceiverCount }}
            @endif
        </div>

        <div>
            @if($messagesCount)
            الإشعارات والتنبيه - مرسلة {{ $messagesCount }}
            @endif
        </div>

        <div>
            @if($notesCount)
            الملحوظات التي كتبها {{ $notesCount }}
            @endif
        </div>

        <div>
            @if($requestleavesCount)
            طلبات الإجازة {{ $requestleavesCount }}
            @endif
        </div>

        <div>
            @if($storednotesCount)
            عبارات الإطراء والشكر {{ $storednotesCount }}
            @endif
        </div>

        <div>
            @if($suggestionsCount)
            المقترحات التي كتبها {{ $suggestionsCount }}
            @endif
        </div>


        <div>
            @if($userRecorddailiesCount)
            الحضور والغياب {{ $userRecorddailiesCount }}
            @endif
        </div>

        <div x-data="{ open:false }" class="flex flex-col items-center">
            <div @click=" open=true " class="text-red-400 font-bold hover:cursor-pointer">الحذف</div>
            <x-button-link-red x-cloak x-show="open" href="{{ route('admin.user.delete',$user->id) }}" class="mt-5 w-full">
                تأكيد الحذف
            </x-button-link-red>
        </div>

    </div>



</x-app-layout>