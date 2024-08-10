<x-app-layout>

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        فتح السجل اليومي لـ {{$workperiod->title}}
    </h2>

    <form action="{{route('admin.record.daily.store',$workperiod->id)}}" method="post">
        @csrf

        @include('admin.record.daily._level_record_modal')
        @include('admin.record.daily._user_record_modal')

        <div>
            <label class="rounded border w-full p-1 my-2">
                <input class="checkbox" type="checkbox" name="ignore_day" value="1">
                حدد كل الطلاب الموجودين في القاعة بغض النظر عن جدول حضور الطالب
            </label>
            <label class="rounded border w-full p-1 my-2">
                <input class="checkbox" type="checkbox" name="ignore_workperiod" value="1">
                حدد كل الطلاب الموجودين في القاعة بغض النظر عن الفترة التي يدرس فيها الطالب
            </label>
            <span class="text-info bold">عنوان السجل</span>
            <input value="السجل اليومي ({{__($workperiod->gender)}}): {{__(date('D',time()))}} {{date('d-m-Y',time())}}" name="title" class="form-input">

            @if($alreadyOpened)
            <div class="mt-5 py-6 bg-red-200 text-red-800 text-center">
                <div class="text-xl">تم فتح السجل بنفس تاريخ اليوم</div>
                {{ $alreadyOpened->title }}
            </div>

            @else
            <button class="btn btn-outline-secondary block mt-3">
                فتح السجل وإضافة القاعة والطاقم الإداري فيه
            </button>
            @endif

        </div>

    </form>


</x-app-layout>