<x-app-layout>
    <div class="py-5 text-2xl text-center text-red-700">
        إكتب عبارة في صفحة البداية
    </div>

    <form action="{{ route('admin.frontpage.store') }}" method="POST">
        @csrf

        <textarea name="content" class="w-full h-32 rounded">{!! $frontpage->content ?? '' !!}</textarea>
        <button class="mt-5 btn btn-outline-primary">حفظ</button>
    </form>

    <a class="py-6 block mt-4 text-center" target="_blank" href="https://richtexteditor.com/Demos/">format text</a>
</x-app-layout>