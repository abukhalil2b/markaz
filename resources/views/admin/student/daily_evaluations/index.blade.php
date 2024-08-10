<x-app-layout>


    <div class="p-3">
        <div>
            عدد السجلات:
            {{ $dailyEvaluationCount }}
        </div>
        @if(auth()->user()->permission('admin.student.daily_evaluations.truncate'))
        <div>
            يجب الحذف في غير أيام وقت الدراسة
        </div>
        <a href="{{ route('admin.student.daily_evaluations.truncate') }}" class="block text-center mt-3 border rounded p-2 w-full">
            حذف التقييمات السابقة
        </a>
        @endif

    </div>

</x-app-layout>