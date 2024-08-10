<x-student.layout>

    <!-- courses -->
    <div class="p-3">

    <div class="flex justify-center text-xl text-red-800">
        الحضور والغياب
    </div>
        <div class="text-red-800">
            @foreach($timesOfAbsences as $timesOfAbsence)

            <div class="mt-1 p-3 border rounded bg-white flex justify-between">
                <div>الشهر: {{ $timesOfAbsence->in_month }}</div>
                <div>عدد مرات الغياب: {{ $timesOfAbsence->absentTimes }}</div>
            </div>

            @endforeach
        </div>

    </div>

</x-student.layout>