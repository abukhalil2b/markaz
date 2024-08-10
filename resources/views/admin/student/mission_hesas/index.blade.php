<x-app-layout>

    <div class="py-3 text-xl">
    {{$student->full_name}}
    </div>

    <div class="mb-5" x-data="{ active: null }">

    <x-mission-card title="مراجعة الأثمان" :missions="$missionReviewThomon" :student="$student" :collapseId="1" />

    <x-mission-card title=" مراجعة الثمن ونصف الثمن " :missions="$missionReviewThomonAndHalf" :student="$student" :collapseId="2" />

    <x-mission-card title=" مراجعة الثمن ونصف الثمن نزوليا " :missions="$missionReviewThomonAndHalfAsc" :student="$student" :collapseId="3" />

    <x-mission-card title=" مراجعة الأرباع " :missions="$missionReviewRob" :student="$student" :collapseId="4" />

    <x-mission-card title=" مراجعة الانصاف " :missions="$missionReviewNis" :student="$student" :collapseId="5" />

    <x-mission-card title=" مراجعة القرآن كاملا " :missions="$missionReviewAll" :student="$student" :collapseId="6" />

    <x-mission-card title=" مراجعة أنصاف الأثمان " :missions="$missionReviewSods" :student="$student" :collapseId="7" />
    </div>

</x-app-layout>