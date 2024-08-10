<x-app-layout>

    <link rel="stylesheet" href="/assets/DataTables/datatables.css" />

    <div class="p-3">
        {{ $semester->title }}
    </div>
    <style>
        .dataTables_wrapper {
            overflow: scroll;
        }

        select[name="myTable_length"] {
            width: 60px;
        }
    </style>

    <div class="py-5 flex items-center justify-center">

        <a class="btn btn-outline-primary" href="{{ route('admin.semester.index') }}">
            <x-svgicon.back_arrow />
            <span class="mx-1"> الفصل الدراسي </span>
        </a>

    </div>
    <table id="myTable" style="font-size: 12px;width:100%;">
        <thead>
            <tr>
                <th>
                    رقم الطالب
                </th>
                <th>
                    الاسم
                </th>
                <th>
                    المبلغ
                </th>
                <th>
                    تسجل المبلغ
                </th>
            </tr>
        </thead>
        <tbody>

            @php
            $adminSubscriptionfeeIndex = auth()->user()->permission('admin.subscriptionfee.index');
            @endphp

            @foreach($studentAmountToPays as $studentAmountToPay)
            <tr>
                <td>
                    <span class="student-number">{{$studentAmountToPay->student_id}}</span>
                </td>

                <td>
                    {{$studentAmountToPay->full_name}}
                </td>
                <td>
                    <div class="mt-1 flex gap-2 {{ $studentAmountToPay->paid == 'yes' ? 'bg-green-200' : '' }} ">
                        <div class="p-1">
                            المبلغ المستحق {{ $studentAmountToPay->mount_required }}
                            <a href="{{ route('admin.student_amount_to_pay_edit',$studentAmountToPay->id) }}" class="text-red-600">تعديل</a>
                        </div>
                        <div class="p-1"> مجموع المبلغ المدفوع {{ $studentAmountToPay->total_paid }}</div>
                    </div>
                    @if($studentAmountToPay->isforgiven == 1 )
                    <div class="bg-blue-200 p-1"> معفي </div>
                    @endif
                </td>
                <td>
                    @if($adminSubscriptionfeeIndex)

                    <a href="{{ route('admin.subscriptionfee.index',['student'=>$studentAmountToPay->student_id,'semester'=>$semester->id] ) }}" class="mr-1 w-52">
                        تسجيل المبلغ المقبوض من الطالب
                    </a>
                    @endif
                </td>

            </tr>
            @endforeach

        </tbody>
    </table>

    <script src="/assets/DataTables/jQuery-3.6.0/jquery-3.6.0.min.js"></script>
    <script src="/assets/DataTables/datatables.min.js"></script>

    <script>
        /* --  language --*/
        var language = {
            infoEmpty: "",
            infoFiltered: "",
            info: "",
            lengthMenu: "أظهر _MENU_ مدخلات",
            zeroRecords: "لايوجد نتائج تتطابق بحثك",
            search: "",
            sSearchPlaceholder: "تصفية",
            paginate: {
                first: "الأول",
                previous: "السابق",
                next: "التالي",
                last: "الأخير"
            },
        };

        /* --  student DataTable --*/
        $(document).ready(function() {
            $("#myTable").DataTable({
                //   columnDefs: [
                //     {
                //         target: 2,
                //         visible: false,
                //         searchable: false,
                //     },
                //     {
                //         target: 3,
                //         visible: false,
                //     },
                // ],
                //   order: [[ 3, 'desc' ], [ 0, 'asc' ]],
                scrollX: true,
                pageLength: 150,
                //   paging: false,
                ordering: false,
                language: language,
            });
        });
    </script>

    </body>

</x-app-layout>