<x-app-layout>
    @if($user->user_type=='admin')
    <span> إدارة البرنامج . </span>
    @endif
    <x-today />

    @if(auth()->user()->permission('requestleave'))
    <a class="btn btn-outline-primary" href="{{route('requestleave.user_create_leave')}}">طلب إجازة</a>
    @endif

    @if ($user->user_type == 'male_moderator' || $user->user_type == 'female_moderator' || $user->user_type == 'admin') 
    @include('workperiod._show')

    @include('workperiod._latest_recorddaily')
    @endif

    @if(auth()->user()->permission('admin.semester.index'))
    <a class=" mt-4 p-2 btn btn-outline-primary" href="{{ route('admin.semester.index') }}">الفصول الدراسية</a>
    @endif
    
</x-app-layout>