<x-app-layout>

    @foreach($students as $student)
    <a href="{{ route('admin.student.warning.index',$student->id) }}" class="block mt-2 p-1 text-red-800 bg-white">

        {{ $student->full_name }}

    </a>
    @endforeach

</x-app-layout>