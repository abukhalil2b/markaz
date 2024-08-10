<x-app-layout>

    <div class="p-3">
              <div>{{ $mission->title }}</div>
        <div class="text-xs text-gray-400">{{ $mission->note }}</div>
    </div>

    <div x-data="adminMissionTaskAyaToAya" x-init="
    lastMissionTask={{ $lastMissionTask == NULL ? '{id:0}' : $lastMissionTask  }};
    missionTasks = {{ $missionTasks }};
     quranAyas = {{ $quran_ayas }};
     missionSurats = {{ $surats }};
     deleteUrl = '{{ route('api.admin.mission.task.delete') }}';
     storeUrl = '{{ route('api.admin.mission.task.store') }}';
     mission_id = {{ $mission->id }}">

        <div x-cloak x-show="missionSurats.length > 0">

            @include('admin.mission.task._set_mission_type')

            <template x-if="descr != '' ">

                <div class="mt-2 flex gap-1">
                    <div class="p-1 h-10 w-full rounded border bg-white flex justifiy-center items-center  text-xs font-bold text-red-800" x-text="descr"></div>
                    <div class="p-1 h-10 w-auto rounded border bg-white hover:cursor-pointer" @click="reset">إلغاء</div>
                </div>

            </template>

            <!-- fromSurat -->
            <template x-if="step == 'select-from-surats' ">

                <div class="mb-4 mt-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-6 gap-1">

                    <template x-for="surat in missionSurats" :key="surat.id">

                        <div x-text="surat.title" @click="selectFromSuratId(surat.id)" class="p-1 border rounded bg-white hover:cursor-pointer">

                    </template>

                </div>

            </template>

            <template x-if="step == 'select-from-ayas' ">
                <!-- from ayas -->
                <div class="mb-4 mt-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-6 gap-1">

                    <template x-for="aya in fromAyas" :key="aya.id">

                        <div x-text="aya.number" @click="selectFromAyaId(aya.id)" class="p-1 w-10 text-center border rounded bg-white hover:cursor-pointer">

                    </template>

                </div>
            </template>

            <!-- toSurat -->
            <template x-if="step == 'select-to-surats' ">

                <div class="mb-4 mt-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-6 gap-1">

                    <template x-for="surat in toSurats" :key="surat.id">

                        <div x-text="surat.title" @click="selectToSuratId(surat.id)" class="p-1 border rounded bg-white hover:cursor-pointer">

                    </template>

                </div>

            </template>

            <template x-if="step == 'select-to-ayas' ">

                <!-- to ayas -->
                <div class="mb-4 mt-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-6 gap-1">

                    <template x-for="aya in toAyas" :key="aya.id">

                        <div x-text="aya.number" @click="selectToAyaId(aya.id)" class="p-1 w-10 text-center border rounded bg-white hover:cursor-pointer">

                    </template>

                </div>
            </template>

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