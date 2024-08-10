<form action="{{route('duaacate.store')}}" method="post">
@csrf

<div class="modal fade" id="addDuaacateModal" tabindex="-1" role="dialog" aria-labelledby="addDuaacateModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="addDuaacateModal">تصنيف </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="px-3 py-3">

          <div>
          العنوان 
          <input class="form-control"  name="title" >
          </div>

        </div>
        <div class="modal-footer">
          <button class="btn block btn-secondary mt-3" type="submit">حفظ</button>
        </div>
      </div>
    </div>
  </div>
</div>


</form>