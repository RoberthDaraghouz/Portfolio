<?php

use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

new class extends Component {
    use WithoutUrlPagination, WithPagination, LivewireAlert;

    public int $perPage = 10;

    #[On('message-deleted')]
    public function with(): array {
        return [
            'messages' =>Message::latest()->paginate($this->perPage)
        ];
    }

    #[On('message-deleted')]
    public function paginationReset(): void {
        $this->resetPage();
    }

    #[On('pagination-updated')]
    public function paginationUpdated($value){
        $this->perPage = $value;
    }
}; ?>

<div>
    @if ($messages->count())
        <ul role="list" class="divide-y">
            @foreach ($messages as $message)
                <li wire:key="{{ $message->id }}" class="flex items-start justify-between lg:px-2 py-2">
                    <div class="w-10">
                        <livewire:admin.dashboard.messages.status wire:key="status-{{ $message->id }}" :$message />
                    </div>
                    <div class="flex-1 space-y-1">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:space-x-2">
                            <h4 class="text-indigo-700 dark:text-white text-sm font-semibold">{{ $message->name }}</h4>
                            <span class="flex items-center text-zinc-500 text-xs font-medium">
                                <span class="hidden lg:inline-flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                                        <path fill-rule="evenodd" d="M3.22 7.595a.75.75 0 0 0 0 1.06l3.25 3.25a.75.75 0 0 0 1.06-1.06l-2.72-2.72 2.72-2.72a.75.75 0 0 0-1.06-1.06l-3.25 3.25Zm8.25-3.25-3.25 3.25a.75.75 0 0 0 0 1.06l3.25 3.25a.75.75 0 1 0 1.06-1.06l-2.72-2.72 2.72-2.72a.75.75 0 0 0-1.06-1.06Z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                 {{ $message->email }}
                                <span class="hidden lg:inline-flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                                    <path fill-rule="evenodd" d="M12.78 7.595a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06l2.72-2.72-2.72-2.72a.75.75 0 0 1 1.06-1.06l3.25 3.25Zm-8.25-3.25 3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06l2.72-2.72-2.72-2.72a.75.75 0 0 1 1.06-1.06Z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </span>
                            <span class="text-xs text-zinc-500">{{ $message->created_at->format('h:i a d/m/Y') }}</span>
                        </div>
                        <p class="text-zinc-700 dark:text-zinc-500 text-sm">{{ $message->message }}</p>
                    </div>
                    <livewire:admin.dashboard.messages.delete wire:key="delete-{{ $message->id }}" :$message />
                </li>
            @endforeach
        </ul>
        <div class="mt-4">
            {{ $messages->links() }}
        </div>
    @else
        <x-alerts.info>
            Not found messages yet.
        </x-alerts.info>
    @endif
</div>