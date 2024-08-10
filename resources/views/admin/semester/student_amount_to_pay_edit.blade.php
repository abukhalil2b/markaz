<x-app-layout>

    <div class="p-3">

        <form action="{{ route('admin.student_amount_to_pay_update') }}" method="post">
            @csrf
            <input name="amount" class="mt-2 rounded w-full h-10" value="{{$studentAmountToPay->amount}}">
            <input type="hidden" name="id" value="{{ $studentAmountToPay->id }}">
            <x-button-primary class="mt-3 w-full">
                حفظ
            </x-button-primary>
        </form>

    </div>
</x-app-layout>