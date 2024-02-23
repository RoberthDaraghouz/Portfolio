<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'inline-flex items-center gap-1 px-4 py-2 bg-indigo-700 rounded-full text-xs uppercase font-semibold text-white tracking-widest hover:bg-indigo-500 transition'
]) }}>
    {{ $slot }}
</button>