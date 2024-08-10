<x-app-layout>

    <div class="p-3">
        جميع المهام التي يجب أن ينجزها الطالب
        <span class="text-red-800"> {{ $student->full_name }}</span>
    </div>

    <div x-data="{ missionOrder : 'desc' }" class="p-1">

        <div class="flex justify-between">
            <div @click=" missionOrder = 'desc' " class="w-32 btn-option" :class="missionOrder == 'desc'? 'btn-option-selected' : '' ">
                صعوديا
            </div>
            <div @click=" missionOrder = 'asc' " class="w-32 btn-option" :class="missionOrder == 'asc'? 'btn-option-selected' : '' ">
                نزوليا
            </div>
        </div>

        <div x-cloak x-show="missionOrder == 'desc' ">

            <!-- descMissions -->
            <div class="mb-4 mt-1 grid grid-cols-1 sm:grid-cols-2 gap-1">
                @foreach($descMissions as $mission)

                @include('admin.student.mission._mission_card')

                @endforeach
            </div>
        </div>

        <div x-cloak x-show="missionOrder == 'asc' ">

            <!-- ascMissions  -->
            <div class="mb-4 mt-1 grid grid-cols-1 sm:grid-cols-2 gap-1">
                @foreach($ascMissions as $mission)

                @include('admin.student.mission._mission_card')

                @endforeach
            </div>
        </div>

    </div>



    <!-- ascMissions  -->
    <div class="mb-4 mt-1 grid grid-cols-1 sm:grid-cols-2 gap-1">
        @foreach($missionsTests as $mission)

        @include('admin.student.mission._mission_card')

        @endforeach
    </div>


</x-app-layout>