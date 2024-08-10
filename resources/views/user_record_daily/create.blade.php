<x-app-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        إحصائيات
    </h2>
<div class="px-3 py-3">
  <form action="{{route('present_time_setting.store')}}" method="post">
    @csrf

    وقت حضور المشرف
    <input class="form-control" type="time" name="moderator_should_be_present_at" >

    وقت حضور المدرس
    <input class="form-control" type="time" name="teacher_should_be_present_at" >

    وقت حضور الطالب
    <input class="form-control" type="time" name="student_should_be_present_at" >

     حصول الطالب على نقاط عند وصوله قبل الوقت المحدد هنا
    <input class="form-control" type="time" name="student_award_time" >

    <button class="btn block btn-secondary" type="submit">حفظ</button>
  </form>
</div>

</x-app-layout>