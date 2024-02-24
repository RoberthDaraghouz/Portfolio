@props([
    'name',
    'title',
])

<div class="space-y-1">
    <label for="{{ $name }}" class="text-zinc-300">{{ $title }}</label>
    {{ $slot }}
    <input {{ $attributes->merge([
        'id' => $name,
        'type' => 'text',
        'class' => 'w-full bg-white text-zinc-900 border-white focus:border-sky-700 focus:ring-sky-700 py-1 rounded-full',
    ]) }}>
    @error($name)
        <p class="text-red-700 text-sm">{{ $message }}</p>
    @enderror
</div>