<x-app-layout>
    <div class="p-1 flex justify-between">

        <div class="text-xl text-red-800">
            <div>
                {{ $semester->title }}
            </div>
            <div>
                {{ $student->full_name }}
            </div>
        </div>

        @if(auth()->user()->permission('admin.subscriptionfee.store'))

        @include('inc._modal_new_subscriptionfee')

        @endif

    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <td>التاريخ</td>
                <td>المبلغ</td>
                <td>ملحوظة</td>
                <td>إدارة</td>
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
                <td>
                    <div class="gap-4 flex ">
                        @if(auth()->user()->permission('admin.subscriptionfee.update'))
                        @include('inc._modal_edit_subscriptionfee')
                        @endif
                        @if(auth()->user()->permission('admin.subscriptionfee.delete'))
                        @include('inc._modal_delete_subscriptionfee')
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4">
                    <div class="m-1 p-2 bg-white border rounded text-xl">
                        المجموع: {{ $total }}
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="h-72 flex justify-center items-center">

        <div x-data="modal_confirm_delete">

            <a href="#" class="btn btn-outline-danger " @click="toggle">
                إزالة الطالب من القائمة
                وحذف المدفوعات
            </a>

            <div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="open && '!block'">
                <div class="flex min-h-screen items-center justify-center px-4" @click.self="open = false">

                    <div x-show="open" x-transition x-transition.duration.300 class="panel my-8 w-full max-w-lg overflow-hidden rounded-lg border-0 p-0">
                        <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                            <h5 class="text-lg font-bold">تأكيد الحذف</h5>
                            <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </div>

                        <div class="p-5">

                            <form action="{{ route('admin.student_amount_to_pay_delete') }}" method="POST">
                                @csrf

                                <input type="hidden" name="semester_id" value="{{ $semester->id }}">
                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                <button class="btn btn-danger">
                                    تأكيد الحذف
                                </button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("modal_confirm_delete", () => ({
                open: false,
                toggle() {
                    this.open = !this.open
                }
            }))
        })
    </script>
</x-app-layout>