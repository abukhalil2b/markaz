<form action="{{route('admin.duaa.store')}}" method="post">
  @csrf

  <div class="modal fade" id="addDuaaModal" tabindex="-1" role="dialog" aria-labelledby="addDuaaModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addDuaaModal">إضافة مهام جديدة في مسار حفظ الأدعية والمتون </h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="px-3 py-3">

            <div class="p-1 mt-4">
              حدد التصنيف
              <select name="duaacate_id" class="form-control">
                <option value="">بدون تصنيف</option>
                @foreach($duaacates as $cate)
                <option value="{{$cate->id}}">{{$cate->title}}</option>
                @endforeach
              </select>
            </div>

            <div class="p-1 mt-4">
              حدد نوع المحتوى
              <select name="content_type" class="mt-1 form-control">
                <option value="duaas">{{__('duaas')}}</option>
                <option value="mutoons">{{__('mutoons')}}</option>
              </select>
            </div>

            <div class="p-1 mt-4">
              العنوان
              <input class="form-control" name="title">
            </div>

            <div class="mt-4">المحتوى</div>

            <x-textarea class="mt-1" name="content"></x-textarea>

          </div>
          <div class="modal-footer">
            <button class="btn block btn-secondary mt-3" type="submit">حفظ</button>
          </div>
        </div>
      </div>
    </div>
  </div>


</form>