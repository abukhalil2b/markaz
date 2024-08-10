<x-app-layout>

    <div class="flex justify-between">
        <a class="btn btn-outline-danger" href="{{route('admin.warnabsent.truncate')}}">
            حذف كل سجلات التحذير من الغياب

            {{ count($warnabsents) }}
        </a>

        <a class="btn btn-outline-danger" href="{{route('admin.warnlate.truncate')}}">
            حذف كل سجلات التحذير من التأخر

            {{ count($warnlates) }}
        </a>
    </div>


</x-app-layout>