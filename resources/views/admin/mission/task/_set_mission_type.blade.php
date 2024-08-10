<div class="flex justify-center gap-1">
    <div @click="missionType = 'new' " class="btn-option w-40" :class="{'btn-option-selected': missionType == 'new'}">
        حفظ جديد
    </div>
    <div @click="missionType = 'review' " class="btn-option w-40" :class="{'btn-option-selected': missionType == 'review'}">
        مراجعة
    </div>
</div>