<div class="mt-5 text-red-900">
    <span class="text-red-700">السؤال:</span>
    {{ $answer->question_content }}
</div>
<div class="text-blue-700">
    <span class="text-red-700">الإجابة:</span>
    {{ $answer->answer_content }}
</div>

<div class="mt-3" x-data="{ showForm:false }">

    <div class="w-44 text-[10px] shadow border rounded p-1 hover:cursor-pointer animate-pulse" @click=" showForm = true ">
        الدرجة التي حصل عليها في هذا السؤال : {{ $answer->point }}
    </div>
    <form x-cloak x-show="showForm" action="{{ route('admin.answer.update_point') }}" method="post" class="mt-3 flex gap-1">
        @csrf
        <x-input type="number" name="point" class="text-right" value="{{ $answer->point }}" />
        <input type="hidden" name="question_id" value="{{ $answer->question_id }}">
        <input type="hidden" name="student_id" value="{{ $student->id }}">
        <x-button-primary class="w-full">
            حفظ
        </x-button-primary>
    </form>
</div>