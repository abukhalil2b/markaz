@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'outline-0 rounded-md shadow-sm w-full h-10 border border-gray-300 focus:border-brownDark text-brownDark px-1']) !!}>
