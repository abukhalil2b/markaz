<x-app-layout>
    <div>
        السجلات اليومية
        ( {{ count($recorddailies) }} )
    </div>

    <div class="mt-3 flex gap-2">
        @foreach($createdAtDates as $createdAtDate)

        <a href="{{ route('admin.record.daily.index',$createdAtDate->year) }}" class="panel">{{ $createdAtDate->year }}</a>

        @endforeach
    </div>

    <div class="p-3">
        <label class="block w-52 bg-gray-50 rounded border !border-black p-1 hover:bg-white cursor-pointer">
            <input type="checkbox" id="presentMainCheckbox">
            تحديد الكل
        </label>
        <form action="{{ route('admin.record.daily.delete_all') }}" method="POST">
            @csrf

            <div class="mt-1 flex flex-wrap gap-1">
                @foreach($recorddailies as $recorddaily)
                <label class="w-52 p-1 bg-white border rounded text-[8px] flex gap-1 items-center">
                    <input type="checkbox" name="recorddailys[]" value="{{$recorddaily->id}}" class="h-6 w-6 rounded presentOtherCheckbox">
                    <div> {{ $recorddaily->title }} </div>
                    <div> {{ $recorddaily->workperiod->title }} </div>
                   
                </label>
                @endforeach
            </div>

            @if(count($recorddailies))
            @include('admin.record.daily._delete_all_records')
            @endif
        </form>

    </div>

    <script>
        var presentMainCheckbox = document.getElementById('presentMainCheckbox');
        var presentOtherCheckboxs = document.getElementsByClassName('presentOtherCheckbox');

        /* ----  present main checkbox  ------*/
        presentMainCheckbox.onchange = function(e) {

            for (var i = 0; i < presentOtherCheckboxs.length; i++) {
                if (presentMainCheckbox.checked) {
                    presentOtherCheckboxs[i].checked = true;
                } else {
                    presentOtherCheckboxs[i].checked = false;
                }

            }

        }
    </script>
</x-app-layout>