<button {{$attributes->merge(['class'=>'inline-flex items-center justify-center px-2 h-10 rounded border  !text-gray-600 !border-gray-600 hover:bg-gray-200 outline-0 disabled:opacity-25 transition ease-in-out duration-150'])}}>
    {{ $slot }}
</button>
