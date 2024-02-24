<section {{ $attributes->merge([
    'class' => 'bg-white p-4 sm:p-8 shadow sm:rounded-xl'
]) }}>
    <h2 class="text-lg font-medium text-gray-900">{{ $title ?? 'Untitled'}}</h2>
    <p class="mt-1 text-sm text-gray-700">
        {{ $header }}
    </p>
    <div class="mt-5">
        {{ $slot }}
    </div>
</section>