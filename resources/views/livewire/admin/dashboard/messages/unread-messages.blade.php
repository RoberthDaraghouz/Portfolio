<?php

use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public int $total_unread_messages;

    public function mount(): void {
        $this->getTotalUnreadMessages();
    }

    #[On('status-update')]
    #[On('message-deleted')]
    public function getTotalUnreadMessages(): void {
        $this->total_unread_messages = Message::selectRaw('COUNT(*) AS total')->where('status', 'unread')->first()->total;
    }
}; ?>

<div>
    @if ($total_unread_messages)
        <x-badges.info>
                <span class="font-bold mr-1">{{ $total_unread_messages }}</span>
                {{ ($total_unread_messages == 1) ? ' mensaje' : ' mensajes' }}
                sin leer
        </x-badges.info>
    @endif
</div>