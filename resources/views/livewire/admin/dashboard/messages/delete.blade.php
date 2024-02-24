<?php

use App\Models\Message;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Volt\Component;

new class extends Component {
    use LivewireAlert;

    public Message $message;

    protected $listeners = ['destroy'];

    public function delete(): void {
        try {
            $this->confirm('Are you sure to delete? <br><span class="text-indigo-700">' . $this->message->name . '</span>', [
                'confirmButtonText' => 'Delete',
                'onConfirmed' => 'destroy',
                'cancelButtonText' => 'Cancel',
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', 'Deleted failed');
        }
    }

    public function destroy(): void {
        $this->message->delete();

        $this->alert('success', 'Message deleted');
        $this->dispatch('message-deleted');
    }
}; ?>

<x-buttons.icon-delete wire:click="delete" />