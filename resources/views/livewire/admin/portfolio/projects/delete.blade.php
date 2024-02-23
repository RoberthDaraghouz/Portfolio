<?php

use App\Models\Project;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Volt\Component;

new class extends Component {
    use LivewireAlert;

    public Project $project;

    protected $listeners = ['destroy'];

    public function delete(): void {
        try {
            $this->confirm('Are you sure to delete? <br><span class="text-indigo-700">' . $this->project->name . '</span>', [
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
            if ($this->project->image_url) {
                if (Storage::exists($this->project->image_url)) {
                    Storage::delete($this->project->image_url);
                }
            }

            $this->project->delete();

            $this->alert('success', 'Project deleted');
            $this->dispatch('project-deleted');
        } catch (\Throwable $th) {
            $this->alert('error', 'Fail deleted');
        }
    }
}; ?>

<x-buttons.icon-delete wire:click="delete">Delete</x-buttons.icon-delete>