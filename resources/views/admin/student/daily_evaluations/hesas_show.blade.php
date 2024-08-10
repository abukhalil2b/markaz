<x-app-layout>

        <div class="py-4 text-red-800">
            {{ $daily_evaluation->descr }}
        </div>

        <a href="{{ route('admin.student.daily_evaluations.hesas_remove',$daily_evaluation->id) }}" class="btn btn-outline-danger">
            إزالة من لوحة التقويم اليومي
        </a>
</x-app-layout>