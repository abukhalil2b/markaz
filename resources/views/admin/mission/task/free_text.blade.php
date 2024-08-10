<x-app-layout>
    <div class="p-3">
        <div>{{ $mission->title }}</div>
        <div class="text-xs text-gray-400">{{ $mission->note }}</div>
    </div>

    <div x-data="adminMissionTaskFreeText" x-init="
        lastMissionTask={{ $lastMissionTask == NULL ? '{id:0}' : $lastMissionTask  }};
        missionTasks = {{ $missionTasks }};
        deleteUrl = '{{ route('api.admin.mission.task.delete') }}';
        storeUrl = '{{ route('api.admin.mission.task.store') }}';
        mission_id = {{ $mission->id }}">

        @include('admin.mission.task._set_mission_type')

        <div class="mt-2 flex justify-center gap-1">
            <div @click="selectType = 'duaa' " class="btn-option w-40" :class="{'btn-option-selected': selectType == 'duaa'}">
               مسار البساتين
            </div>
            <div @click="selectType = 'hesas' " class="btn-option w-40" :class="{'btn-option-selected': selectType == 'hesas'}">
               مسار الحصص
            </div>
        </div>

        <!-- oneSurat -->
        <input x-model="descr" class="mt-2 p-1 w-full roundex h-10 border focus:outline-none" placeholder="المهمة">

        @include('admin.mission.task._select_mission_task_order')

        <!-- save button -->
        <div x-cloak x-show=" ! loading">
            <x-button-primary @click="save" class="my-2 w-full">حفظ</x-button-primary>
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



</x-app-layout>