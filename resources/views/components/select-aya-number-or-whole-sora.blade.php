@props(['whole' => $nextSora->whole])

<div x-data="{whole: '{{ $whole?$whole:0 }}' }">

    <div class="flex justify-center items-center gap-1">

        <div @click="whole=1" :class=" whole == 1 ? 'btn-gotonext-selected' : '' " class="btn-add-gotonext">
            السورة كاملة
        </div>

        <div @click="whole=0" :class=" whole == 0 ? 'btn-gotonext-selected' : '' " class="btn-add-gotonext">
            حسب تحديد الآيات
        </div>
    </div>

    <div x-show="whole == 0" class="flex gap-10 justify-center items-center mt-1">
        <label class="text-red-700">
            من الآية
            <input type="number" name="ayafrom" class="w-16 h-10 text-center border font-bold rounded focus-visible:outline-orange">
        </label>

        <span class="text-red-700">
            إلى الأية
            <input type="number" name="ayato" class="w-16 h-10 rounded border focus-visible:outline-orange">
        </span>
    </div>
    <input name="whole" type="hidden" x-model="whole">
</div>