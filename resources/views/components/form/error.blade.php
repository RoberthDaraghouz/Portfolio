@props(['message'])

<p {{ $attributes->merge([
    'class' => 'text-red-700 text-sm'
]) }}>
    {{ $message ?? $slot }}
</p>