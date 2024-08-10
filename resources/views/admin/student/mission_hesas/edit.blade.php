<x-app-layout>

    @php
    $moderatorCssClass ='';

    $adminCssClass ='';

    if($studentHasMission->step_approval == 1 || $studentHasMission->step_approval == 2){
        $moderatorCssClass = ' bg-green-200 border-green-600 ';
    }

    if($studentHasMission->step_approval == 2){
        $adminCssClass = ' bg-green-200 border-green-600 ';
    }
    @endphp


    <div class="flex gap-3">
        <div class="border rounded mt-3 p-1 {{ $moderatorCssClass }} ">
            اعتماد المشرف
        </div>

        <div class="border rounded mt-3 p-1 {{ $adminCssClass }} ">
            اعتماد الإدارة
        </div>
    </div>

    <div class="mt-3">
        {{$studentHasMission->mission_title}}
    </div>

    <div class="text-xs">بدأت: {{date('d-m-Y',$studentHasMission->start_at)}}</div>

    @if($studentHasMission->done_at != null)
    <div class="text-xs">تمت: {{date('d-m-Y',$studentHasMission->done_at)}}</div>
    @endif

    <div class="mt-2 text-xs border rounded p-3">

        <div class="small">عدد الأخطاء:
            {{$studentHasMission->numwrong}}
        </div>

        @if( $studentHasMission->wrongs && count( json_decode($studentHasMission->wrongs) ) )
        @foreach(json_decode($studentHasMission->wrongs) as $wrong)
        <div class="small">{{ $wrong->note }}</div>
        @endforeach
        @endif

    </div>

    <form action="{{ route('admin.student.mission_hesas.update',['studentHasMission'=>$studentHasMission->id]) }}" method="post">
        @csrf
        <div class="mt-4">
            التقييم
        </div>
        <select name="evaluation" class="mt-2 p-1 w-full border rounded">
            <option selected value="تفوق عالٍ" @if( $studentHasMission->evaluation == 'تفوق عالٍ' ) selected @endif >
                تفوق عالٍ
            </option>
            <option value="ممتاز" @if( $studentHasMission->evaluation == 'ممتاز' ) selected @endif >
                ممتاز
            </option>
            <option value="جيد جدا" @if( $studentHasMission->evaluation == 'جيد جدا' ) selected @endif >
                جيد جدا
            </option>
            <option value="جيد" @if( $studentHasMission->evaluation == 'جيد' ) selected @endif >
                جيد
            </option>
            <option value="لم ينجح" @if( $studentHasMission->evaluation == 'لم ينجح' ) selected @endif >
                لم ينجح
            </option>
        </select>

        <div class="mt-4"> </div>
        <textarea name="notes" class="mt-2 h-32 p-1 w-full border rounded">{{ $studentHasMission->notes }}</textarea>

        <hr>
        <x-button-primary class="block mt-2 w-[224px]">
            تحديث
        </x-button-primary>
    </form>


</x-app-layout>