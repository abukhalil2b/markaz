<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-3">
            @if($workperiod->userHasWorkperiods->count())
            <label class="bar3 w-full">
                <span class="text-info bold">الطاقم الإداري</span>
                <input type="checkbox" onclick="userCheckbox(this);" checked class="checkbox"> 
                <span class="bold">تحديد الكل</span>
            </label>
            @endif

            <small class="text-gray-400 bg-white rounded my-1 p-1 inline-block">يتم إضافة الطاقم الإداري الموجودين إلى السجل</small>
            @foreach($users as $user)
            <label class="w-full">
                <input type="checkbox" name="userIds[]" value="{{$user->id}}" checked class="checkbox userCheckbox">
                {{$user->full_name}}
            </label>
            @endforeach
        </div>
    </div>
</div>

<script>
    function userCheckbox(source) {
        var checkboxes = document.querySelectorAll('.userCheckbox');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source)
                checkboxes[i].checked = source.checked;
        }
    }
</script>


