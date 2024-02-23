<?php

use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Volt\Component;

new class extends Component {
    use LivewireAlert;

    public Category $category;

    protected $listeners = ['update'];

    public function edit(): void {
        try {
            $this->confirm('Edit category', [
                'icon' => false,
                'showConfirmButton' => true,
                'confirmButtonText' => 'Update',
                'onConfirmed' => 'update',
                'input' => 'text',
                'inputValue' => $this->category->name,
                'inputAttributes' => [
                    'maxlength' => '30'
                ],
                'inputValidator' => '(value) => {
                    if (!value) {
                        return "The field category is required";
                    }
                    if (value.length > 30) {
                        return "The category field must not be greater than 30 characters"
                    }
                }',
                'customClass' => [
                    'confirmButton' => 'bg-indigo-700 inline-flex items-center py-2 px-4 mr-2 text-xs font-semibold rounded-md border border-transparent text-white uppercase tracking-widest hover:bg-indigo-500 transition',
                    'cancelButton' => 'inline-flex items-center py-2 px-4 text-xs rounded-md border border-gray-300 font-semibold text-gray-700 uppercase tracking-widest bg-white hover:bg-gray-50 transition',
                    'input' => 'rounded-full',
                ],
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', 'Edit failed');
        }
    }

    public function update($value): void {
        if (strlen($value) > 0 && strlen($value) <= 30) {
            try {
                $this->category->update([
                    'name' => $value
                ]);

                $this->alert('success', 'Category updated');
            } catch (\Throwable $th) {
                $this->alert('error', 'Update failed');
            }
        } else {
            $this->alert('error', 'Update failed');
        }

        $this->dispatch('category-updated');
    }
}; ?>

<x-buttons.icon-edit wire:click="edit" />