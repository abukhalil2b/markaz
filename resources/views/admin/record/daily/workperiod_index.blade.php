<div class="container">
	<div class="row">
		<div class="col-lg-12">
			@foreach($workperiods as $workperiod)
				<div class="card card-body mt-1 shadow">
					<div class="card-title">{{$workperiod->title}}</div>

					<div class="card-subtitle">
						<a >
							الطاقم الإداري: {{$workperiod->userHasWorkperiods->count()}}
						</a>
					</div>

					<div class="card-subtitle">
						القاعة: {{$workperiod->levelHasWorkperiods->count()}}
					</div>
				</div>
				@include('admin.record.daily._user_record_modal')
				@include('admin.record.daily._level_record_modal')
			@endforeach
		</div>
	</div>
</div>

