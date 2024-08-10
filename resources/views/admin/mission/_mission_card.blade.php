<div class="block p-1 border rounded  {{ $mission->status == 'active' ? 'bg-white' : 'bg-gray-100 opacity-60' }}">
    {{ $mission->title}}
    <div class="text-xs text-gray-400">
        {{ $mission->note }}
    </div>

    <div class="mt-2 border p-1 rounded text-xs">
        <span>أدوات إنشاء الخطة</span>
        <div class="flex gap-3">

            <a href="{{ route('admin.mission.task.one_surat',$mission->id) }}" class="text-red-800 ">
                سورة كاملة
            </a>

            <a href="{{ route('admin.mission.task.surat_to_surat',$mission->id) }}" class="text-red-800">
                من سورة إلى سورة
            </a>

            <a href="{{ route('admin.mission.task.aya_to_aya',$mission->id) }}" class="text-red-800">
                من آية إلى آية
            </a>

            <a href="{{ route('admin.mission.task.free_text',$mission->id) }}" class="text-red-800">
                نص حر
            </a>

        </div>
    </div>

    <a href="{{ route('admin.mission.order_edit',$mission->id) }}" class="text-red-800 text-xs">
        تعديل الترتيب 1
    </a>
    <a href="{{ route('admin.mission.reorder',$mission->id) }}" class="text-red-800 text-xs">
        تعديل الترتيب 2
    </a>
    <a href="{{ route('admin.mission.print',$mission->id) }}" class="mr-3 text-gray-800 text-xs">
        طباعة الخطة
    </a>
</div>