<x-app-layout>

    @foreach($recorddailies as $recorddaily)

    <a href="{{ route('record.day.index',$recorddaily->id) }}" class="my-5 btn btn-sm btn-outline-primary">
        {{ $recorddaily->title }}
    </a>

    @endforeach

</x-app-layout>