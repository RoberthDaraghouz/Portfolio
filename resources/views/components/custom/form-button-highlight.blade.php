<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'inline-flex items-center gap-1 px-8 py-3 bg-sky-500 text-xs uppercase font-semibold text-white rounded-full tracking-widest hover:bg-sky-700 transition'
]) }}>
    {{ $slot }}
</button>