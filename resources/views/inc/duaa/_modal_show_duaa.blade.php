<div class="modal fade" id="duaaContentModal{{$duaa->id}}" tabindex="-1" role="dialog" aria-labelledby="duaaContentModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <small>{!!nl2br($duaa->title)!!} </small>
      </div>
      <div class="modal-body">
        <div class="px-3 py-3">
            {!!nl2br($duaa->content)!!} 
        </div>
        <div class="modal-footer">
      		<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
      			موافق
      		</button>
            <a class="btn btn-outline-warning mx-3" href="{{route('admin.duaa.edit',$duaa->id)}}">
              تعديل
            </a>

            <a class="btn btn-outline-danger mx-3" href="{{route('admin.duaa.delete',$duaa->id)}}">
              حذف
            </a>
            
        </div>
      </div>
    </div>
  </div>
</div>
