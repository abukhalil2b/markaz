<template x-for="(missionTask, index) in missionTasks" :key="missionTask.id">
    <div class="mt-1 p-1 border rounded text-right flex flex-col justify-between text-xs " :class="missionTask.mission_type == 'new' ? 'bg-orangeLight' : 'bg-brownLight' ">

        <div>
            <span class="w-5 h-5 rounded-full inline-flex justify-center text-xs items-center bg-red-900 text-white" x-text="missionTask.task_order"></span>
            <span x-text="missionTask.mission_type == 'new' ? 'حفظ جديد' : 'مراجعة' "></span>
            <span x-text="missionTask.descr"></span>
        </div>

        <div class="mt-3 text-blue-700">
            <span class="text-[10px]">
                عدد الأخطاء المسموح بها
            </span>
            <span x-text="missionTask.allow_wrong"></span>
        </div>

        <div class="mt-3 w-20 flex justify-center" x-data="{ showDeleteBtn:false }">
            <div x-cloak x-show=" ! showDeleteBtn" @click="showDeleteBtn = true" class="mt-1 text-red-700 hover:cursor-pointer">حذف</div>
            <div x-on:click="Delete(missionTask.id)" x-cloak x-show="showDeleteBtn" class="w-20 mt-1 flex justify-center bg-red-700 text-red-100 rounded hover:cursor-pointer">تأكيد الحذف</div>
        </div>
    </div>
</template>