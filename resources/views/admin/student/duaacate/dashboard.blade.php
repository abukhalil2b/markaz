<x-app-layout>
    <div class="p-3">
        (وَقُلْ رَبِّ زِدْنِي عِلْمًا)
    </div>
    <div class="p-3">
        @foreach($duaacates as $duaacate)
        <div class="mt-5 p-3">

            <div class="text-red-600 text-xl">
                {{ $duaacate->title }}
            </div>

            @if($duaacate->childs)
            <div>
                @foreach($duaacate->childs as $child)
                <a href="{{ route('admin.student.duaacate.task.index',['duaacate'=>$child->id,'student'=>$student->id]) }}"
                class="block border mt-4 {{ $child->done ? 'border-green-600 bg-green-100 text-green-600' : ' bg-gray-100 text-gray-500' }}  py-3 px-1 dark:bg-gray-500 dark:text-gray-200">
                    {{ $child->title }}
                </a>
                @endforeach
            </div>
            @endif

        </div>
        @endforeach
    </div>


</x-app-layout>