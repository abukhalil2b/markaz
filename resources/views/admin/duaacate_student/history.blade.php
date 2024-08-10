<x-app-layout>

<a href="{{ route('admin.student.dashboard',$student->id) }}" class="btn btn-outline-secondary">
		{{ $student->full_name }}
	</a>

        @foreach($duaacates as $duaacate)
        <div class="mt-5 p-3 border rounded">

            <div class="text-red-600 text-xl">
                {{ $duaacate->title }}
            </div>

            <div class="mt-4 flex gap-5">
                <div>
                    <a class="text-success flex gap-1 items-center" href="{{ route('admin.duaacate_student.show',$duaacate->duaacate_student_id) }}">
                        <x-svgicon.eye_open />
                        عرض
                    </a>
                </div>

                <div>
                    <a class="block" href="{{ route('admin.duaacate_student.toggle_done',$duaacate->duaacate_student_id) }}">
                        @if($duaacate->done_at)
                        <div class="text-orange flex gap-1 items-center">
                            <x-svgicon.note />
                            <div>
                                إلغاء إتمام المهمة
                            </div>
                        </div>
                        @else
                        <div class="text-success flex gap-1 items-center">
                            <x-svgicon.done />
                            تعين المهمة على أنها منجزة
                        </div>
                        @endif
                    </a>
                </div>
            </div>

        </div>
        @endforeach

</x-app-layout>