<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'inline-flex items-center gap-1 px-4 py-1 bg-gray-200 rounded-full text-xs text-gray-900 tracking-wider hover:bg-gray-500 hover:text-white transition'
]) }}>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3 h-3">
  <path fill-rule="evenodd" d="M14 8a.75.75 0 0 1-.75.75H4.56l3.22 3.22a.75.75 0 1 1-1.06 1.06l-4.5-4.5a.75.75 0 0 1 0-1.06l4.5-4.5a.75.75 0 0 1 1.06 1.06L4.56 7.25h8.69A.75.75 0 0 1 14 8Z" clip-rule="evenodd" />
</svg>
    {{ $slot }}
</button>