
<div x-data="{sowarDone: {{ $sowarDone }} }" class="flex justify-center items-center gap-1">
    <div @click="sowarDone=0" :class=" sowarDone == 0 ? 'btn-gotonext-selected' : '' " class="btn-add-gotonext">
        يبقى في نفس السورة
    </div>
    <div @click="sowarDone=1" :class=" sowarDone == 1 ? 'btn-gotonext-selected' : '' " class="btn-add-gotonext">
        ينتقل الى السورة التالية
    </div>
    <input name="sowar_done" type="hidden" x-model="sowarDone">
</div>