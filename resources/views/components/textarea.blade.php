@php
$classes = 'w-full border rounded outline-0 p-1 h-28';
@endphp
<textarea  {{ $attributes->merge(['class'=> $classes ]) }}></textarea>