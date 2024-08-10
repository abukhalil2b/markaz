<x-app-layout>

    <div class="p-3">
        جميع المهام التي يجب أن ينجزها الطالب
       <span class="text-red-800"> {{ $student->full_name }}</span>
    </div>

    <div class="mb-4 mt-1 grid grid-cols-1 sm:grid-cols-2 gap-1">
        @foreach($hesasMissions as $mission)

        <a href="{{ route('admin.student.mission_hesas.create',['mission'=>$mission->id,'student'=>$student->id]) }}" class="block p-1 border rounded bg-white">
            {{ $mission->title}}
            <div class="text-xs text-gray-400">
                {{ $mission->note }}
            </div>
        </a>

        @endforeach
    </div>


</x-app-layout>