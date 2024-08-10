<x-student.layout>

    <div class="text-xl">
        المستحقات للفصل الدراسي
        <span class="text-blue-800 text-xs"> {{ $lastSemester->title  }}</span>
    </div>

    

    <div class="text-blue-800"> المبلغ المطلوب:
        @if( $semesterStudentAmountToPay )

        {{ $semesterStudentAmountToPay->amount  }}

        @else

        <span class="text-red-700">لم يتم تسجيله</span>

        @endif
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <td>التاريخ</td>
                <td>المبلغ</td>
                <td>ملحوظة</td>
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptionfees as $subscriptionfee)

            <tr>
                <td>
                    {{ $subscriptionfee->created_at->format('Y-m-d') }}
                </td>
                <td>
                    <div class="text-blue-800" style="font-family:'Times New Roman';font-weight:bolder;"> {{ $subscriptionfee->amount }}</div>
                </td>
                <td>
                    <div class="text-xs"> {{ $subscriptionfee->note }}</div>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3">
                    <div class="m-1 p-2 bg-white border rounded text-xl">
                        مجموع المبلغ المستلم من الطالب: {{ $total->total }}
                    </div>
                </td>
            </tr>
        </tbody>
    </table>


</x-student.layout>