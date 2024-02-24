<?php

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Volt\Component;

new class extends Component {
    public Collection $projects;

    public function mount(): void {
        $this->projects = Project::orderBy('development_year', 'DESC')->get();
    }
}; ?>

<section class="relative min-h-screen flex justify-center bg-sky-100 px-4 py-4">
    <div class="w-full md:max-w-5xl xl:max-w-7xl">
        <h1 class="text-7xl md:text-8xl md:text-center lg:text-left bg-clip-text text-transparent bg-gradient-to-r from-sky-400 to-25% to-sky-200">
            Portafolio
        </h1>

        @if ($projects->count())
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 py-6">
                @foreach ($projects as $project)
                <x-custom.card-project
                    :title="$project->name"
                    :project_type="$project->project_type"
                    :category="$project->category->name"
                    :year="$project->development_year"
                    :description="$project->description"
                    :details="$project->details"
                    :tools="$project->tools"
                    :production_link="$project->production_link"
                    :preview_link="$project->preview_link"
                    :github_link="$project->github_link"
                    :image_url="$project->image_url"
                />
                @endforeach
            </div>
        @else
            <p class="ml-2">No se encontró ningún proyecto.</p>
        @endif
    </div>
</section>