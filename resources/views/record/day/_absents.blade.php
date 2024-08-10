<div class="text-center"> قائمة الغياب | العدد [{{count($absents)}}]</div>
<form action="{{ route('register_student_as_persent',$recorddaily->id) }}" method="post">
    @csrf

    <table class="jsDataTable" style="font-size: 12px;width:100%">
        <thead>
            <tr>
                <td>
                    <label>
                        <input type="checkbox" id="absentsMainCheckbox">
                        الأسم
                    </label>
                </td>
                <td>إدارة</td>
            </tr>
        </thead>
        <tbody>
            @foreach($absents as $absent)
            <tr class="bg-gradient-to-r from-white to-gray-200">
                <td>

                    <label class="bg-custom-gradient rounded p-1">
                        <input type="checkbox" name="absents[]" value="{{$absent->student_id}}" class="absentsOtherCheckbox">
                        <span style="min-width: 35px" class="text-center bg-primary rounded m-1 inline-block">
                            {{$absent->student_id}}
                        </span>
                        
                        {{$absent->full_name}}
                        <div class="text-xs">{{ $absent->teacher_room }}</div>

                        @if($absent->note)
                        <div>
                            <small>
                                {{$absent->note}}
                            </small>
                        </div>
                        @endif
                    </label>

                </td>
                <td>
                    <div class="flex gap-3">
                        <a class="btn btn-sm btn-outline-warning" href="{{route('record.day.edit',['id'=>$absent->id])}}">تعديل</a>
                        @include('record.day._remove_student_from_recorddaily')
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tr>
            <td colspan="3">
                <div class="form-check form-switch">
                    <input name="late" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                    <label class="form-check-label" for="flexSwitchCheckChecked">هل متأخر</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <input type="hidden" name="recordDay" value="{{$recorddaily->id}}">
                <input type="hidden" name="gender" value="m">
                @if(count($absents))
                <button id="buttonSave" class="w-full btn btn-outline-primary">نقلهم إلى سجل الحضور (0)</button>
                @endif
            </td>
        </tr>
    </table>
</form>
<script>
    //buttons
    var buttonSave = document.getElementById('buttonSave');
    var buttonCancel = document.getElementById('buttonCancel');


    /* ----  absents main checkbox  ------*/
    var absentsMainCheckbox = document.getElementById('absentsMainCheckbox');

    var absentsOtherCheckboxs = document.getElementsByClassName('absentsOtherCheckbox');
    /* ----  add event listener to absent other checkboxes ------*/
    for (var i = 0; i < absentsOtherCheckboxs.length; i++) {
        absentsOtherCheckboxs[i].onchange = () => {
            //append total absentsOtherCheckboxs to save button
            buttonSave.innerHTML = 'نقلهم إلى سجل الحضور (' + getCountOfCheckedboxes(absentsOtherCheckboxs) + ') ';
        }

    }

    absentsMainCheckbox.onchange = function(e) {

        for (var i = 0; i < absentsOtherCheckboxs.length; i++) {
            if (absentsMainCheckbox.checked) {
                absentsOtherCheckboxs[i].checked = true;
            } else {
                absentsOtherCheckboxs[i].checked = false;
            }
            buttonSave.innerHTML = 'حفظ  (' + getCountOfCheckedboxes(absentsOtherCheckboxs) + ') ';
        }

    }

    /* ----  add event listener to absent other checkboxes ------*/
    for (var i = 0; i < presentOtherCheckboxs.length; i++) {
        presentOtherCheckboxs[i].onchange = () => {
            //append total presentOtherCheckboxs to save button
            buttonCancel.innerHTML = 'إلغاء الحضور (' + getCountOfCheckedboxes(presentOtherCheckboxs) + ') ';
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
