<div class="mb-5" x-data="modal_search_for_absent">

    <a href="#" class="btn btn-outline-secondary" @click="toggle">  البحث عن الغياب </a>

    <div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="open && '!block'">
        <div class="flex min-h-screen items-center justify-center px-4" @click.self="open = false">
            <div x-show="open" x-transition x-transition.duration.300 class="panel my-8 w-full max-w-lg overflow-hidden rounded-lg border-0 p-0">
                <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                    <h5 class="text-lg font-bold"> فصل دراسي جديد </h5>
                    <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <form method="post" action="{{ route('admin.record.daily.absent_search') }}" class="p-4">
                    @csrf
                    <div class="p-5">

                        <div class="py-3">
                            من
                        </div>
                        <input name="datefrom" class="form-input" type="date">

                        <div class="py-3">
                            إلى
                        </div>
                        <input name="dateto" class="form-input" type="date">

                        <div class="mt-8 flex items-center justify-between">
                            <button type="button" class="btn btn-outline-danger" @click="toggle">
                                إلغاء
                            </button>
                            <button type="submit" class="btn btn-primary w-52" @click="toggle">
                                بحث
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("alpine:init", () => {

        Alpine.data("modal_search_for_absent", () => ({

            open: false,

            toggle() {
                this.open = !this.open;
            }

        }));
    })
</script>