<x-app-layout>

    <h2 class="py-4 font-semibold text-xl text-gray-800 leading-tight">
        تعديل طالب
    </h2>

    <form action="{{route('admin.student.update',$student->id)}}" method="post">
        @csrf
        <div class="flex flex-wrap gap-2">
            <div>
                <span class="text-red-800">الاسم الاول</span>
                <input class="form-input" value="{{$student->first_name}}" name="first_name">
            </div>
            <div>
                <span class="text-red-800">الاسم الثاني</span>
                <input class="form-input" value="{{$student->second_name}}" name="second_name">
            </div>
            <div>
                <span class="text-red-800">الاسم الثالث</span>
                <input class="form-input" value="{{$student->third_name}}" name="third_name">
            </div>
            <div>
                <span class="text-red-800">القبيلة</span>
                <input class="form-input" value="{{$student->last_name}}" name="last_name">
            </div>
            <div>
                <span class="text-red-800">الاسم كاملا</span>
                <input class="form-input" value="{{$student->full_name}}" name="full_name">
            </div>

            <div>
                <span class="text-red-800">الرقم السري</span>
                <input class="form-input" value="{{$student->password}}" name="password">
            </div>

            <div>
                <span class="text-red-800">الرقم المدني</span>
                <input class="form-input" value="{{$student->national_id}}" name="national_id">
            </div>

            <div>
                <span class="text-red-800">حالة الطالب: {{__($student->status)}}</span>
                <select name="status" class="form-input h-12">
                    <option @if($student->status=='active') selected @endif value="active"> {{__('active')}} </option>
                    <option @if($student->status=='disabled') selected @endif value="disabled"> {{__('disabled')}} </option>
                </select>
            </div>


        </div>
        <div class="mt-4">
            <span class="text-red-800">ملحوظات</span>
            <input class="form-input" value="{{ $student->note }}" name="note">
        </div>
        <button class="mt-5 w-full btn btn-outline-secondary">حفظ</button>
    </form>



</x-app-layout>