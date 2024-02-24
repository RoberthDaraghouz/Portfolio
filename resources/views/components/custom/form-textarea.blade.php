@props([
    'name',
    'title',
])

<div class="space-y-1">
    <label for="{{ $name }}" class="text-zinc-300">{{ $title }}</label>
    {{ $slot }}
    <textarea {{ $attributes->merge([
        'id' => $name,
        'type' => 'text',
        'class' => 'w-full bg-white text-zinc-900 border-transparent focus:border-transparent focus:ring-transparent py-1 rounded-2xl',
    ]) }}></textarea>
    @error($name)
        <p class="text-red-700 text-sm">{{ $message }}</p>
    @enderror
</div>