<x-app-layout>

<form action="{{route('shift_student_to_other_level_store')}}" method="post">
@csrf

<div class="container">
    <div class="row justify-content-center">

        <div class="col-lg-12">

            <span class="text-success">
                طلاب:
            </span>
            {{$level->title}}

            <label class="py-2 w-full">
                <input type="checkbox" checked onclick="studentCheckbox(this);" class="checkbox"> تحديد الكل
            </label>
            @foreach($students as $student)
            <label class="bar3 w-full">
            	<input type="checkbox" checked name="studentIds[]" value="{{$student->id}}" class="studentCheckbox">
                {{$student->full_name}}
            </label>
            @endforeach
        </div>

        <div class="col-lg-12 mt-3">
        	<select name="level_id" class="form-control">
		        @foreach($levels as $divsion)
		        <option value="{{$divsion->id}}" @if($divsion->id == $level->id) selected @endif>
		        {{$divsion->title}}
		        </option>
		       @endforeach
		    </select>
        </div>

        <div class="col-lg-12  mt-1">
            <button class="btn btn-outline-secondary w-100" >
                <small>نقل الطلاب الموجودين في هذا القاعة إلى قاعة آخر (المحدد في الأعلى)</small>
            </button>
        </div>
    </div>
</div>

</form>


<script>

    function studentCheckbox(source) {
        var checkboxes = document.querySelectorAll('.studentCheckbox');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source)
                checkboxes[i].checked = source.checked;
        }
    }
</script>

</x-app-layout>

