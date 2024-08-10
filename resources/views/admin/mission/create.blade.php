<x-app-layout>


    <div class="p-3">
         كتابة المنهج
    </div>

    @foreach($missions as $mission)

    @include('admin.mission._mission_card')

    @endforeach

    <div class="mt-5 p-4">
        <a href="{{ route('admin.mission.print_all_active_asc') }}">
            طباعة كل الخطة نزوليا
        </a>
    </div>
</x-app-layout>