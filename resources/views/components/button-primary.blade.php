<button {{$attributes->merge(['class'=>'inline-flex items-center justify-center h-10 rounded border !text-brownDark !border-brownDark hover:border-brownDark hover:bg-orangeLight hover:text-brownDark focus:outline-none disabled:opacity-25 transition ease-in-out duration-150'])}}>
    {{ $slot }}
</button>
