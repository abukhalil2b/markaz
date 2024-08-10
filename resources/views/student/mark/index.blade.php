<x-student.layout>
    <div class="p-3">

            @foreach($marks as $mark)
            <div class="mt-1 p-2 border rounded bg-white flex justify-between">

                <div>
                    {{__($mark->tag)}}
                    <div class="text-xs text-gray-400">
                        {{$mark->created_at->format('d-m-Y')}}
                    </div>
                </div>


                <div>
                    {{$mark->point}}
                </div>

            </div>
            @endforeach

        <div class="col-md-12 mt-5">
            {{ $marks->links() }}
        </div>
    </div>
</x-student.layout>