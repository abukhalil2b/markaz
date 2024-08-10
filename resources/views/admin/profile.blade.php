<x-app-layout>

    <div class="py-3 text-md">
        الملف الشخصي
    </div>

    <div class="text-xl">
        {{ $user->full_name }}
    </div>

    <div class="py-3 text-md">
        الاوسمة:
    </div>

    <div class="w-full  flex justify-center items-center panel">
        <div class="flex gap-3 items-center">
            <img class="h-44 w-44" src="/assets/images/medal.png" alt="medal">
            <div class="text-warning">
                <li>وسام العطاء</li>
                <li>وسام الحضور المتميز</li>
                <li>وسام الحضور الإتقان</li>
                <li>وسام الحضور الابداع</li>
            </div>
        </div>
    </div>



    <div class="mt-5 panel text-red-400 text-2xl">
        <span>مازال تحت التطوير</span>
    </div>



</x-app-layout>