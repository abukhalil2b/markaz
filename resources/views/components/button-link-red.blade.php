<a {{$attributes->merge(['class'=>'inline-flex items-center justify-center px-2 h-10 rounded border  !text-red-600 !border-red-600 hover:bg-red-100 outline-0 disabled:opacity-25 transition ease-in-out duration-150'])}}>
    {{ $slot }}
</a>
