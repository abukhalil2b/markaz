<x-app-layout>


    <div class="mt-2 text-xl">
        الإدارة
    </div>
    @foreach($admins as $admin)
    <div class="mt-1 panel">
        <a href="{{ route('message.receiver.permission.index',$admin->id) }}">

            {{ $admin->full_name }}
        </a>
    </div>
    @endforeach

    <div class="mt-2 text-xl">
        المشرفين
    </div>
    @foreach($maleModerators as $maleModerator)
    <div class="mt-1 panel">
        <a href="{{ route('message.receiver.permission.index',$maleModerator->id) }}">

            {{ $maleModerator->full_name }}
        </a>
    </div>
    @endforeach

    <div class="mt-2 text-xl">
        المشرفات
    </div>
    @foreach($femaleModerators as $femaleModerator)
    <div class="mt-1 panel">
        <a href="{{ route('message.receiver.permission.index',$femaleModerator->id) }}">

            {{ $femaleModerator->full_name }}
        </a>
    </div>
    @endforeach

    <div class="mt-2 text-xl">
        المعلمين
    </div>
    @foreach($maleTeachers as $maleTeacher)
    <div class="mt-1 panel">
        <a href="{{ route('message.receiver.permission.index',$maleTeacher->id) }}">

            {{ $maleTeacher->full_name }}
        </a>
    </div>
    @endforeach

    <div class="mt-2 text-xl">
        المعلمات
    </div>
    @foreach($femaleTeachers as $femaleTeacher)
    <div class="mt-1 panel">
        <a href="{{ route('message.receiver.permission.index',$femaleTeacher->id) }}">

            {{ $femaleTeacher->full_name }}
        </a>
    </div>
    @endforeach

</x-app-layout>