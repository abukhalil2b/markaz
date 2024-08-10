<x-app-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            قائمة الأدوار - {{$role->name}}
        </h2>

    <form action="{{route('role.permission.store')}}" method="post">
        @csrf

        <div class="mt-2 rounded border border-brownDark p-1 w-full"> طلب إجازة </div>
        @foreach($requestleavePermissions as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        <div class="rounded border border-brownDark p-1 w-full">المستخدمين </div>
        @foreach($userPermissions as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        <div class="rounded border border-brownDark p-1 w-full">المدرسين </div>
        @foreach($teacherPermissions as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        <div class="rounded border border-brownDark p-1 w-full">الطلاب</div>
        @foreach($studentPermissions as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        <div class="rounded border border-brownDark p-1 w-full">التقارير</div>
        @foreach($reportPermissions as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        <div class="rounded border border-brownDark p-1 w-full">السجلات </div>
        @foreach($recordPermissions as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        <div class="rounded border border-brownDark p-1 w-full">المشرفين</div>
        @foreach($moderatorPermissions as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        <div class="rounded border border-brownDark p-1 w-full">المهمات</div>
        @foreach($missionPermissions as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        <div class="rounded border border-brownDark p-1 w-full">المستويات</div>
        @foreach($levelPermissions as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        <div class="rounded border border-brownDark p-1 w-full">الحافلة</div>
        @foreach($busPermissions as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        <div class="rounded border border-brownDark p-1 w-full">الأسئلة</div>
        @foreach($questionPermissions as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        <div class="rounded border border-brownDark p-1 w-full">التطبيق</div>
        @foreach($appPermissions as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        <div class="rounded border border-brownDark p-1 w-full">لوحة الشرف</div>
        @foreach($selectedstudentPermissions as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        <div class="rounded border border-brownDark p-1 w-full">الاشتراك الشهري</div>
        @foreach($monthlysubscribes as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        <div class="rounded border border-brownDark p-1 w-full">المقترحات</div>
        @foreach($suggestions as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        <div class="rounded border border-brownDark p-1 w-full">فترة العمل</div>
        @foreach($workperiodPermissions as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        <div class="rounded border border-brownDark p-1 w-full">المواد الدراسية</div>
        @foreach($coursePermissions as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        <div class="rounded border border-brownDark p-1 w-full"> مستحقات الدراسة </div>
        @foreach($subscriptionfeePermissions as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        <div class="rounded border border-brownDark p-1 w-full">   الفصول الدراسية </div>
        @foreach($semesterPermissions as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        <div class="rounded border border-brownDark p-1 w-full"> التقييمات اليومية </div>
        @foreach($dailyEvaluationPermissions as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        <div class="rounded border border-brownDark p-1 w-full">صفحة البداية</div>
        @foreach($frontpagePermissions as $permission)
        <x-permission-card :permission="$permission" :role="$role" />
        @endforeach

        
        <input type="hidden" name="role_id" value="{{$role->id}}">
        <button class="btn btn-outline-primary w-full " type="submit">حفظ</button>
    </form>

</x-app-layout>