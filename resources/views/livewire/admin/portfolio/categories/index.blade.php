<?php

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public Collection $categories;
    
    public function mount(): void {
        $this->getCategories();
    }

    #[On('category-created')]
    #[On('category-updated')]
    #[On('category-deleted')]
    public function getCategories(): void {
        $this->categories = Category::orderBy('name', 'ASC')->get();
    }
}; ?>

<div class="mt-4">
    @if ($categories->count())
        <ul role="list" class="bg-white divide-y rounded-lg shadow">
            @foreach ($categories as $category)
                <li wire:key="{{ $category->id }}" class="flex items-center justify-between px-4 py-2 text-sm text-gray-900">
                    <div class="flex-1">
                        {{ $category->name }}
                    </div>
                    <div class="flex items-center">
                        <livewire:admin.portfolio.categories.delete :$category wire:key="delete-{{ $category->id }}" />
                        <livewire:admin.portfolio.categories.edit :category="$category" wire:key="edit-{{ $category->id }}" />
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
