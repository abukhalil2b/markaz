<x-app-layout>

<div class="p-3">
     <a target="_blank" class="btn btn-outline-secondary" href="https://surahquran.com/fahras.html">فهرس القرآن الكريم</a>

    </div>
    <div class="p-3 text-xl" style="font-family: hafs;">
    ( وَقُل رَّبِّ زِدۡنِي عِلۡمٗا )
    </div>

    @include('admin.duaacate._modal_duaacate_parent_create')
    <div class="p-3">
        @foreach($duaacates as $duaacate)
        <div class="mt-5 p-3 border rounded">

            <div class="flex justify-between">
                <div class="text-red-600 text-xl">
                    {{ $duaacate->title }}
                </div>
                @include('admin.duaacate._modal_duaacate_parent_edit')
            </div>

            @if($duaacate->childs)
            <div class="mt-4">
                @foreach($duaacate->childs as $child)
                <div class="mt-3 flex items-center justify-between bg-gray-100 text-gray-500 p-2">
                    <div class="text-2xl">
                        {{ $child->title }}
                    </div>
                    <div class="flex justify-center items-center flex-col gap-2">
                        <a href="{{ route('admin.duaacate.task.index',$child->id) }}" class="w-28 block border rounded px-3 py-1 text-xs text-center">
                            المهام
                        </a>
                        @include('admin.duaacate._modal_duaacate_child_edit')
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            <div>
                @include('admin.duaacate._modal_duaacate_child_create')
            </div>
        </div>
        @endforeach
    </div>

</x-app-layout>