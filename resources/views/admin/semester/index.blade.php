<x-app-layout>


    <div class="p-1 flex justify-between">

        @if(auth()->user()->permission('admin.semester.store'))

        @include('inc.semester._modal_new_semester')

        @endif

        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.semester.student.amount_to_pay.create') }}">
            قائمة الطلاب
        </a>

    </div>

    @foreach($semesters as $semester)
    <div class="m-1 p-2 bg-white border rounded">

        <div class="text-red-800 text-xl">
            {{ $semester->title }}
            <div class="text-gray-400 text-xs py-1">
            تم إنشاء الفصل بتاريخ: {{ Str::substr($semester->created_at,0,10) }}
            </div>
        </div>

        <div class="mt-5 flex flex-col sm:flex-row gap-3">
            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.semester.student.subscriptionfee.index',$semester->id) }}">
                تسجيل المبلغ المقبوض من الطلاب
            </a>

            @if(auth()->user()->permission('admin.semester.update'))
            @include('inc.semester._modal_edit_semester')
            @endif
            @if(auth()->user()->permission('admin.semester.delete'))
            @include('inc.semester._modal_delete_semester')
            @endif
        </div>

    </div>
    @endforeach


</x-app-layout>