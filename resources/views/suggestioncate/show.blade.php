<x-app-layout>

    <div class="py-5 text-gray-800 text-xl">
        {{$suggestioncate->title}}
    </div>

    <div class="p-2">
        الذين يمكنهم المشاهدة
    </div>



    <div class="flex flex-wrap gap-1 panel">

        @foreach($suggestioncate->suggestionpermissions as $user)
        @if($user->id!=1)
        <div class="p-1">
            <a class="text-red-800" href="{{route('suggestionpermission.delete',['user'=>$user->id,'suggestioncate'=>$suggestioncate->id])}}">حذف</a>
            {{$user->fullName}}
        </div>
        @endif
        @endforeach
    </div>

    <div class="mt-4 mb-5" x-data="modal_suggestion_permissions">

        <a href="#" class=" text-red-800 font-bold text-sm" @click="toggle"> + الصلاحيات </a>

        <div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="open && '!block'">
            <div class="flex min-h-screen items-center justify-center px-4" @click.self="open = false">
                <div x-show="open" x-transition x-transition.duration.300 class="panel my-8 w-full max-w-lg overflow-hidden rounded-lg border-0 p-0">
                    <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                        <h5 class="text-lg font-bold"> حدد الذين يمكنهم المشاهدة </h5>
                        <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <form method="post" action="{{ route('suggestionpermission.store',['suggestioncate'=>$suggestioncate->id]) }}" class="p-4">
                        @csrf
                        <div class="p-5">

                            <div class="mt-2">الصلاحيات</div>

                            @if(count($maleteachers))
                            <h6 class="mt-5">المدرسين </h6>
                            <label class="pb-2 w-full">
                                <input type="checkbox" onclick="maleteachersCheckbox(this);" class="checkbox"> تحديد الكل
                            </label>
                            <div class="flex flex-wrap gap-1">
                                @foreach($maleteachers as $teacher)
                                <label class="inline-flex gap-1 justify-center items-center border rounded p-1">
                                    <input type="checkbox" name="user_ids[]" value="{{$teacher->id}}" class="checkbox maleteachersCheckbox">
                                    <span class="text-sm">{{$teacher->fullName}}</span>
                                </label>
                                @endforeach
                            </div>
                            @endif

                            @if(count($femaleteachers))
                            <h6 class="mt-5">المدرسات</h6>
                            <label class="pb-2 w-full">
                                <input type="checkbox" onclick="femaleteachersCheckbox(this);" class="checkbox"> تحديد الكل
                            </label>
                            <div class="flex flex-wrap gap-1">
                                @foreach($femaleteachers as $teacher)
                                <label class="inline-flex gap-1 justify-center items-center border rounded p-1">
                                    <input type="checkbox" name="user_ids[]" value="{{$teacher->id}}" class="checkbox femaleteachersCheckbox">
                                    <span class="text-sm">{{$teacher->fullName}}</small>
                                </label>
                                @endforeach
                            </div>
                            @endif

                            @if(count($malemoderators))
                            <h6 class="mt-5">المشرفين</h6>
                            <label class="pb-2 w-full">
                                <input type="checkbox" onclick="malemoderatorsCheckbox(this);" class="checkbox"> تحديد الكل
                            </label>
                            <div class="flex flex-wrap gap-1">
                                @foreach($malemoderators as $moderator)
                                <label class="inline-flex gap-1 justify-center items-center border rounded p-1">
                                    <input type="checkbox" name="user_ids[]" value="{{$moderator->id}}" class="checkbox malemoderatorsCheckbox">
                                    <span class="text-sm">{{$moderator->fullName}}</span>
                                </label>
                                @endforeach
                            </div>
                            @endif

                            @if(count($femalemoderators))
                            <h6 class="mt-5">المشرفات</h6>
                            <label class="pb-2 w-full">
                                <input type="checkbox" onclick="femalemoderatorsCheckbox(this);" class="checkbox"> تحديد الكل
                            </label>
                            <div class="flex flex-wrap gap-1">
                                @foreach($femalemoderators as $moderator)
                                <label class="inline-flex gap-1 justify-center items-center border rounded p-1">
                                    <input type="checkbox" name="user_ids[]" value="{{$moderator->id}}" class="checkbox femalemoderatorsCheckbox">
                                    <span class="text-sm">{{$moderator->fullName}}</span>
                                </label>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="mt-8 flex items-center justify-end">
                            <button type="button" class="btn btn-outline-danger" @click="toggle">
                                إلغاء
                            </button>
                            <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4" @click="toggle">
                                حفظ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("alpine:init", () => {

            Alpine.data("modal_suggestion_permissions", () => ({

                open: false,

                toggle() {
                    this.open = !this.open;
                }

            }));
        })
    </script>

    <script>
        function maleteachersCheckbox(source) {
            var checkboxes = document.querySelectorAll('.maleteachersCheckbox');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }

        function femaleteachersCheckbox(source) {
            var checkboxes = document.querySelectorAll('.femaleteachersCheckbox');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }

        function malemoderatorsCheckbox(source) {
            var checkboxes = document.querySelectorAll('.malemoderatorsCheckbox');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }

        function femalemoderatorsCheckbox(source) {
            var checkboxes = document.querySelectorAll('.femalemoderatorsCheckbox');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>
</x-app-layout>