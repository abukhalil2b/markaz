<x-app-layout>

  <div class="w-full flex gap-1 py-2 text-xs text-center justify-between items-center">

    <div class="">
      عدد الطلاب: {{ count($students) }}
    </div>

    <div class="">
      اليوم: {{ __(date('D')) }}
    </div>

    @if(auth()->user()->permission('search-all-students'))
    @include('student._modal_search_all_student')
    @endif

    <a class="btn btn-sm btn-outline-secondary" href="#" onclick="window.print();">طباعة</a>
    <a class="btn btn-sm btn-outline-primary" href="{{ route('student.attendance.student_index',$latestRecorddaily->id) }}">
      عرض السجل
    </a>
  </div>

  <div class="py-2 text-xs flex justify-between">
    <div class="p-1">
      بناءً علي ما يتم تسجيله في سجل الحضور اليومي سيظهر امام اسم الطالب
    </div>
  </div>

  <form action="{{ route('admin.student.index') }}" method="POST">
    @csrf
    <div class="w-full flex justify-center items-center gap-1">
      <x-input name="search" class="form-input" />
      <button class="btn btn-outline-primary">
        بحث
      </button>
    </div>
  </form>

  @foreach($students as $student)
  <div class="overflow-hidden mt-1 border rounded flex justify-between flex-col sm:flex-row {{ $student->is_study_day  ?
                      '' : 'bg-gray-200 opacity-40' }}">

    <div class="w-full flex gap-1 items-center">
      <a href="{{route('admin.student.dashboard',['student'=>$student->id])}}">
        @if($student->gender == 'm')
        <img src="{{ asset('assets/images/avatar/avatar.png') }}" width="45">
        @else
        <img src="{{ asset('assets/images/avatar/avatar-female.png') }}" width="45">
        @endif
        <div class="text-center font-bold h-6 p-1 {{ $student->under_observation ? 'bg-red-800 text-white' : ''}}">{{$student->id}}</div>
      </a>
      <div class="w-full flex items-center justify-between">

        <div>
          <div class="text-md"> {{ $student->full_name }} </div>
          <div class="text-xs"> {{ $student->level_title }} </div>
        </div>

        <div class="px-1">
          @if($student->status == 'disabled')
          <span class="text-danger">معطل</span>
          @endif

          @if($student->record_daily)
          <div>

            @if($student->record_daily->present_time)

            <span class="text-success">{{ $student->record_daily->present_time }}</span>

            @else

            <div class="text-danger">غائب</div>

            <div>
              @if($student->record_daily->with_excuse == 1)
             <div class="text-success"> معذور </div>
              @elseif($student->record_daily->with_excuse == 0)
              <div class="text-[10px] text-danger">
                <div class="text-md"> غير معذور</div>
                <div>{{ $student->record_daily->note }}</div>
              </div>
              @endif
            </div>

            <a class="mt-2 btn btn-sm btn-outline-info" href="{{ route('admim.student_has_record_daily.absent_excuse_create',$student->record_daily->id) }}">
             رصد الغياب بدون عذر
            </a>

            @endif

          </div>

          @endif
          <!-- end record_daily -->
        </div>

      </div>


    </div>


  </div>
  @endforeach


</x-app-layout>