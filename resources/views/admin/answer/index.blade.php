<x-app-layout>
    <div class="p-3">
        {{ $student->full_name }} - {{ $course->subject }}
    </div>

    <a class="flex justify-center items-center border rounded p-1 h-10 w-44 bg-white" href="{{ route('admin.course.course_student.student_index',$course->id) }}">
        رجوع
    </a>

    @if($type == 'text')
    @foreach($answers as $answer)
    <div>

        @include('admin.answer._question_type_text')

    </div>
    @endforeach
    @endif


    @if($type == 'multiChoice')
    @foreach($answers as $answer)
    <div>

        @include('admin.answer._question_type_multi_choice')

        الدرجة:
        {{ $answer->point }}

    </div>
    @endforeach
    @endif



    @if( $type == 'oral' )

    deleted

    @endif


</x-app-layout>