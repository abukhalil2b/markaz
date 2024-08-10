<x-student.layout>
    <div class="p-3">

        <div class="p-3">
            <span class="student-number">{{$student->id}}</span> {{$student->full_name}}
        </div>

        <div class="p-3">

            <div class="border border-gray-500 rounded p-1 w-full bg-gray-50">
                <h4>إجراء المعلم</h4>

                <div class="mt-2 {{ $w1 ? 'bg-brownLight border border-brown p-1' : 'bg-white border border-brown p-1' }}">

                <div>
                إشعار رقم 1
                </div>

                    @if($w1)
                    <div>
                       <div>
                       {{$w1->description}}
                       </div>
                        <div class="text-xs text-black">
                        {{$w1->created_at->diffForHumans()}}
                        </div>
                    </div>
                    @endif
                </div>
                <div class="mt-2 {{ $w2 ? 'bg-brownLight border border-brown p-1' : 'bg-white border border-brown p-1'  }}">
                    <div>
                        إشعار رقم 2
                    </div>
                   
                    @if($w2)
                    <div>
                       <div>
                       {{$w2->description}}
                       </div>
                        <div class="text-xs text-black">
                        {{$w2->created_at->diffForHumans()}}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="mt-4 border border-gray-500 rounded p-1 w-full bg-gray-50">
                <h4>
                    إجراء الإدارة
                </h4>


                <div class="mt-2 {{ $w3 ? 'bg-brownLight border border-brown p-1' : 'bg-white border border-brown p-1' }}">
                    <div>
                        تنبيه رقم 1
                    </div>
                    
                    @if($w3)
                    <div>
                       <div>
                       {{$w3->description}}
                       </div>
                        <div class="text-xs text-black">
                        {{$w3->created_at->diffForHumans()}}
                        </div>
                    </div>
                    @endif

                </div>

                <div class="mt-2 {{$w4 ? 'bg-brownLight border border-brown p-1' : 'bg-white border border-brown p-1' }}">
                    <div>
                        تنبيه رقم 2
                    </div>
                    
                    @if($w4)
                    <div>
                       <div>
                       {{$w4->description}}
                       </div>
                        <div class="text-xs text-black">
                        {{$w4->created_at->diffForHumans()}}
                        </div>
                    </div>
                    @endif

                </div>

                <div class="mt-2 {{ $w5 ? 'bg-brownLight border border-brown p-1' : 'bg-white border border-brown p-1' }}">
                    <div>
                        استدعاء ولي أمر الطالب
                    </div>
                   
                    @if($w5)
                    <div>
                       <div>
                       {{$w5->description}}
                       </div>
                        <div class="text-xs text-black">
                        {{$w5->created_at->diffForHumans()}}
                        </div>
                    </div>
                    @endif

                </div>

                <div class="mt-2 {{ $w6 ? 'bg-brownLight border border-brown p-1' : 'bg-white border border-brown p-1' }}">
                    <div>
                        فصل من المؤسسة
                    </div>
                    
                    @if($w6)
                    <div>
                       <div>
                       {{$w6->description}}
                       </div>
                        <div class="text-xs text-black">
                        {{$w6->created_at->diffForHumans()}}
                        </div>
                    </div>
                    @endif

                </div>
            </div>

        </div>
</x-student>