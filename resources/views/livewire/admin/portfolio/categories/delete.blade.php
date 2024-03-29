<?php

use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Volt\Component;

new class extends Component {
    use LivewireAlert;

    public Category $category;

    protected $listeners = ['destroy'];

    public function delete(): void {
        try {
            $this->confirm('Are you sure to delete? <br><span class="text-indigo-700">' . $this->category->name . '</span>', [
                'confirmButtonText' => 'Delete',
                'onConfirmed' => 'destroy',
                'cancelButtonText' => 'Cancel',
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', 'Fail deleted');
        }
    }

    public function destroy(): void {
        try {
            $this->category->delete();

            $this->alert('success', 'Category deleted');
            $this->dispatch('category-deleted');
        } catch (\Throwable $th) {
            $this->alert('error', 'Fail deleted');
        }
    }
}; ?>

<x-buttons.icon-delete wire:click="delete" />