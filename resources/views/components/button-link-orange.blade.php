<a {{$attributes->merge(['class'=>'inline-flex items-center justify-center px-2 h-10 rounded border bg-orange !text-red-900 !border-red-800 hover:!bg-red-800 hover:!text-red-100 outline-0 disabled:opacity-25 transition ease-in-out duration-150'])}}>
    {{ $slot }}
</a>

