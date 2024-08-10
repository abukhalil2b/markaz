<x-app-layout>
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ملحوظة المشرف
        </h2>


    <div class="px-3 py-3">

        <div>
            {{ $userRecorddaily->user->full_name }}
        </div>

        <form action="{{route('user_record_daily.moderator_note.update',$userRecorddaily->id)}}" method="post">
            @csrf

            <textarea class="border rounded p-1 mt-3 w-full" name="moderator_note" id="" cols="20" rows="10">{{ $userRecorddaily->moderator_note }}</textarea>

            <button class="mt-4 btn block btn-secondary" type="submit">حفظ</button>
        </form>
    </div>

</x-app-layout>