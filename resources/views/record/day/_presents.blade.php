<div class="text-center"> قائمة الحضور | العدد [{{count($presents)}}]</div>
<form action="{{route('register_student_as_absent',$recorddaily->id)}}" method="post">
    @csrf
    <table class="jsDataTable" style="font-size: 12px;width:100%;">
        <thead>
            <tr>
                <td>
                    <label>
                        <input type="checkbox" id="presentMainCheckbox">
                        الأسم
                    </label>
                </td>
                <td>وقت الحضور</td>
                <td>التأخر أو الغياب</td>
            </tr>
        </thead>
        <tbody>
            @foreach($presents as $present)
            <tr class="bg-gradient-to-r from-white to-green-100">
                <td>
                    <label class="p-1">
                        <div class="flex items-center">
                            <input type="checkbox" name="absents[]" value="{{$present->student_id}}" class="presentOtherCheckbox">
                            <span style="min-width: 35px" class="text-center bg-primary rounded m-1 inline-block">
                                {{$present->student_id}}
                            </span>
                            {{$present->full_name}}
                        </div>
                        <div class="text-xs">{{ $present->teacher_room }}</div>
                        @if($present->note)
                        <div class="text-orange">
                            {{$present->note}}
                        </div>
                        @endif
                        @if( $present->islate )
                        <div class="text-red-600">
                            متأخر
                        </div>
                        @endif
                    </label>
                </td>
                <td>{{date('H:i',$present->present_time)}}</td>
                <td>

                    <a class="btn btn-sm btn-outline-warning" href="{{route('record.day.edit',['id'=>$present->id])}}">تعديل</a>

                </td>
            </tr>
            @endforeach
        </tbody>
        <tr>
            <td colspan="3">
                <input type="hidden" name="recordDay" value="{{$recorddaily->id}}">
                <input type="hidden" name="gender" value="m">
                @if(count($presents))
                <button id="buttonCancel" class="w-full btn btn-outline-primary">نقلهم إلى سجل الغياب</button>
                @endif
                
            </td>
        </tr>
    </table>
</form>

<script>
    //buttons
    var buttonSave = document.getElementById('buttonSave');
    var buttonCancel = document.getElementById('buttonCancel');

    //other checkboxes
    var presentOtherCheckboxs = document.getElementsByClassName('presentOtherCheckbox');

    var presentMainCheckbox = document.getElementById('presentMainCheckbox');

    /* ----  present main checkbox  ------*/
    presentMainCheckbox.onchange = function(e) {

        for (var i = 0; i < presentOtherCheckboxs.length; i++) {
            if (presentMainCheckbox.checked) {
                presentOtherCheckboxs[i].checked = true;
            } else {
                presentOtherCheckboxs[i].checked = false;
            }
            buttonCancel.innerHTML = 'إلغاء الحضور   (' + getCountOfCheckedboxes(presentOtherCheckboxs) + ') ';
        }

    }

    /* ----  functions  ------*/
    var getCountOfCheckedboxes = (checkboxes) => {
        //inital number of checkboxes
        var totalChecked = 0;
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                //count checkboxes
                totalChecked++
            }
        }

        return totalChecked;
    }
</script>