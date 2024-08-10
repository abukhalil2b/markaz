<x-app-layout>


    @if(count($students))
    <form action="{{route('admin.student.approve')}}" method="post">
    	@csrf
	    <div class="container">
	      <div class="row ">
	            <div class="col-lg-12">
	            	<label class="selectAll">
	            		<input type="checkbox" onclick="studentCheckbox(this)" style="width: 20px; height: 22px;">
	            		تحديد الكل
	            	</label>
					@foreach($students as $student)
					<div class="bar3 mt-2">
						<label>
							<input type="checkbox" name="ids[]" class="checkbox studentCheckbox" value="{{$student->id}}">
							<span class="student-number">{{$student->id}}</span>
	                        {{$student->full_name}}
						</label>
					</div>



					@endforeach

					<div class="mt-2 flex gap-2">
					<button class="btn btn-outline-primary w-full ">اعتمد</button>
					<x-button-link-red href="{{route('admin.student.waiting_approval_student_show_delete_form')}}">
						حذف
					</x-button-link-red>
					</div>
	          </div>
	      </div>
	    </div>
    </form>
    @else
    <center style="font-size: 2em;">لايوجد طلاب</center>
    @endif

    <style>

    	.selectAll{
    		background: #dfbd8e;
		    color: white;
		    width: 100px;
		    border-radius: 6px;
		    padding: 4px;
		    margin: 10px;
		    display: flex;
		    align-items: center;
		    justify-content: center;
		    gap: 5px;
    	}
    	.selectAll:hover{
    		cursor: pointer;
    		opacity: 0.8;
    	}
    </style>
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