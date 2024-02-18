<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Portfolio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 md:grid md:grid-cols-3 gap-6">
            <div class="px-4 sm:px-0">
                <h2 class="text-xl text-gray-900 dark:text-white">{{ __('Categories') }}</h2>
                <livewire:admin.portfolio.categories.create />
                <livewire:admin.portfolio.categories.index />
                {{-- <livewire:admin.portfolio.categories.edit />
                <livewire:admin.portfolio.categories.delete /> --}}
            </div>
        </div>
    </div>
</x-app-layout>