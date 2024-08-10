<x-app-layout>

    <!-- note create -->
    <div class="mb-5" x-data="modal">

        <a href="#" class=" font-bold text-sm" @click="toggle">
            سجل ملحوظتك عن {{ $student->full_name}} <span class="text-red-800">هنا</span>
        </a>

        <div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="open && '!block'">
            <div class="flex min-h-screen items-center justify-center px-4" @click.self="open = false">
                <div x-show="open" x-transition x-transition.duration.300 class="panel my-8 w-full max-w-lg overflow-hidden rounded-lg border-0 p-0">
                    <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                        <h5 class="text-lg font-bold">ملحوظة جديدة</h5>
                        <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <form method="post" action="{{ route('admin.student.note.store',$student->id) }}" class="p-4">
                        @csrf
                        <div class="p-2">
                            <div class="py-3 text-red-800">
                                <p> ملحوظة عن سلوك الطالب بحيث يستوجب اتخاذ إجراء إداري</p>
                                <p> ملحوظة عن مستوى الطالب بحيث يستوجب اتخاذ إجراء إداري</p>
                            </div>
                            <textarea name="title" class="w-full focus:ring-0 rounded border h-20"></textarea>

                            <div class="mt-8 flex items-center justify-end">
                                <button type="button" class="btn btn-outline-danger" @click="toggle">
                                    إلغاء
                                </button>
                                <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4" @click="toggle">
                                    حفظ
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- note index -->

    @foreach($notes as $note)
    <div class="border rounded p-3 w-full bg-white">
        <span class="text-xs text-gray-400">{{ $note->created_at->format('Y-m-d') }}</span>
        <div>
            {{$note->title}}
        </div>

        <div>
            <span class="text-red-800 font-bold"> الإجراء:</span>
            {{$note->action}}
        </div>

        <div class="mt-4 flex justify-around items-center w-52">
            <a href="{{ route('admin.student.note.edit',$note->id) }}">تعديل</a>
            <a href="{{ route('admin.student.note.delete',$note->id) }}">حذف</a>
        </div>
    </div>
    @endforeach





</x-app-layout>