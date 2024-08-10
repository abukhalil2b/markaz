<x-app-layout>
    <div class="p-3 text-xl">
        تسجيل طالب جديد
    </div>

    <form method="POST" action="{{ route('admin.student.store') }}">
        @csrf

        <div class="mt-4 text-xl text-red-800">
            نوع الطالب: {{ __(auth()->user()->gender) }}
        </div>

        <div class="mt-4">
            القاعة
            <select name="level_id" class="mt-1 w-full rounded border">

                @foreach($levels as $level)

                <option value="{{ $level->id }}">{{ $level->title }}</option>

                @endforeach
            </select>
        </div>

        <div class="mt-4">
            أيام الدراسة
            <select name="study_days" class="mt-1 w-full rounded border">
                <option value="op1">الأحد - الثلاثاء -الخميس</option>
                <option value="op2">الإثنين - الأربعاء - الخميس</option>
            </select>
        </div>

        <div class="mt-4">
            الرقم المدني
            <input type="number" name="national_id" class="mt-1 w-full rounded border">
        </div>

        <div class="mt-4 grid grid-cols-4 gap-1">
            <div class="w-full">
                الاسم الأول
                <input type="text" name="first_name" class="mt-1 w-full rounded border">
            </div>


            <div class="w-full">
                الاسم الثاني
                <input type="text" name="second_name" class="mt-1 w-full rounded border">
            </div>


            <div class="w-full">
                الاسم الثالث
                <input type="text" name="third_name" class="mt-1 w-full rounded border">
            </div>


            <div class="w-full">
                القبيلة
                <input type="text" name="last_name" class="mt-1 w-full rounded border">
            </div>
        </div>


        <div class="mt-4">
            <button class="btn btn-outline-primary">تسجيل الطالب</button>
        </div>

    </form>

</x-app-layout>