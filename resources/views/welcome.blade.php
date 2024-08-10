<x-layouts.guest>

    <div class="gap-10 w-full h-screen bg-gradient-to-t from-orange-200 to-white flex flex-col items-center justify-start p-5">
        <img src="assets/images/logo.png" width="100" />

        <div class="p-5 w-full bg-white rounded  flex  flex-col  items-center justify-center text-balance">
            {!! $frontpage->content ?? '' !!}
        </div>

        <div class="p-5 w-full bg-transparent rounded  flex justify-between items-center font-bold text-xl">
            <a href="login">دخول الإدارة</a>
            <a href="{{ route('student.login') }}">دخول الطلاب</a>
        </div>

    </div>

</x-layouts.guest>