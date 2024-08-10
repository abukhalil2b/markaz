<div class="mb-5" x-data="modal_edit_mission_task">

    <a href="#" class="w-16 text-orange font-bold text-center" @click="toggle"> تعديل </a>

    <div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="open && '!block'">
        <div class="flex min-h-screen items-center justify-center px-4" @click.self="open = false">
            <div x-show="open" x-transition x-transition.duration.300 class="panel my-8 w-full max-w-lg overflow-hidden rounded-lg border-0 p-0">
                <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                    <h5 class="text-lg font-bold"> {{ $studentMissionTask->descr }} </h5>
                    <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <form method="post" action="{{ route('admin.student.mission.task.update',['studentMissionTask'=>$studentMissionTask->id]) }}" class="p-4">
                    @csrf

                    @if( isset($mark) )
                    <div class="w-full">
                        <x-input-label for="point" value=" النقاط " />

                        <x-text-input id="point" name="point" type="number" class="p-1 mt-1 w-full" value="{{ $mark->point }}" />

                        <x-input-error :messages="$errors->get('point')" class="mt-2" />
                    </div>
                    @else
                    <div class="mt-3" x-data="{total: 0}">
                        <input type="hidden" name="point" x-model="total">
                        <div class="flex gap-3 justify-center items-center">
                            <div class="font-bold text-red-700">النقاط</div>
                            <div x-text="total" class="text-xl font-bold"></div>
                        </div>
                        <div class="flex gap-2 justify-center items-center mt-2">
                            <div class="btn-add-point" x-on:click="total=total+1">+1</div>
                            <div class="btn-add-point" x-on:click="total=total+3">+3</div>
                            <div class="btn-add-point" x-on:click="total=total+5">+5</div>
                            <div class="btn-add-point" x-on:click="total=total+10">+10</div>
                            <div class="btn-add-point" x-on:click="total=0">0</div>
                        </div>
                    </div>
                    @endif

                    <div x-data="{ evaluation:'{{ $studentMissionTask->evaluation }}',addEvaluation($ev){this.evaluation = $ev;} }" class="w-full">

                        <!-- add evaluation -->
                        <input type="hidden" name="evaluation" x-model="evaluation">
                        <div class="font-bold text-center text-red-700 mt-3">التقييم</div>
                        <div class="flex gap-1 justify-center items-center mt-2">
                            <div :class=" evaluation == 'تفوق عالٍ'? 'btn-evaluation-selected' : '' " class="btn-add-evaluation" x-on:click="addEvaluation('تفوق عالٍ')">تفوق عالٍ</div>
                            <div :class=" evaluation == 'ممتاز'? 'btn-evaluation-selected' : '' " class="btn-add-evaluation" x-on:click="addEvaluation('ممتاز')">ممتاز</div>
                            <div :class=" evaluation == 'جيد جدا'? 'btn-evaluation-selected' : '' " class="btn-add-evaluation" x-on:click="addEvaluation('جيد جدا')">جيد جدا</div>
                            <div :class=" evaluation == 'جيد'? 'btn-evaluation-selected' : '' " class="btn-add-evaluation" x-on:click="addEvaluation('جيد')">جيد</div>
                        </div>
                    </div>

                    <div class="mt-2">
                        <x-input-label for="note" value="ملحوظة" />
                        <textarea name="note" class="mt-1 h-20 rounded w-full border">{{ $studentMissionTask->note }}</textarea>
                        <x-input-error :messages="$errors->get('note')" class="mt-2" />
                    </div>


                    <div class="mt-8 flex items-center justify-end">
                        <button type="button" class="btn btn-outline-warning" @click="toggle">
                            إلغاء
                        </button>
                        <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4" @click="toggle">
                            حفظ التعديل
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("alpine:init", () => {

        Alpine.data("modal_edit_mission_task", () => ({

            open: false,

            toggle() {
                this.open = !this.open;
            }

        }));
    })
</script>