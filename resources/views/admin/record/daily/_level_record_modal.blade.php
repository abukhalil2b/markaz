<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-3">

            @if($workperiod->levelHasWorkperiods->count())
            
                <label class="bar3 w-full">
                    <span class="text-info bold">القاعة</span>
                    <input type="checkbox" onclick="levelCheckbox(this);" checked class="checkbox"> 
                    <span class="bold">تحديد الكل</span>
                </label>
                
            
            @endif

            <div class="text-gray-400 text-xs bg-white rounded my-1 p-1 inline-block">
            يتم إضافة الطلاب الموجودين في هذه القاعة إلى السجل مع الأخذ بعين الإعتبار الفترة التي يدرس فيها الطالب والجدول الأسبوعي
            </div>
            @foreach($levels as $level)
            <label class="w-full">
                <input type="checkbox" name="levels[]" value="{{$level->id}}" @if($level->id!=6) checked @endif class="checkbox levelCheckbox{{$workperiod->id}}">
                {{$level->title}}
            </label>
            @endforeach
        </div>
    </div>
</div>

<script>
    function levelCheckbox(source) {
        var checkboxes = document.querySelectorAll('.levelCheckbox{{$workperiod->id}}');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source)
                checkboxes[i].checked = source.checked;
        }
    }
</script>


