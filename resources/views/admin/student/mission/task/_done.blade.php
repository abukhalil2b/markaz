<div>
    <form action="{{ route('admin.student.task.store') }}" method="POST" x-data="{

total: 0,
showAddPoint: false,
evaluation: '',

addEvaluation(eval) {
    this.evaluation = eval;
    this.showAddPoint = true;
    if (eval == 'لم ينجح') {
        this.total = 0;
        this.showAddPoint = false;
    }
}

}">
        @csrf
        <div class="mt-5">
            <x-input-add-wrong-number-with-note :allowedWrongNumber="$studentMissionTask->allow_wrong" />
        </div>

        <div class="mt-5">
            <x-input-add-point-with-valuation />
        </div>

        <div class="">
            <x-textarea-add-note />
        </div>

        <input type="hidden" name="student_mission_task_id" value="{{ $studentMissionTask->id }}">

        <div class="flex flex-col items-center">
            <input type="hidden" name="mission_type" value="{{ $studentMissionTask->mission_type }}">
            <x-button-primary x-cloak x-show=" evaluation != '' " class="mt-2 w-32">
                تم إكمال المهمة
            </x-button-primary>

        </div>

    </form>

</div>