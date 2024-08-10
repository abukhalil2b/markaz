@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-block border !border-gray-200 rounded w-auto p-1 m-1 text-gray-300 hover:text-red-600 focus:text-black transition duration-150 ease-in-out'
            : 'inline-block border !border-[#7f5418] rounded w-auto p-1 m-1 text-[#7f5418] hover:text-red-600 focus:text-black transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
