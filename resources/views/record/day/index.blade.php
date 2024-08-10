<x-app-layout>
    {{$title}}
    <div class="p-1 text-xs">
        <div>{{$recorddaily->title}}</div>
    </div>

    <div x-data="{showlist:'present'}">
        <div class="flex justify-center gap-4">
            <div @click="showlist = 'present' " class="w-32 h-12 btn-option " :class="showlist == 'present' ? 'btn-option-selected' : '' ">الحضور</div>
            <div @click="showlist = 'absent' " class="w-32 h-12 btn-option " :class="showlist == 'absent' ? 'btn-option-selected' : '' ">الغياب</div>
        </div>
        <!-- present -->
        <template x-if="showlist == 'present' ">
            <div class="mt-4">
                @include('record.day._presents')
            </div>
        </template>

        <!-- absent -->
        <template x-if="showlist == 'absent' ">
            <div class="mt-4">
                @include('record.day._absents')
            </div>
        </template>

    </div>

    <script>
    document.addEventListener("alpine:init", () => {

        Alpine.data("modal_remove_student_from_recorddaily", () => ({

            open: false,

            toggle() {
                this.open = !this.open;
            }

        }));
    })
</script>
</x-app-layout>