<?php

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public Collection $projects;

    public function mount(): void {
        $this->getProjects();
    }

    #[On('project-created')]
    #[On('project-updated')]
    #[On('project-deleted')]
    #[On('category-updated')]
    public function getProjects(): void {
        $this->projects = Project::orderBy('name', 'ASC')->get();
    }
}; ?>

<div>
    <div class="flex items-center justify-between px-4 sm:px-0">
        <h2 class="flex-1 text-xl text-gray-900">{{ __('Projects') }}</h2>
        <x-buttons.new @click="view = 'create'">New project</x-buttons.new>
    </div>
    @if ($projects->count())
        <div class="grid sm:grid-cols-2 md:grid-cols-1 lg:grid-cols-2 gap-4 px-4 sm:px-0 py-2">
            @foreach ($projects as $project)
                <x-cards.project
                    :title="$project->name"
                    :category="$project->category->name"
                    :development_year="$project->development_year"
                    :description="$project->description"
                    :details="$project->details"
                    :tools="$project->tools"
                    :production_link="$project->production_link"
                    :preview_link="$project->preview_link"
                    :github_link="$project->github_link"
                    :image_url="$project->image_url"
                    >
                    <div class="flex">
                        <x-buttons.icon-edit @click="$dispatch('edit-project', { id: '{{ $project->id }}' })">Editar</x-buttons.icon-edit>
                        <livewire:admin.portfolio.projects.delete :$project wire:key="delete-project-{{$project->id}}" />
                    </div>
                </x-cards.project>
            @endforeach
        </div>
    @else
        <x-alerts.info class="mt-2 shadow">
            Sorry! Not found results.
        </x-alerts.info>
    @endif
</div>