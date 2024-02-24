<?php

use App\Models\Message;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Volt\Component;

new class extends Component {
    use LivewireAlert;

    public Message $message;

    public function changeStatus(): void {
        try {
            if ($this->message->status == 'read') {
                $status = 'unread';
            } else {
                $status = 'read';
            }

            $this->message->update([
                'status' => $status
            ]);

            $this->alert('success', 'Status updated');
            $this->dispatch('status-update');
        } catch (\Throwable $th) {
            $this->alert('error', 'Fail status update');
        }
    }
}; ?>

<button wire:click="changeStatus">
    @if ($message->status == 'read')
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor"
            class="w-8 h-8 stroke-green-700 hover:bg-green-100 p-1 rounded transition">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
    @else
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor"
            class="w-8 h-8 stroke-indigo-700 hover:bg-indigo-100 p-1 rounded transition">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
        </svg>
    @endif
</button>