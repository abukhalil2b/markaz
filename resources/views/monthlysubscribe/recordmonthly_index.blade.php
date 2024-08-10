<x-app-layout>

    @foreach($recordmonthlies as $recordmonthly)
        <div class="col-lg-12">
            {{$recordmonthly->title}}
        </div>

        @endforeach

</x-app-layout>
