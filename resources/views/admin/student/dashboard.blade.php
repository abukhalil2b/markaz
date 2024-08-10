<x-app-layout>

    <div x-data="{ showStudentButtons:false }" class="">
        <a href="#" @click=" showStudentButtons = true" x-show=" ! showStudentButtons " class="w-full p-3 flex gap-1 justify-center">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.5"></circle>
                <path d="M3.66122 10.6392C4.13377 10.9361 4.43782 11.4419 4.43782 11.9999C4.43781 12.558 4.13376 13.0638 3.66122 13.3607C3.33966 13.5627 3.13248 13.7242 2.98508 13.9163C2.66217 14.3372 2.51966 14.869 2.5889 15.3949C2.64082 15.7893 2.87379 16.1928 3.33973 16.9999C3.80568 17.8069 4.03865 18.2104 4.35426 18.4526C4.77508 18.7755 5.30694 18.918 5.83284 18.8488C6.07287 18.8172 6.31628 18.7185 6.65196 18.5411C7.14544 18.2803 7.73558 18.2699 8.21895 18.549C8.70227 18.8281 8.98827 19.3443 9.00912 19.902C9.02332 20.2815 9.05958 20.5417 9.15224 20.7654C9.35523 21.2554 9.74458 21.6448 10.2346 21.8478C10.6022 22 11.0681 22 12 22C12.9319 22 13.3978 22 13.7654 21.8478C14.2554 21.6448 14.6448 21.2554 14.8478 20.7654C14.9404 20.5417 14.9767 20.2815 14.9909 19.9021C15.0117 19.3443 15.2977 18.8281 15.7811 18.549C16.2644 18.27 16.8545 18.2804 17.3479 18.5412C17.6837 18.7186 17.9271 18.8173 18.1671 18.8489C18.693 18.9182 19.2249 18.7756 19.6457 18.4527C19.9613 18.2106 20.1943 17.807 20.6603 17C20.8677 16.6407 21.029 16.3614 21.1486 16.1272M20.3387 13.3608C19.8662 13.0639 19.5622 12.5581 19.5621 12.0001C19.5621 11.442 19.8662 10.9361 20.3387 10.6392C20.6603 10.4372 20.8674 10.2757 21.0148 10.0836C21.3377 9.66278 21.4802 9.13092 21.411 8.60502C21.3591 8.2106 21.1261 7.80708 20.6601 7.00005C20.1942 6.19301 19.9612 5.7895 19.6456 5.54732C19.2248 5.22441 18.6929 5.0819 18.167 5.15113C17.927 5.18274 17.6836 5.2814 17.3479 5.45883C16.8544 5.71964 16.2643 5.73004 15.781 5.45096C15.2977 5.1719 15.0117 4.6557 14.9909 4.09803C14.9767 3.71852 14.9404 3.45835 14.8478 3.23463C14.6448 2.74458 14.2554 2.35523 13.7654 2.15224C13.3978 2 12.9319 2 12 2C11.0681 2 10.6022 2 10.2346 2.15224C9.74458 2.35523 9.35523 2.74458 9.15224 3.23463C9.05958 3.45833 9.02332 3.71848 9.00912 4.09794C8.98826 4.65566 8.70225 5.17191 8.21891 5.45096C7.73557 5.73002 7.14548 5.71959 6.65205 5.4588C6.31633 5.28136 6.0729 5.18269 5.83285 5.15108C5.30695 5.08185 4.77509 5.22436 4.35427 5.54727C4.03866 5.78945 3.80569 6.19297 3.33974 7C3.13231 7.35929 2.97105 7.63859 2.85138 7.87273" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
            </svg>
            خيارات
        </a>

        <div x-cloak x-show=" showStudentButtons " class="flex flex-wrap items-center gap-2 justify-between py-2">

            @if($student->under_observation)
            <a class="btn btn-sm text-[10px] btn-outline-warning w-40" href="{{ route('admin.student.remove_under_observation',$student->id) }}">حذفه من تحت الملاحظة</a>
            @else
            <a class="btn btn-sm text-[10px] btn-outline-warning w-40" href="{{ route('admin.student.set_under_observation',$student->id) }}">جعله تحت الملاحظة</a>
            @endif

            <a class="btn btn-sm text-[10px] btn-outline-warning w-40" href="{{route('admin.student.note.create', $student->id)}}">
                كتابة ملحوظة
            </a>

            <a class="btn btn-sm text-[10px] btn-outline-warning w-40" href="{{route('admin.student.mark.create', $student->id )}}">
                النقاط
            </a>

            <a class="btn btn-sm text-[10px] btn-outline-warning w-40" href="{{ route('admin.student.mark.index', $student->id ) }}">
                جميع نقاط الطالب
            </a>

            <a target="_blank" class="btn btn-sm text-[10px] btn-outline-warning w-40" href="{{ route('admin.student.daily_evaluations.dashboard') }}">
                لوحة التقويم اليومي
            </a>

            <a class="btn btn-sm text-[10px] btn-outline-warning w-40" href="{{route('admin.student.warning.index', $student->id)}}">
                الفصل من الدار
            </a>

            <a class="btn btn-sm text-[10px] btn-outline-warning w-40" href="{{route('admin.student.studyday.index', $student->id)}}">
                أيام الدراسة
            </a>

            <a class="btn btn-sm text-[10px] btn-outline-warning w-40" href="{{ route('days_of_student_absent',$student->id) }}">
                الأيام التي غاب فيها الطالب
            </a>

            <a class="btn btn-sm text-[10px] btn-outline-warning w-40" href="{{ route('admin.student.edit',$student->id) }}">
                تعديل
            </a>

            <a class="btn btn-sm text-[9px] btn-outline-warning w-40 text-xs" href="{{ route('warn.edit',$student->id) }}">
                التحذير من التأخر والغياب
            </a>

            @if(auth()->user()->permission('student-transfer'))
            <a class="btn btn-sm text-[10px] btn-outline-warning w-40" href="{{ route('admin.student.trans.create',$student->id) }}">
                نقل الطالب
            </a>
            @endif

        </div>

        <!-- student info -->
        <x-student-info-card :student="$student" />
        <div> رمز الدخول: {{ $student->password }}</div>
        <!-- memorize quran -->
        @include('admin.student._memorize_quran')

        <!--  (وَقُلْ رَبِّ زِدْنِي عِلْمًا) -->
        <div class="mt-4 p-1 flex justify-between bg-primary text-white text-xl rounded-t">
            <div class="text-white">
                (وَقُلْ رَبِّ زِدْنِي عِلْمًا)
            </div>

            <div>
                <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                    <button type="button" @click="toggle">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-90 opacity-70">
                            <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                            <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                            <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                        </svg>
                    </button>
                    <ul x-cloak="" x-show="open" x-transition="" x-transition.duration.300ms="" class="whitespace-nowrap ltr:right-0 rtl:left-0 text-xs">
                        <li>
                            <a href="{{route('admin.student.duaacate.dashboard',$student->id)}}" class="w-full dropdown-item">
                                + جديد
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.duaacate_student.history',$student->id) }}">
                                جميع المهام
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="p-1 border rounded-b shadow-md">

            @foreach($duaacateStudents as $duaacateStudent)
            <a href="{{route('admin.duaacate_student_task.dashboard',$duaacateStudent->id)}}" class="mt-4 p-3 block border rounded  {{ $duaacateStudent->done_at == null ? ' bg-gray-100 text-gray-500' : 'border-green-600 bg-green-100 text-green-600' }}">
                {{ $duaacateStudent->title }}
            </a>
            @endforeach
        </div>

        <!--  مسار إنجاز الحصص -->
        <div class="mt-4 p-1 flex justify-between bg-primary text-white text-xl rounded-t">
            <div class="text-white">
                مسار إنجاز الحصص
            </div>

            <div>
                <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                    <button type="button" @click="toggle">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-90 opacity-70">
                            <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                            <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                            <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                        </svg>
                    </button>
                    <ul x-cloak="" x-show="open" x-transition="" x-transition.duration.300ms="" class="whitespace-nowrap ltr:right-0 rtl:left-0 text-xs">
                        <li>
                            <a href="{{ route('admin.student.mission_hesas.index',$student->id) }}" class="w-full dropdown-item">
                                + جديد
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.student.mission_hesas.index_test',$student->id) }}" class="w-full dropdown-item">
                                جديد
                                (عرض تجريبي)
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.student.mission_hesas.history',$student->id) }}">
                                جميع المهام
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="p-1 border rounded-b shadow-md">
            @foreach($hesasReviewMissions as $reviewMission)

            <div class="p-3 border rounded bg-white text-center  {{$reviewMission->done?'mission-btn-done':''}}">

                <div class="text-blue-600 text-xl font-bold"> {{ $reviewMission->mission_title }} </div>

                <p>{{ $reviewMission->mission_description }}</p>

                <div>
                    بدأت: {{date('Y-m-d',$reviewMission->start_at)}}
                </div>

                @if($reviewMission->done_at!=null)
                <p>تمت: {{ date('Y-m-d',$reviewMission->done_at) }}</p>
                @endif

                <!-- btns -->
                <div class="mt-4 flex justify-between">
                    @if($reviewMission->done_at==null)
                    <a class="btn btn-outline-secondary" href="{{route('student.hesas_review_create',['studentHasMission'=>$reviewMission->id])}}">
                        إنجاز المهمة
                    </a>
                    @endif

                    @if(auth()->user()->permission('manage-mission'))
                    @include('admin.student._modal_delete_student_hesas')
                    @endif
                </div>

                <!-- daily_evaluations -->
                @php
                $daily_evaluation = App\Models\DailyEvaluation::where(['student_id'=>$student->id,'model_type'=>'student_has_mission','model_id'=>$reviewMission->id])->first();
                $showButton = 1;
                if($daily_evaluation)
                {
                $showButton = 0;
                }
                @endphp
                <div class="mt-4 flex justify-between gap-1">

                    @if($showButton)
                    <a href="{{ route('admin.student.daily_evaluations.add_student',['student_id'=>$student->id,'studentHasMission'=>$reviewMission->id]) }}" class="btn btn-sm btn-outline-secondary">
                        إضافة الطالب في لوحة التقويم اليومي في خانة التحضير للحصة
                    </a>
                    @endif

              

                </div>
                <!-- / daily_evaluations -->

            </div>

            @endforeach
        </div>

    </div>

    <div class="py-5"></div>
    <a href="{{ route('admin.student.show',$student->id) }}" class="btn btn-outline-info">show</a>

    </div>
</x-app-layout>