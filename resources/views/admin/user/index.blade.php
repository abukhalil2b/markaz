<x-app-layout>

    قائمة {{ $usergroup == '' ? 'المستخدمين': $usergroup }}

    <div class="p-1">

        @foreach($users as $user)

        <div class="{{ $user->active ? 'bg-white' : 'bg-gray-100' }} mt-2 p-1 flex justify-between border rounded">
            <div>
                <div class="text-red-800 text-xl">{{ $user->full_name }}</div>
                <div class="text-xs py-3 flex gap-3">
                    <span class="text-blue-600"> المستخدم: </span>
                    <div>{{ $user->email }}</div>
                    <span class="text-blue-600"> كلمة المرور: </span>
                    <div>{{ $user->plain_password }}</div>
                </div>

                <div class="text-xs">
                    <span class="text-blue-600">القاعة: </span>
                    @if($user->level)
                    {{$user->level->title}}
                    @endif
                </div>
                <div class="text-xs">
                    @if($user->workperiod)
                    <span class="text-blue-600">مسجل الدخول إلى: </span>
                    {{$user->workperiod->title}}
                    @endif
                </div>
            </div>

            <div>

                <!-- menu -->
                <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                    <button type="button" class="flex items-center hover:text-primary" @click="toggle">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-90 opacity-70">
                            <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                            <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                            <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                        </svg>
                    </button>
                    <ul x-show="open" x-transition="" x-transition.duration.300ms="" class="ltr:right-0 rtl:left-0 w-52 text-xs">
                        @if(auth()->user()->permission('edit-admin-user'))
                        <li class="">
                            <a class="dropdown-item" href="{{route('admin.teacher.shiftlevel.create',['teacher_id'=>$user->id])}}">
                                نقل إلى قاعة آخرى
                            </a>
                        </li>

                        <li class="border-t border-white-light dark:border-white-light/10">
                            <a class="dropdown-item" href="{{route('admin.user.edit',['user'=>$user->id])}}">
                                تعديل
                            </a>
                        </li>

                        <li class="border-t border-white-light dark:border-white-light/10">
                            <a class="dropdown-item" href="{{route('admin.user.edit_password',['user'=>$user->id])}}">
                                تعديل الرقم السري
                            </a>
                        </li>

                        @endif

                        @if(auth()->user()->permission('enter-another-account'))
                        <li class="border-t border-white-light dark:border-white-light/10">
                            <a class="dropdown-item" href="{{route('enable_impersonate',['user'=>$user->id])}}">
                                الدخول إلى حساب {{$user->first_name}}
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->permission('admin.user.show'))
                        <li class="border-t border-white-light dark:border-white-light/10">
                            <a class="dropdown-item" href="{{route('admin.user.show',$user->id)}}">
                                عرض بيانات المستخدم
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
                <!-- /menu -->
            </div>
        </div>

        @endforeach

    </div>

</x-app-layout>