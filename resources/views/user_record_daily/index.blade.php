<x-app-layout>
    <div>
        متابعة غياب {{ $user_type }} بتاريخ ( {{ $todayDate }} )
    </div>
    @if(count($userRecordDailies))

    <div class="table-responsive">
        القائمة بتاريخ:
        @if($todayDate){{$todayDate}}@endif

        <form action="{{ route('user_record_daily.update_moderator_seen') }}" method="POST">
            @csrf

            <table class="table table-bordered mt-3 small">
                <tr>
                    <td>
                        <label class="w-20 block cursor-pointer">
                            <input type="checkbox" id="selectAllCheckbox">
                            حدد الكل
                        </label>
                        <button class="btn-sm btn btn-outline-primary">
                            تم الإشراف
                        </button>
                    </td>
                    <td>الاسم</td>
                    <td>
                        <div class="text-xs text-16">
                            وقت حضورك يجب أن يكون قبل:
                        </div>
                    </td>
                    <td>الحضور</td>
                    <td>
                        <div class="w-32">سبب التأخر إن وجد</div>
                    </td>
                    <td> ملحوظة المشرف </td>

                </tr>
                @foreach($userRecordDailies as $user)

                <tr>
                    <td>
                        <input type="checkbox" name="ids[]" value="{{ $user->id }}" @if( $user->moderator_seen ) checked @endif class="presentUser">
                    </td>
                    <td>

                        {{ $user->name }}

                        <div class="text-warning">
                        <a href="{{ route('user_record_daily.details',$user->user_id) }}">
                                تفاصيل
                            </a>
                        </div>
                    </td>
                    <td>
                        {{ $user->should_be_present_at }}
                    </td>
                    <td>
                        @if($user->present_time)
                        {{ $user->present_time }}
                        @else
                        <div class="badge whitespace-nowrap badge-outline-danger text-center">
                            غائب
                        </div>
                        <a href="{{ route('admin.user_record_daily.create',$user->user_id) }}">تسجيل الحضور</a>
                        @endif
                    </td>
                    <td>
                        <div class="text-[10px]">{!! nl2br($user->note) !!}</div>
                    </td>
                    <td>
                        <div class="text-[10px]">

                            <a href="{{ route('user_record_daily.moderator_note.edit',$user->id) }}" class="block">
                                ملحوظة المشرف
                            </a>

                            {!! nl2br($user->moderator_note) !!}

                        </div>
                    </td>
                </tr>

                @endforeach
            </table>
        </form>

    </div>

    @endif

    <script>
        var selectAllCheckbox = document.getElementById('selectAllCheckbox');
        var presentUsers = document.getElementsByClassName('presentUser');

        /* ----  present main checkbox  ------*/
        selectAllCheckbox.onchange = function(e) {

            for (var i = 0; i < presentUsers.length; i++) {
                if (selectAllCheckbox.checked) {
                    presentUsers[i].checked = true;
                } else {
                    presentUsers[i].checked = false;
                }

            }

        }
    </script>

</x-app-layout>