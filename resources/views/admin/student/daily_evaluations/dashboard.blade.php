<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>لوحة التقويم اليومي</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="p-2 bg-gray-300" style="font-family: 'Helvetica Neue'">

    <div class="p-3 rounded text-center bg-white">
        <div>
            لوحة التقويم اليومي
        </div>
        <div>
            {{ $level->title }}
        </div>
        <div class="text-xs text-gray-500">التاريخ: {{ $todayDate }}</div>
    </div>

    <div class="mt-2 p-1 rounded text-right bg-white">
        أولاً: التلاوة
    </div>
    <div class="mt-2 flex justify-between gap-2">
        <div class="w-full p-1 rounded border border-[#7f5418] bg-[#f7ecd3] text-center text-[#7f5418]">
            <div class="text-xl text-red-700">مجاز</div>

            <div class="text-xs">
                @foreach($passReadings as $passReading)
                <div class="border-black border p-1 mt-1">
                    <div class="text-right">{{ $passReading->full_name }}</div>
                    <div class="text-right">{{ $passReading->descr }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="w-full p-1 rounded border border-[#7f5418] bg-[#f7ecd3] text-center text-[#7f5418]">
            <div class="text-xl text-red-700">لم يجز</div>

            <div class="text-xs">
                @foreach($notPassReadings as $notPassReading)
                <div class="border-black border p-1 mt-1">
                    <div class="text-right">{{ $notPassReading->full_name }}</div>
                    <div class="text-right">{{ $notPassReading->descr }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mt-2 p-1 rounded text-right bg-white">
        ثانياً: الحفظ
    </div>

    <div class="mt-2 text-center">
        <div class="p-1 rounded border border-[#7f5418] bg-[#f7ecd3] text-center text-[#7f5418]">
            <div class="text-xl text-red-700"> أنجز نصف المهمة </div>

            <div class="text-xs">
                @foreach($halfDones as $halfDone)
                <div class="border-black border p-1 mt-1">
                    <div class="text-right">{{ $halfDone->full_name }}</div>
                    <div class="text-right">{{ $halfDone->descr }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>


    <div class="mt-2 grid grid-cols-2 sm:grid-cols-6 gap-2">

        <div class="w-full p-1 rounded border border-[#7f5418] bg-[#f7ecd3] text-center text-[#7f5418]">
            <div class="text-xl text-red-700"> تفوق عالٍ </div>

            <div class="text-xs">
                @foreach($superExcellents as $superExcellent)
                <div class="border-black border p-1 mt-1">
                    <div class="text-right">{{ $superExcellent->full_name }}</div>
                    <div class="text-right">{{ $superExcellent->descr }}</div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="w-full p-1 rounded border border-[#7f5418] bg-[#f7ecd3] text-center text-[#7f5418]">
            <div class="text-xl text-red-700">ممتاز</div>

            <div class="text-xs">
                @foreach($excellents as $excellent)
                <div class="border-black border p-1 mt-1">
                    <div class="text-right">{{ $excellent->full_name }}</div>
                    <div class="text-right">{{ $excellent->descr }}</div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="w-full p-1 rounded border border-[#7f5418] bg-[#f7ecd3] text-center text-[#7f5418]">
            <div class="text-xl text-red-700"> جيد جدا</div>

            <div class="text-xs">
                @foreach($veryGoods as $veryGood)
                <div class="border-black border p-1 mt-1">
                    <div class="text-right">{{ $veryGood->full_name }}</div>
                    <div class="text-right">{{ $veryGood->descr }}</div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="w-full p-1 rounded border border-[#7f5418] bg-[#f7ecd3] text-center text-[#7f5418]">
            <div class="text-xl text-red-700">جيد</div>

            <div class="text-xs">
                @foreach($goods as $good)
                <div class="border-black border p-1 mt-1">
                    <div class="text-right">{{ $good->full_name }}</div>
                    <div class="text-right">{{ $good->descr }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mt-2 text-center">
        <div class="p-1 rounded border border-[#7f5418] bg-[#f7ecd3] text-center text-[#7f5418]">
            <div class="text-xl text-red-700">لم ينجح</div>
            <div class="text-xs">
                @foreach($notSucceeds as $notSucceed)
                <div class="border-black border p-1 mt-1">
                    <div class="text-right">{{ $notSucceed->full_name }}</div>
                    <div class="text-right">{{ $notSucceed->descr }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mt-2 text-center">
        <div class="p-1 rounded border border-[#7f5418] bg-[#f7ecd3] text-center text-[#7f5418]">
            <div class="text-xl text-red-700">لم ينجز</div>
            <div class="text-xs">
                @foreach($notDones as $notDone)
                <div class="border-black border p-1 mt-1">
                    <div class="text-right">{{ $notDone->full_name }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mt-2 text-center">
        <div class="p-1 rounded border border-[#7f5418] bg-[#f7ecd3] text-center text-[#7f5418]">
            <div class="text-xl text-red-700">التحضير للحصة</div>
            <div class="text-xs">
                @foreach($preparation_for_hesas as $preparation_for_hesa)
                <a href="{{ route('admin.student.daily_evaluations.hesas_show',$preparation_for_hesa->id) }}">
                    <div class="border-black border p-1 mt-1">
                        <div class="text-right">{{ $preparation_for_hesa->full_name }}</div>
                        <div class="text-right">{{ $preparation_for_hesa->descr }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <script src="/assets/js/alpine-persist.min.js"></script>
</body>

</html>