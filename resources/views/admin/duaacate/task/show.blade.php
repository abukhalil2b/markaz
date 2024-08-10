<x-app-layout>
    <div class="text-xl py-5" style="font-family: hafs;">
        (وَقُلْ رَبِّ زِدْنِي عِلْمًا)
    </div>

    <div x-data="{ show:false }">

        <template x-if=" ! show">

            <div class="p-3">

                <div class="text-red-600">
                    {{ $duaacateTask->title }}
                </div>

                <div class="mt-4 text-gray-600 text-xl leading-8" style="font-family: hafs;">
                    {!! nl2br($duaacateTask->content) !!}
                </div>

            </div>

        </template>

        <template x-if="show">

            <form action="{{route('admin.duaacate.task.update',$duaacateTask->id)}}" method="post" class="mt-4">
                @csrf
                <span>العنوان</span>
                <input name="title" class="form-input" value="{{ $duaacateTask->title }}">

                <div class="mt-4">
                    <span>الموضوع</span>
                    <textarea name="content" class="form-textarea" style="font-family: hafs;" rows="15">{{ $duaacateTask->content }}</textarea>
                </div>
                <div class="mt-5 flex gap-5">
                    <button class="btn btn-outline-secondary w-32">تعديل</button>
                    <div @click="show = false" class="btn btn-outline-warning w-32">إلغاء</div>
                </div>
            </form>

        </template>

        <div class="mt-5 flex gap-5">
            <a href="#" @click="show = true" x-cloak x-show=" ! show" class="btn btn-outline-secondary w-32">تعديل</a>
            <a class="btn btn-outline-primary w-32" href="{{ route('admin.duaacate.task.index',$duaacateTask->duaacate_id) }}">
                رجوع
            </a>
            @include('admin.duaacate.task._modal_delete')
        </div>
    </div>

</x-app-layout>