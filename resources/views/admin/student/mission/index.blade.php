<x-app-layout>
<div class="p-3">
     {{ $student->full_name }}
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

            <!-- missionSods -->
            <div x-data="{ show : false}">
                <div @click="show = ! show ">
                    @include('admin._title_bar',['title'=>'أنصاف الأثمان'])
                </div>
                <div x-cloak x-show="show" x-transition class="mb-4 mt-1 grid grid-cols-1 sm:grid-cols-2 gap-1">
                    @foreach($missionSods as $mission)

                    @include('admin.student.mission._mission_card')

                    @endforeach
                </div>
            </div>

            <!-- missionThomon -->
            <div x-data="{ show : false}">
                <div @click="show = ! show ">
                    @include('admin._title_bar',['title'=>'الأثمان'])
                </div>
                <div x-cloak x-show="show" x-transition class="mb-4 mt-1 grid grid-cols-1 sm:grid-cols-2 gap-1">
                    @foreach($missionThomon as $mission)

                    @include('admin.student.mission._mission_card')

                    @endforeach
                </div>
            </div>

            <!-- missionThomonAndHalf -->
            <div x-data="{ show : false}">
                <div @click="show = ! show ">
                    @include('admin._title_bar',['title'=>'الثمن ونصف الثمن'])
                </div>
                <div x-cloak x-show="show" x-transition class="mb-4 mt-1 grid grid-cols-1 sm:grid-cols-2 gap-1">
                    @foreach($missionThomonAndHalf as $mission)

                    @include('admin.student.mission._mission_card')

                    @endforeach
                </div>
            </div>

            <!-- missionRob -->
            <div x-data="{ show : false}">
                <div @click="show = ! show ">
                    @include('admin._title_bar',['title'=>'الأرباع'])
                </div>
                <div x-cloak x-show="show" x-transition class="mb-4 mt-1 grid grid-cols-1 sm:grid-cols-2 gap-1">
                    @foreach($missionRob as $mission)

                    @include('admin.student.mission._mission_card')

                    @endforeach
                </div>
            </div>

            <!-- missionNis -->
            <div x-data="{ show : false}">
                <div @click="show = ! show ">
                    @include('admin._title_bar',['title'=>'الانصاف'])
                </div>
                <div x-cloak x-show="show" x-transition class="mb-4 mt-1 grid grid-cols-1 sm:grid-cols-2 gap-1">
                    @foreach($missionNis as $mission)

                    @include('admin.student.mission._mission_card')

                    @endforeach
                </div>
            </div>

            <!-- missionAll -->
            <div x-data="{ show : false}">
                <div @click="show = ! show ">
                    @include('admin._title_bar',['title'=>'القرآن كاملا'])
                </div>
                <div x-cloak x-show="show" x-transition class="mb-4 mt-1 grid grid-cols-1 sm:grid-cols-2 gap-1">
                    @foreach($missionAll as $mission)

                    @include('admin.student.mission._mission_card')

                    @endforeach
                </div>
            </div>

        </div>

        <div x-cloak x-show="missionOrder == 'asc' ">

            <!-- missionSods asc -->
            <div x-data="{ show : false}">
                <div @click="show = ! show ">
                    @include('admin._title_bar',['title'=>' أنصاف الأثمان نزوليا'])
                </div>
                <div x-cloak x-show="show" x-transition class="mb-4 mt-1 grid grid-cols-1 sm:grid-cols-2 gap-1">
                    @foreach($missionSodsAsc as $mission)

                    @include('admin.student.mission._mission_card')

                    @endforeach
                </div>
            </div>

            <!-- missionThomon asc -->
            <div x-data="{ show : false}">
                <div @click="show = ! show ">
                    @include('admin._title_bar',['title'=>' الأثمان نزوليا'])
                </div>
                <div x-cloak x-show="show" x-transition class="mb-4 mt-1 grid grid-cols-1 sm:grid-cols-2 gap-1">
                    @foreach($missionThomonAsc as $mission)

                    @include('admin.student.mission._mission_card')

                    @endforeach
                </div>
            </div>

            <!-- missionThomonAndHalf asc -->
            <div x-data="{ show : false}">
                <div @click="show = ! show ">
                    @include('admin._title_bar',['title'=>'الثمن ونصف الثمن نزوليا'])
                </div>
                <div x-cloak x-show="show" x-transition class="mb-4 mt-1 grid grid-cols-1 sm:grid-cols-2 gap-1">
                    @foreach($missionThomonAndHalfAsc as $mission)

                    @include('admin.student.mission._mission_card')

                    @endforeach
                </div>
            </div>

            <!-- missionRob asc -->
            <div x-data="{ show : false}">
                <div @click="show = ! show ">
                    @include('admin._title_bar',['title'=>'الأرباع نزوليا'])
                </div>
                <div x-cloak x-show="show" x-transition class="mb-4 mt-1 grid grid-cols-1 sm:grid-cols-2 gap-1">
                    @foreach($missionRobAsc as $mission)

                    @include('admin.student.mission._mission_card')

                    @endforeach
                </div>
            </div>

            <!-- missionNis asc -->
            <div x-data="{ show : false}">
                <div @click="show = ! show ">
                    @include('admin._title_bar',['title'=>'الانصاف نزوليا'])
                </div>
                <div x-cloak x-show="show" x-transition class="mb-4 mt-1 grid grid-cols-1 sm:grid-cols-2 gap-1">
                    @foreach($missionNisAsc as $mission)

                    @include('admin.student.mission._mission_card')

                    @endforeach
                </div>
            </div>

            <!-- missionAll asc -->
            <div x-data="{ show : false}">
                <div @click="show = ! show ">
                    @include('admin._title_bar',['title'=>'القرآن كاملا نزوليا'])
                </div>
                <div x-cloak x-show="show" x-transition class="mb-4 mt-1 grid grid-cols-1 sm:grid-cols-2 gap-1">
                    @foreach($missionAllAsc as $mission)

                    @include('admin.student.mission._mission_card')

                    @endforeach
                </div>
            </div>

        </div>
    </div>


</x-app-layout>