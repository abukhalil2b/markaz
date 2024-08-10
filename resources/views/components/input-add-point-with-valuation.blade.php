<div>

    <!-- add evaluation -->
    <input type="hidden" name="evaluation" x-model="evaluation">
    <div class="font-bold text-center text-red-700 mt-3">التقييم</div>
    <div class="flex gap-1 justify-center items-center mt-2">
        <div :class=" evaluation == 'تفوق عالٍ'? 'btn-evaluation-selected' : '' " class="btn-add-evaluation" x-on:click="addEvaluation('تفوق عالٍ')">تفوق عالٍ</div>
        <div :class=" evaluation == 'ممتاز'? 'btn-evaluation-selected' : '' " class="btn-add-evaluation" x-on:click="addEvaluation('ممتاز')">ممتاز</div>
        <div :class=" evaluation == 'جيد جدا'? 'btn-evaluation-selected' : '' " class="btn-add-evaluation" x-on:click="addEvaluation('جيد جدا')">جيد جدا</div>
        <div :class=" evaluation == 'جيد'? 'btn-evaluation-selected' : '' " class="btn-add-evaluation" x-on:click="addEvaluation('جيد')">جيد</div>
        <div :class=" evaluation == 'لم ينجح'? 'btn-evaluation-selected' : '' " class="btn-add-evaluation" x-on:click="addEvaluation('لم ينجح')">لم ينجح</div>
    </div>
    <!-- add point -->
    <div x-cloak x-show="showAddPoint" class="mt-3">
        <input type="hidden" name="point" x-model="total">
        <div class="flex gap-3 justify-center items-center">
            <div class="font-bold text-red-700">النقاط</div>
            <div x-text="total" class="text-xl font-bold"></div>
        </div>
        <div class="flex gap-2 justify-center items-center mt-2">
            <div class="btn-add-point" x-on:click="total=total+1">+1</div>
            <div class="btn-add-point" x-on:click="total=total+3">+3</div>
            <div class="btn-add-point" x-on:click="total=total+5">+5</div>
            <div class="btn-add-point" x-on:click="total=total+10">+10</div>
            <div class="btn-add-point" x-on:click="total=0">0</div>
        </div>
    </div>


</div>