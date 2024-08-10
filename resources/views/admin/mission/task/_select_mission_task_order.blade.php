<template x-if="lastMissionTask.id != 0 ">
    <div class="mt-4 ">
        سيكون ترتيب المهمة من بعد

        <div class="mt-1 p-1 border rounded">
            <span class="w-5 h-5 rounded-full inline-flex justify-center text-xs items-center bg-red-900 text-white" x-text="lastMissionTask.task_order"></span>
            <span x-text="lastMissionTask.mission_type == 'new' ? 'حفظ جديد' : 'مراجعة' "></span>
            <span x-text="lastMissionTask.descr"></span>
        </div>
        <!-- change order -->
        <div class="cursor-pointer hover:text-red-600 w-32" @click="showOrderOptions = true">
            تغير الترتيب
        </div>

    </div>
</template>

<!-- select order -->
<div x-cloak x-show="showOrderOptions">
    <template x-for="missionTask in missionTasks">
        <div @click="selectLastMissionTask(missionTask.id)" class="mt-1 p-1 border rounded cursor-pointer hover:bg-white">
            من بعد
            <span class="w-5 h-5 rounded-full inline-flex justify-center text-xs items-center bg-red-900 text-white" x-text="missionTask.task_order"></span>
            <span x-text="missionTask.mission_type == 'new' ? 'حفظ جديد' : 'مراجعة' "></span>
            <span x-text="missionTask.descr"></span>
        </div>
    </template>
</div>