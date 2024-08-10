<x-app-layout>


<form action="{{route('shift_student_to_other_workperiod_store',$level->id)}}" method="post">
    @csrf


<div class="container">
    <div class="row justify-content-center">

        <div class="col-lg-12">
            <div class="bar">
                {{$level->title}}
            </div>

            <label class="py-2 w-full">
                <input type="checkbox" checked onclick="studentCheckbox(this);" class="checkbox"> تحديد الكل
            </label>
            @foreach($level->students as $student)
            <label class="bar3 w-full">
            	<input type="checkbox" checked name="studentIds[]" value="{{$student->id}}" class="studentCheckbox">
                [{{$student->id}}] {{$student->full_name}}
                <small class="text-red-800">{{$student->level->title}}</small>
            </label>
            @endforeach
        </div>

        <div class="col-lg-12">
        	<select name="workperiod_id" class="form-control">
		        @foreach($workperiods as $workperiod)
		        <option value="{{$workperiod->id}}" @if($workperiod->id == $level->workperiod_id) selected @endif>
		        {{$workperiod->title}}
		        </option>
		       @endforeach
		    </select>
        </div>

        <div class="col-lg-12  mt-3">
            <button class="btn btn-outline-secondary w-100" >
                نقل الطلاب إلى فترة أخرى
                <small class="text-red-900">
                 (يمكنك إستثناء بعض الطلاب أو الكل)
                </small>
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

