<x-app-layout>

    <form action="{{route('admin.user.update',$user->id)}}" method="post">
        @csrf
        <div class="flex flex-wrap gap-3">
            <div class="">
                <span class="text-red-800">الرقم المدني</span>
                <input class="form-input" value="{{ $user->national_id }}" name="national_id">
            </div>
            <div class="">
                <span class="text-red-800">الاسم الاول</span>
                <input class="form-input" value="{{$user->first_name}}" name="first_name">
            </div>
            <div class="">
                <span class="text-red-800">الاسم الثاني</span>
                <input class="form-input" value="{{$user->second_name}}" name="second_name">
            </div>
            <div class="">
                <span class="text-red-800">الاسم الثالث</span>
                <input class="form-input" value="{{$user->third_name}}" name="third_name">
            </div>
            <div class="">
                <span class="text-red-800">القبيلة</span>
                <input class="form-input" value="{{$user->last_name}}" name="last_name">
            </div>
            <div class="">
                <span class="text-red-800">الاسم كاملا</span>
                <input class="form-input" value="{{$user->full_name}}" name="full_name">
            </div>

            <div class="">
                <span class="text-red-800">الهاتف</span>
                <input class="form-input" value="{{$user->phone}}" name="phone">
            </div>
            <div class="">
                <span class="text-red-800">نوع المستخدم</span>
                <select name="user_type" class="form-select">
                    @if($user->gender=='m')
                    <option @if($user->user_type=='male_moderator') selected @endif value="male_moderator">مشرف</option>
                    <option @if($user->user_type=='male_teacher') selected @endif value="male_teacher">مدرس</option>
                    @endif
                    @if($user->gender=='f')
                    <option @if($user->user_type=='female_moderator') selected @endif value="female_moderator">مشرفة</option>
                    <option @if($user->user_type=='female_teacher') selected @endif value="female_teacher">مدرسة</option>
                    @endif
                </select>
            </div>
            <div class="">
                <span class="text-red-800">حالة المستخدم</span>
                <select name="active" class="form-select">
                    <option value="1" @if( $user->active == 1) selected @endif >مفعل</option>
                    <option value="0" @if( $user->active == 0) selected @endif >معطل</option>
                </select>
            </div>

            <div class="">
                <span class="text-red-800"> سبب التعطيل او التنشيط إن وجد</span>
                <input class="form-input" value="{{$user->note}}" name="note">
            </div>

            <div class="">
                <span class="text-red-800">فترة العمل</span>
                <select class="form-select" name="workperiod_id">
                    @foreach($workperiods as $workperiod)
                    <option value="{{$workperiod->id}}" @if($workperiod->id==$user->workperiod_id) selected @endif>
                        {{$workperiod->title}}
                    </option>
                    @endforeach
                </select>
            </div>

        </div>

        <x-button-primary class="mt-5 w-1/4">
            حفظ
        </x-button-primary>

    </form>

</x-app-layout>