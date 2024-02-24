<?php

use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public int $total_messages;
    public array $perPages = [10, 25, 50, 100];

    public function mount(): void{
        $this->getTotalMessages();
    }

    #[On('message-deleted')]
    public function getTotalMessages(): void {
        $this->total_messages = Message::selectRaw('COUNT(*) AS total')->first()->total;
    }
}; ?>

<div>
    @if ($total_messages > $perPages[0])
        <div x-data="{ perPage: {{ $perPages[0] }} }" class="flex items-center space-x-2">
            <x-form.select x-model="perPage" x-on:change="$dispatch('pagination-updated', { value: perPage})" class="py-0 cursor-pointer">
                @foreach ($perPages as $item)
                    <option value="{{ $item }}">{{ $item }} per page</option>
                @endforeach
            </x-form.select>
        </div>
    @endif
</div>