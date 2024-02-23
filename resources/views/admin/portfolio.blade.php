<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Portfolio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid md:grid-cols-3 gap-4">
            <div class="px-4 sm:px-0">
                <h2 class="text-xl text-gray-900 dark:text-white">{{ __('Categories') }}</h2>
                <livewire:admin.portfolio.categories.create />
                <livewire:admin.portfolio.categories.index />
            </div>
            <div x-data="{ view: 'index' }" @notify="view = $event.detail.view" class="md:col-span-2">
                <div x-show="view == 'index'">
                    <livewire:admin.portfolio.projects.index />
                </div>
                <div x-cloak x-show="view == 'create'">
                    <livewire:admin.portfolio.projects.create wire:key="project_create" />
                </div>
                <div x-cloak x-show="view == 'edit'" x-on:edit-project.window="view = 'edit'">
                    <livewire:admin.portfolio.projects.edit />
                </div>
                {{-- <livewire:portfolio.projects.delete /> --}}
            </div>
        </div>
    </div>
</x-app-layout>