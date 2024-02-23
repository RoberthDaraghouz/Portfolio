<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'inline-flex items-center gap-1 px-4 py-2 border border-gray-300 bg-white rounded-full text-xs uppercase font-semibold text-gray-900 tracking-widest hover:bg-gray-50 transition'
]) }}>
    {{ $slot }}
</button>