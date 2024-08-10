@props(['storednotes'])

<div x-data="{note:'',cssClass:'hidden',
    addNote(storednote){
        return this.note + ' ' + storednote;
    }
}" class="mt-3">

    @php

    $loggedUser = auth()->user();
    
    $storednotes = App\Models\Storednote::where('gender',$loggedUser->gender)
    ->join('users','storednotes.user_id','users.id')
    ->get();

    @endphp

    <span class="text-red-700">الملحوظة </span>
    <textarea x-model="note" {{ $attributes->merge(['name'=>'note','class'=>'w-full border rounded outline-0 p-1 h-28']) }}></textarea>
    <div @click="cssClass='flex'" class="font-bold py-1 cursor-pointer hover:opacity-70">عبارات الشكر</div>
    <div class="flex-row gap-2 flex-wrap mt-1" :class="cssClass">
        @foreach($storednotes as $storednote)
        <div class="btn-add-note" x-on:click="note = addNote('{{ $storednote->content }}')">{{ $storednote->content }}</div>
        @endforeach
        <div class="btn-add-note" x-on:click="note=''">مسح</div>
    </div>
</div>