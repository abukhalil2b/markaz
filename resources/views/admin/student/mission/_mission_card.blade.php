<a href="{{ route('admin.student.mission.create',['mission'=>$mission->id,'student'=>$student->id]) }}" class="block p-1 border rounded bg-white">
    {{ $mission->title}}
    <div class="text-xs text-gray-400">
        {{ $mission->note }}
    </div>
</a>