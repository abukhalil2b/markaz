<x-student.layout>

    <!-- courses -->
    <div class="p-3">
        <div class="text-red-800 text-2xl">
            {{ $studentHasDuaa->duaa->title }}
        </div>

        <div class="mt-3">
        {!! nl2br($studentHasDuaa->duaa->content) !!}
        </div>

    </div>
</x-student.layout>