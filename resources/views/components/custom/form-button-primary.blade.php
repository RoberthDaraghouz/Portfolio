<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'inline-flex items-center gap-1 px-8 py-3 bg-zinc-600/50 text-xs uppercase font-semibold text-white rounded-full tracking-widest hover:bg-zinc-950 transition'
]) }}>
    {{ $slot }}
</button>