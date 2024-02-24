<?php

use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;

new class extends Component {
    use LivewireAlert;

    #[Rule('required|string|max:30', as: 'category name')]
    public string $name;

    public function store(): void {
        $validated = $this->validate();

        try {
            Category::create($validated);

            $this->reset();
            $this->alert('success', 'Category created');
        } catch (\Throwable $th) {
            $this->alert('error', 'Fail created');
        }

        $this->dispatch('category-created');
    }
}; ?>

<form wire:submit.prevent="store">
    <div class="relative mt-2">
        <input wire:model="name"
            type="text"
            id="name"
            name="name"
            placeholder="New category"
            autocomplete="off"
            maxlength="30"
            class="block w-full placeholder:text-gray-500 rounded-full shadow sm:text-sm py-1.5 pr-16
            @error('name') border-red-300 focus:border-red-500 focus:ring-red-500
            @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500
            @enderror"
        >
        <div class="absolute inset-y-0 right-0 flex items-center">
            <button type="submit" class="flex items-center rounded pr-3 text-xs gap-1 font-semibold text-indigo-700 hover:text-indigo-500 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Add
            </button>
        </div>
    </div>
    <x-input-error class="mt-1" :messages="$errors->get('name')" />
</form>