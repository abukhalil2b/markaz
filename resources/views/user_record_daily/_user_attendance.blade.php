<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset='utf-8' />

    <title>مؤسسة دار الإتقان العالي</title>

    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <link rel="icon" type="image/png" href="/assets/images/favicon.png" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="flex items-center px-4 py-4">
        <div class="flex-none">
            @if(Auth::user()->gender == 'm')
            <img class="rounded-md w-10 h-10 object-cover" src="/assets/images/avatar/avatar.png" alt="image" />
            @else
            <img class="rounded-md w-10 h-10 object-cover" src="/assets/images/avatar/avatar-female.png" alt="image" />
            @endif
        </div>
        <div class="ltr:pl-4 rtl:pr-4 truncate">
            <div class="text-base">
                {{ Auth::user()->first_name }} {{ Auth::user()->last_name}}
            </div>

            <div class="text-gray-400">
                @if(Auth::user()->id != 18)
                {{ __(Auth::user()->user_type) }}
                @endif
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();" class="text-red-400 text-xs flex gap-1 dark:hover:text-white p-4">
            <svg class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2 shrink-0 rotate-90" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.5" d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                <path d="M12 15L12 2M12 2L15 5.5M12 2L9 5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>

            تسجيل الخروج
        </a>
    </form>

    <div class="m-3 panel">

        <div class="py-3 text-gray-800">
            تسجيل حضور الطاقم الإداري .
            تاريخ السجل: {{ $latestUserRecorddaily->created_at->format('Y-m-d') }}
        </div>

        <div class="mt-2 border rounded p-1">
            <div>
                الوقت الآن
                . {{ date('H:i:s') }}
            </div>
            <div class="mt-2 text-red-700 text-xs">
                الوقت المطلوب فيه حضورك: {{ $latestUserRecorddaily->should_be_present_at }}
            </div>
        </div>

        @php

        $timenow = Carbon\Carbon::parse(date('H:i:s'));

        @endphp

        <form action="{{ route('user_record_daily.update',$latestUserRecorddaily->id) }}" method="post" class="mt-3">
            @csrf

            @if( ! $timenow->lte($latestUserRecorddaily->should_be_present_at) )

            بسبب التأخر في تسجيل الحضور، يجب أن يتم تسجيل حضورك عن طريق
            {{ $latestUserRecorddaily->gender == 'm' ? 'المشرف' : 'المشرفة'}}
            @else
            <input type="hidden" name="timenow" value="{{ $timenow }}">

            <div class="mt-4 flex justify-between">

                <button class="btn btn-outline-secondary" type="submit">تسجيل الحضور </button>

            </div>
            @endif
        </form>

    </div>

</body>

</html>