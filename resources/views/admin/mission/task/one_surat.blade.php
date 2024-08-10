<x-app-layout>

        <div>{{ $mission->title }}</div>
        <div class="text-xs text-gray-400">{{ $mission->note }}</div>


    <div x-data="adminMissionTaskOneSurat" x-init="
            lastMissionTask={{ $lastMissionTask == NULL ? '{id:0}' : $lastMissionTask  }};
            missionTasks = {{ $missionTasks }};
            missionSurats = {{ $surats }};
            deleteUrl = '{{ route('api.admin.mission.task.delete') }}';
            storeUrl = '{{ route('api.admin.mission.task.store') }}';
            mission_id = {{ $mission->id }}">

        <div x-cloak x-show="missionSurats.length > 0">

            @include('admin.mission.task._set_mission_type')

            <template x-if="descr != '' ">
                <div class="mt-2 p-1 h-10 w-full bg-white border flex justifiy-center items-center rounded text-xs font-bold text-red-800" x-text="descr"></div>
            </template>

            <!-- oneSurat -->
            <div class="mb-4 mt-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-6 gap-1">

                <template x-for="surat in missionSurats" :key="surat.id">

                    <div x-text="surat.title" @click="selectOneSuratId(surat.id)" class="p-1 border rounded bg-white hover:cursor-pointer">

                </template>

            </div>

            <!-- allow number of wrongs -->
            <div class="mt-2 flex gap-1 w-full justify-center items-center">
                <span>عدد الأخطاء</span>
                <div @click="incAllowWrong" class="p-1 w-10 text-center border rounded bg-white hover:cursor-pointer">+</div>
                <div x-text="allow_wrong"></div>
                <div @click="decAllowWrong" class="p-1 w-10 text-center border rounded bg-white hover:cursor-pointer">-</div>
            </div>

            @include('admin.mission.task._select_mission_task_order')

            <!-- save button -->
            <div x-cloak x-show=" !loading && showButton">
                <x-button-primary @click="save" class="my-2 w-full">حفظ</x-button-primary>
            </div>
            <div x-cloak x-show=" loading " class="flex justify-center">
                <div class="loader"></div>
            </div>

            <!-- mission tasks -->
            <div class="mt-2 p-1 rounded border" x-cloak x-show=" ! loading ">
                <div class="font-bold text-red-800"> خطة حفظ الطالب</div>
                <div class="font-bold text-red-800 text-[10px]">
                    <div>
                        ملحوظة: يظهر الترتيب هنا حسب الأرقام من الأكبر إلى الأصغر
                    </div>
                    <div>
                        حتى يسهل عليك معرفة آخر مهمة أضفتها إلى خطة الطالب.
                    </div>
                </div>
                @include('admin.mission.task._mission_tasks')

            </div>

        </div>

    </div>



</x-app-layout>