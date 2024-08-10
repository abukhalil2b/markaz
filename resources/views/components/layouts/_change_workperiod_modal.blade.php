<div class="modal fade" id="changeWorkperiodModal" tabindex="-1" role="dialog" aria-labelledby="changeWorkperiodModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<style >
    		.border-blue{
    			border-color: #1362ad !important;
    		}
    		.border-orange{
    			border-color: #dc1e5a !important;
    		}
    	</style>

      <div class="modal-body">
        
			@foreach(auth()->user()->userWorkperiods() as $workperiod)

				<div class="mt-3 ">
					<a class="btn btn-outline-secondary {{$workperiod->gender=='m'?'border-blue':'border-orange'}} w-100 "href="{{route('change_workperiod',$workperiod->id)}}">
						<div>{{ $workperiod->title }}</div>
						<div>{{ __($workperiod->gender) }}</div>
					</a>
				</div>

			@endforeach

      </div>
    </div>
  </div>
</div>