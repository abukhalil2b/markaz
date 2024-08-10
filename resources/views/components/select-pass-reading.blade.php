<div x-data="{passreading:''}">
    <div class=" text-red-700 text-center">الإجازة في القراءة</div>
    <div class="mt-1 flex justify-center items-center gap-1">
        <div @click=" passreading='' " class="btn-passreading" :class=" passreading=='' ? 'btn-passreading-selected' : '' ">حدد في الخطوة القادمة</div>
        <div @click=" passreading='mujaze' " class="btn-passreading" :class=" passreading=='mujaze' ? 'btn-passreading-selected' : '' ">مجاز</div>

    </div>
    <div class="mt-1 flex justify-center items-center">
        <div @click=" passreading='notmujaze' " class="btn-passreading" :class=" passreading=='notmujaze' ? 'btn-passreading-selected' : '' ">لم يتم اجازته وسيعيد القراءة</div>
    </div>

    <div x-show=" passreading == 'notmujaze' ">
        اذا لم يتم اجازته عليك أن تذكر السبب
        <textarea class="outline-0" name="note" rows="5" placeholder="السبب"></textarea>
    </div>
    <input type="hidden" name="passedReadingStatus" x-model="passreading">
</div>