<x-app-layout>

    <div class="bg-white p-4 text-center text-xl">
        {{ $user->full_name }}
    </div>

    <form action="{{ route('admin.user_record_daily.update',$latestUserRecorddaily->id) }}" method="post" class="mt-3">
        @csrf

        سبب التأخر أو الملحوظة
        <input type="text" class="form-input" name="note">

        <button class="mt-4 btn btn-outline-secondary" type="submit">تسجيل الحضور  {{ date('H:i') }} </button>

        <input type="hidden" name="timenow" value="{{ date('H:i:s') }}">

    </form>

</x-app-layout>