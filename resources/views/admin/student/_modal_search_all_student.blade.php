<div class="modal fade" id="searchAllStudentModal" tabindex="-1" role="dialog" aria-labelledby="searchAllStudentModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<form action="{{route('admin.search_all_students')}}" method="post">
    		@csrf
	      <div class="modal-header">

	      </div>

	      <div class="modal-body">
	      	أدخل رقم الطالب
	        <input name="id" class="form-control" type="number">
	      </div>

	      <div class="modal-footer">
	      	<button class="btn block btn-outline-primary mt-3" >بحث</button>
	        
	        </div>
      </form>
    </div>
  </div>
</div>