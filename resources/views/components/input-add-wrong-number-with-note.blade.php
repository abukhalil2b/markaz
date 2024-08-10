@props(['allowedWrongNumber'])
<div x-data="{
    maxAllowed:{{ $allowedWrongNumber }},

    wrongs:[],

    add(){
        if(this.maxAllowed > this.wrongs.length)
        {
            this.wrongs.push({id:this.wrongs.length+1,note:''});
        }
    },

    remove(id){
        this.wrongs = this.wrongs.filter(e => e.id != id)
    },
}">


    <div class="flex justify-center items-center gap-1">

        @if($allowedWrongNumber)
        <div x-on:click="add()" class="pb-1 inline-flex h-8 w-8 items-center justify-center rounded-full border bg-gray-50 font-bold hover:cursor-pointer hover:border-gray-400 hover:bg-gray-200">&plus;</div>
        <span class="text-red-700">
            عدد الأخطاء
        </span>
        <span class="mr-2 text-red-700 font-bold" x-text="wrongs.length"></span>

        <span class="text-red-400 text-xs">(العدد المسموح به <span x-text="maxAllowed"></span>)</span>

        @else
        <span class="text-red-400 text-xs">لا يسمح بأي خطأ</span>
        @endif
    </div>


    <template x-for="(wrong,i) in wrongs" :key="i">
        <div class="relative my-1">
            <input x-model="wrong.note" class="block w-full rounded-lg border border-gray-300 bg-gray-50 h-10 px-1 text-sm text-gray-900 focus:outline-orange-200 focus-visible:outline-brownLight" placeholder="التعليق" />
            <div x-on:click="remove(wrong.id)" class="absolute left-1 bottom-1 pb-1 flex h-8 w-8 items-center justify-center rounded-full border bg-gray-50 font-bold hover:cursor-pointer hover:border-gray-400 hover:bg-gray-200">&times;</div>
        </div>
    </template>

    <input type="hidden" name="wrongs" :value="JSON.stringify(wrongs)" class="w-full">

</div>