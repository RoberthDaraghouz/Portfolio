<a {{ $attributes->merge([
    'class' => 'flex items-center justify-center gap-1 px-2 py-2 text-zinc-500 dark:bg-zinc-800 hover:bg-sky-500 dark:hover:bg-indigo-700 hover:text-white text-xs transition'
]) }}>
    {{ $slot }}
</a>