<x-app-layout>


    <form action="{{route('mission_hesas_date_update',['studentHasMission'=>$studentHasMission->id])}}" method="post" >
    	@csrf

		<div class="container">
		    <div class="row ">
				<div class="col-lg-12">
					<div>تبدأ</div>
					<input class="form-control" type="date" name="start_at" value="{{date('Y-m-d',$studentHasMission->start_at)}}">
					<div>تنتهي</div>
					<input class="form-control" type="date" name="tobedone_at" value="{{date('Y-m-d',$studentHasMission->tobedone_at)}}">
			    	<button class="btn btn-outline-secondary block">تعديل</button>
		    	</div>
		    </div>
		</div>
	</form>

</x-app-layout>
