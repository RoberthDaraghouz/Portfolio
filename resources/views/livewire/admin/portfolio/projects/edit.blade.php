<?php

use App\Livewire\Forms\ProjectForm;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use LivewireAlert, WithFileUploads;

    public Collection $categories;
    public ProjectForm $project;

    public function mount(): void {
        $this->getCategories();
    }

    #[On('category-created')]
    #[On('category-updated')]
    #[On('category-deleted')]
    public function getCategories(): void {
        $this->categories = Category::orderBy('name')->get();

        if ($this->categories->count()) {
            $this->project->category_id = $this->categories->first()->id;
            $this->resetErrorBag();
        }
    }

    #[On('edit-project')]
    public function edit($id): void {
        $this->getCategories();

        try {
            $response = Project::findOrFail($id);

            $this->project->setProject($response);
        } catch (\Throwable $th) {
            $this->alert('error', 'Project not found');
            $this->dispatch('project-updated');
        }
    }

    public function save(): void {
        $this->validate();

        try {
            $this->project->update();

            $this->alert('success', 'Project updated');
            $this->dispatch('notify', view: 'index');
        } catch (\Throwable $th) {
            $this->alert('error', 'Fail updated');
        }

        $this->dispatch('project-updated');
    }

    public function resetImage(): void {
        $this->project->reset('image_url');
    }

    public function resetOriginalImage(): void {
        $this->project->reset('image_on_update');
    }
}; ?>

<div>
    <div class="flex items-center justify-between px-4 sm:px-0">
        <h2 class="flex-1 text-xl text-gray-900">{{ __('Edit project') }}</h2>
        <x-buttons.back @click="view = 'index'">Back</x-buttons.back>
    </div>
    <div class="bg-white p-4 mt-2 rounded-lg shadow">
        <form wire:submit.prevent="save" class="space-y-4">
            @include('livewire.admin.portfolio.projects.partials.form')

            <div class="flex justify-between">
                <x-buttons.secondary @click="view = 'index'">Cancel</x-buttons.secondary>
                <x-buttons.primary type="submit">Update</x-buttons.primary>
            </div>
        </form>
    </div>
</div>