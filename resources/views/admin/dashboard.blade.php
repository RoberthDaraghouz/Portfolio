<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-panels.section>
                <x-slot:title>
                    <div class="flex items-center justify-between">
                        <div class="flex gap-1">
                            Messages
                            <livewire:admin.dashboard.messages.unread-messages />
                        </div>
                        <livewire:admin.dashboard.messages.select-pagination />
                    </div>
                </x-slot:title>

                <x-slot:header>
                    {{ __('Check your messages from visitors and possible customers.') }}
                </x-slot:header>

                <livewire:admin.dashboard.messages.index />

            </x-panels.section>
        </div>
    </div>
</x-app-layout>
