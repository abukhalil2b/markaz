<x-app-layout>
    <div class="text-xl text-blue-800">
        {{ $semester->title }}
    </div>


    <div x-data="amount_to_pay">


        <div class="p-2 text-xs">
            <span>في كل فصل يقوم المشرف بإختيار (الطلاب المطلوب عليهم مبلغ شهري) من هذه القائمة .</span>
            يحدد فيها كل طالب،
            والمبلغ الذي يجب عليه دفعه في هذا الفصل،
            ويحدد اذا كان معفي من الدفع
        </div>

        <div class="p-5 flex items-center justify-center gap-5">
            <div x-cloak x-show="! showSearchForm" class="">
                <button class="btn btn-outline-primary" @click="toggle()">بحث</button>
            </div>
            <a class="btn btn-outline-primary" href="{{ route('admin.semester.index') }}">
                <x-svgicon.back_arrow />
                <span class="mx-1"> الفصل الدراسي </span>
            </a>

        </div>
        <template x-if="showSearchForm">
            <form action="{{ route('admin.semester.student.amount_to_pay.search',$semester->id) }}" method="POST">
                @csrf
                <div class="flex gap-5">
                    <x-input type="search" name="search" placeholder="رقم الطالب أو الاسم" />
                    <x-button-primary class="w-full" type="submit">
                        بحث
                    </x-button-primary>
                </div>
            </form>
        </template>
        <div class="text-xl text-red-800">
            قائمة الطلاب
        </div>
        <template x-if="! showSearchForm">
            <form action="{{ route('admin.semester.student.amount_to_pay.store') }}" method="POST">
                @csrf

                <label class="p-3 block bg-gray-50 rounded border !border-black hover:bg-white cursor-pointer w-full">
                    <input type="checkbox" id="mainCheckbox" class="">
                    تحديد الكل
                </label>
                <table style="font-size: 12px;width:100%;">
                    <thead>
                        <tr>
                            <td>الاسم</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>
                                <label class="flex items-center gap-1 w-full border rounded p-1">
                                    <input type="checkbox" name="studentIds[]" value="{{$student->id}}" class="amountToPayCheckbox w-6 h-6">
                                    <span class="student-number">{{$student->id}}</span>
                                    {{$student->full_name}}
                                </label>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <input type="hidden" name="semester_id" value="{{ $semester->id }}">
                <input type="hidden" name="workperiod_id" value="{{ $workperiod->id }}">


                <div class="mt-4 w-62 flex">
                    <div class="p-1 text-xs">
                        المبلغ الكلي الذي يجب أن يدفعه خلال الفصل
                    </div>

                    <x-text-input id="amount" name="amount" type="number" class="w-16" step="any" value="10" />

                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                </div>

                <div class="w-60 flex gap-2">

                    <x-input-label for="isforgiven" value="هل معفي" />
                    <input type="checkbox" name="isforgiven" class="w-6 h-6" value="1">

                    <x-input-error :messages="$errors->get('isforgiven')" class="mt-2" />
                </div>


                <x-button-primary class="mt-3 w-full" type="submit">
                    تسجيل الطالب في القائمة
                </x-button-primary>
                <script>
                    var mainCheckbox = document.getElementById('mainCheckbox');
                    var amountToPayCheckboxs = document.getElementsByClassName('amountToPayCheckbox');

                    /* ---- main checkbox  ------*/
                    mainCheckbox.onchange = function(e) {

                        for (var i = 0; i < amountToPayCheckboxs.length; i++) {
                            if (mainCheckbox.checked) {
                                amountToPayCheckboxs[i].checked = true;
                            } else {
                                amountToPayCheckboxs[i].checked = false;
                            }

                        }

                    }
                </script>
            </form>
        </template>

    </div>

    <script>
        document.addEventListener("alpine:init", () => {

            Alpine.data("amount_to_pay", () => ({

                showSearchForm: false,

                toggle() {
                    this.showSearchForm = !this.showSearchForm;
                }

            }));
        })
    </script>

</x-app-layout>