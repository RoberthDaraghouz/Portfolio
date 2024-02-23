@props(['value'])

<label {{ $attributes->merge(['class' => 'text-gray-700 text-sm font-semibold']) }}>
    {{ $value ?? $slot }}
</label>