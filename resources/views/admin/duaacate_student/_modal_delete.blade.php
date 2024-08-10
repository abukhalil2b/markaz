<div class="" x-data="modal_delete_duaacate_student">

    <button class="flex items-center text-danger" @click="toggle">
        <x-svgicon.trash />
        <div class="h-6">
            حذف
        </div>
    </button>

    <div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="open && '!block'">
        <div class="flex min-h-screen items-center justify-center px-4" @click.self="open = false">
            <div x-show="open" x-transition x-transition.duration.300 class="panel my-8 w-full max-w-lg overflow-hidden rounded-lg border-0 p-0">
                <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                    <h5 class="text-lg font-bold"> حذف مهمة البساتين </h5>
                    <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <div class="p-5">

                    <div class="mt-8 flex items-center justify-end">
                        <button type="button" class="btn btn-outline-warning" @click="toggle">
                            إلغاء
                        </button>

                        <form action="{{ route('admin.duaacate_student.delete') }}" method="post">
                            @csrf
                            <button class="btn btn-danger ltr:ml-4 rtl:mr-4">
                                حذف المهمة نهائيا
                            </button>

                            <input type="hidden" name="duaacate_student_id" value="{{ $duaacateStudent->id }}">
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("alpine:init", () => {

        Alpine.data("modal_delete_duaacate_student", () => ({

            open: false,

            toggle() {
                this.open = !this.open;
            }

        }));
    })
</script>