<x-app-layout>


<div class="home-btn-container">
    <div class="container">
        <div class="row ">
			<div class="col-lg-12">
				<a class="btn btn-danger"
                href="{{route('admin.record.daily.delete',['recorddaily'=>$recorddaily->id])}}">تأكيد الحذف</a>
			</div>
        </div>
    </div>
</div>



</x-app-layout>
