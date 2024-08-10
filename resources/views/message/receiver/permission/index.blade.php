<x-app-layout>
    <div class="panel">
        <div class="text-xl text-gray-800">
            {{ $user->full_name }}
        </div>
        <div class="text-xs text-gray-800">
            {{ __($user->user_type) }}
        </div>
        حدد من القائمة المستخدمين الذين يمكن إرسال لهم الإشعارات والتنبيهات
    </div>

    <form action="{{ route('message.receiver.permission.update',$user->id) }}" method="post">
        @csrf

        <label class="mt-3 hover:cursor-pointer text-xl">
            <input type="checkbox" id="selectAllAdmin">
            الإدارة
        </label>
        @foreach($admins as $receiver)
        <label class="mb-1 p-1 text-xs rounded bg-white flex justify-start gap-1 border">
            <input class="jsAdminCheckboxes" type="checkbox" name="receiverIds[]" value="{{ $receiver->id }}" {{ $receiver->can_receive ? 'checked' : '' }}>
            {{ $receiver->full_name }}
        </label>
        @endforeach

        <label class="mt-3 hover:cursor-pointer text-xl">
            <input type="checkbox" id="selectAllMaleModerator">
            المشرفين
        </label>
        @foreach($maleModerators as $receiver)
        <label class="mb-1 p-1 text-xs rounded bg-white flex justify-start gap-1 border">
            <input class="jsMaleModeratorCheckboxes" type="checkbox" name="receiverIds[]" value="{{ $receiver->id }}" {{ $receiver->can_receive ? 'checked' : '' }}>
            {{ $receiver->full_name }}
        </label>
        @endforeach

        <label class="mt-3 hover:cursor-pointer text-xl">
            <input type="checkbox" id="selectAllFemaleModerator">
            المشرفات
        </label>
        @foreach($femaleModerators as $receiver)
        <label class="mb-1 p-1 text-xs rounded bg-white flex justify-start gap-1 border">
            <input class="jsFemaleModeratorCheckboxes" type="checkbox" name="receiverIds[]" value="{{ $receiver->id }}" {{ $receiver->can_receive ? 'checked' : '' }}>
            {{ $receiver->full_name }}
        </label>
        @endforeach

        <label class="mt-3 hover:cursor-pointer text-xl">
            <input type="checkbox" id="selectAllMaleTeacher">
            المعلمين
        </label>
        @foreach($maleTeachers as $receiver)
        <label class="mb-1 p-1 text-xs rounded bg-white flex justify-start gap-1 border">
            <input class="jsMaleTeacherCheckboxes" type="checkbox" name="receiverIds[]" value="{{ $receiver->id }}" {{ $receiver->can_receive ? 'checked' : '' }}>
            {{ $receiver->full_name }}
        </label>
        @endforeach

        <label class="mt-3 hover:cursor-pointer text-xl">
            <input type="checkbox" id="selectAllFemaleTeacher">
            المعلمات
        </label>
        @foreach($femaleTeachers as $receiver)
        <label class="mb-1 p-1 text-xs rounded bg-white flex justify-start gap-1 border">
            <input class="jsFemaleTeacherCheckboxes" type="checkbox" name="receiverIds[]" value="{{ $receiver->id }}" {{ $receiver->can_receive ? 'checked' : '' }}>
            {{ $receiver->full_name }}
        </label>
        @endforeach

        <x-button-primary class="mt-4 w-full">
            تحديث
        </x-button-primary>
    </form>


    <script>
        /**--- admin ---*/
        var selectAllAdmin = document.getElementById('selectAllAdmin')
        var jsAdminCheckboxes = document.getElementsByClassName('jsAdminCheckboxes');

        selectAllAdmin.onchange = function() {

            for (let index = 0; index < jsAdminCheckboxes.length; index++) {

                const element = jsAdminCheckboxes[index];

                if (selectAllAdmin.checked) {
                    element.checked = true;
                } else {
                    element.checked = false;
                }
            }
        }

        /**--- male moderator ---*/
        var selectAllMaleModerator = document.getElementById('selectAllMaleModerator')
        var jsMaleModeratorCheckboxes = document.getElementsByClassName('jsMaleModeratorCheckboxes');

        selectAllMaleModerator.onchange = function() {

            for (let index = 0; index < jsMaleModeratorCheckboxes.length; index++) {

                const element = jsMaleModeratorCheckboxes[index];

                if (selectAllMaleModerator.checked) {
                    element.checked = true;
                } else {
                    element.checked = false;
                }
            }
        }

        /**--- female moderator ---*/
        var selectAllFemaleModerator = document.getElementById('selectAllFemaleModerator')
        var jsFemaleModeratorCheckboxes = document.getElementsByClassName('jsFemaleModeratorCheckboxes');

        selectAllFemaleModerator.onchange = function() {

            for (let index = 0; index < jsFemaleModeratorCheckboxes.length; index++) {

                const element = jsFemaleModeratorCheckboxes[index];

                if (selectAllFemaleModerator.checked) {
                    element.checked = true;
                } else {
                    element.checked = false;
                }
            }
        }

        /**--- male teacher ---*/
        var selectAllMaleTeacher = document.getElementById('selectAllMaleTeacher')
        var jsMaleTeacherCheckboxes = document.getElementsByClassName('jsMaleTeacherCheckboxes');

        selectAllMaleTeacher.onchange = function() {

            for (let index = 0; index < jsMaleTeacherCheckboxes.length; index++) {

                const element = jsMaleTeacherCheckboxes[index];

                if (selectAllMaleTeacher.checked) {
                    element.checked = true;
                } else {
                    element.checked = false;
                }
            }
        }

        /**--- female teacher ---*/
        var selectAllFemaleTeacher = document.getElementById('selectAllFemaleTeacher')
        var jsFemaleTeacherCheckboxes = document.getElementsByClassName('jsFemaleTeacherCheckboxes');

        selectAllFemaleTeacher.onchange = function() {

            for (let index = 0; index < jsFemaleTeacherCheckboxes.length; index++) {

                const element = jsFemaleTeacherCheckboxes[index];

                if (selectAllFemaleTeacher.checked) {
                    element.checked = true;
                } else {
                    element.checked = false;
                }
            }
        }
    </script>
</x-app-layout>