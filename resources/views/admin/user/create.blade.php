<x-app-layout>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            مستخدم جديد
        </h2>

    <form method="POST" action="{{ route('admin.user.store') }}" class="mt-5">
        @csrf
        <div class="px-3" x-data="createNewUser($watch,'{{ $workperiods }}','{{ $levels }}')">

            <div class="grid grid-cols-4 gap-3">

                <div class="btn-option h-12" :class="userType == 'male_moderator'? 'btn-option-selected' : '' " @click="selectUserType('male_moderator')" value="male_moderator">مشرف</div>
                <div class="btn-option" :class="userType == 'female_moderator'? 'btn-option-selected' : '' " @click="selectUserType('female_moderator')" value="female_moderator">مشرفة</div>
                <div class="btn-option" :class="userType == 'male_teacher'? 'btn-option-selected' : '' " @click="selectUserType('male_teacher')" value="male_teacher">مدرس</div>
                <div class="btn-option" :class="userType == 'female_teacher'? 'btn-option-selected' : '' " @click="selectUserType('female_teacher')" value="female_teacher">مدرسة</div>

            </div>

            <!-- step 1 -->
            <div x-cloak x-show="userType != '' " class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                <template x-for="wp in workperiods">
                    <div class="btn-option h-12" @click="selectWorkperiodIds(wp.id)" :class="workperiodIds.includes(wp.id)? 'btn-option-selected' : '' ">
                        <span class="text-xs" x-text="wp.title"></span>
                        <span class="mx-1 text-red-700" x-text="wp.gender == 'm' ? ' ذكور ' : ' إناث ' "></span>
                    </div>
                </template>
            </div>


            <!-- step 2 -->
            <div x-cloak x-show="workperiodIds.length > 0 ">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mt-3">
                    <label class="text-red-800 text-xs">
                            <span> المستخدم </span>
                        <x-input x-model="user.email" name="email" />
                    </label>

                    <label class="text-red-800 text-xs">
                        الرقم المدني 
                        <x-input x-model="user.national_id" name="national_id" />
                    </label>


                    <label class="text-red-800 text-xs">
                        الاسم الاول
                        <x-input x-model="user.first_name" name="first_name" />
                    </label>


                    <label class="text-red-800 text-xs">
                        الاسم الثاني
                        <x-input x-model="user.second_name" name="second_name" />
                    </label>

                    <label class="text-red-800 text-xs">
                        الاسم الثالث
                        <x-input x-model="user.third_name" name="third_name" />
                    </label>

                    <label class="text-red-800 text-xs">
                        القبيلة
                        <x-input x-model="user.last_name" name="last_name" />
                    </label>

                    <label class="text-red-800 text-xs">
                        الجوال
                        <x-input x-model="user.phone" name="phone" />
                    </label>

                    <div>
                        <span class="text-red-800 text-xs"> كلمة المرور بشكل افتراضي</span>
                        <span class="font-bold w-full">abcd1234</span>
                    </div>
                </div>
                <!-- end user info -->

                <!-- loading state and store button -->
                <div class="mt-5">

                    <template x-if=" showStoreButton ">
                        <x-button-primary type="submit" class="w-full">
                            حفظ
                        </x-button-primary>
                    </template>

                </div>
            </div>

            <input type="hidden" x-model="JSON.stringify(workperiodIds)" name="workperiodIds">
            <input type="hidden" x-model="userType" name="user_type">
            <input type="hidden" x-model="gender" name="gender">

        </div>
    </form>
</x-app-layout>