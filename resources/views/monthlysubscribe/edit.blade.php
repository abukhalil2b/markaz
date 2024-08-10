<x-app-layout>

    <div x-data="{
    paid: {{ $monthlysubscribeStudent->paid }},
    togglePaid(){
        if(this.paid == 0){
            this.paid = 1;
        }else{
            this.paid = 0;
        }
    }
}">


        <form action="{{route('monthlysubscribe.update',['monthlysubscribeStudent'=>$monthlysubscribeStudent->id])}}" method="post">
            @csrf

            <x-input type="number" name="amount" value="{{$monthlysubscribeStudent->amount}}" />


            <div @click="togglePaid" class="h-10 btn-option" :class="paid == 1 ? 'btn-option-selected' : '' ">
                <div x-text=" paid == 1 ? 'دفع' : 'لم يدفع' "></div>
            </div>


            <x-input class="mt-3" type="date" name="paid_date" value="{{$monthlysubscribeStudent->paid_date}}" />

            <div class="mt-5 flex justify-between">
                <x-button>حفظ التعديل</x-button>

                <x-button-link class="h-10" href="{{route('monthlysubscribe.delete',['monthlysubscribeStudent'=>$monthlysubscribeStudent->id])}}">
                    حذف من القائمة
                </x-button-link>
            </div>
            <input type="hidden" x-model="paid" name="paid">
        </form>

    </div>

</x-app-layout>