<?php

namespace App\Livewire\Forms;

use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Livewire\Form;

class ProjectForm extends Form {
    public ?Project $project;

    #[Rule('required|max:100')]
    public string $name = '';

    #[Rule('nullable')]
    public ?int $development_year = null;

    #[Rule('required', as: 'category')]
    public int $category_id;

    #[Rule('max:50|nullable')]
    public string $project_type = '';

    #[Rule('max:255|nullable')]
    public string $production_link = '';

    #[Rule('max:255|nullable')]
    public string $preview_link = '';

    #[Rule('max:255|nullable')]
    public string $github_link = '';

    #[Rule('string|max:500|nullable')]
    public string $description = '';

    #[Rule('string|max:500|nullable')]
    public string $details = '';

    #[Rule('string|max:500|nullable')]
    public string $tools = '';

    #[Rule('image|max:1024|nullable')]
    public $image_url;

    public $image_on_update;

    public function setProject(Project $project): void {
        $this->project = $project;
        $this->name = $project->name;
        $this->development_year = $project->development_year;
        $this->category_id = $project->category_id;
        $this->project_type = $project->project_type;
        $this->production_link = $project->production_link;
        $this->preview_link = $project->preview_link;
        $this->github_link = $project->github_link;
        $this->description = $project->description;
        $this->details = $project->details;
        $this->tools = $project->tools;
        $this->image_url = null;
        $this->image_on_update = $project->image_url;
    }

    public function store(): void {
        if ($this->image_url) {
            $this->image_url = $this->image_url->store('img/project-images');
        }

        Project::create($this->all());

        $this->resetFields();
    }

    public function update(): void {
        if ($this->image_url) {
            $this->image_url = $this->image_url->store('img/project-images');

            if ($this->project->image_url) {
                $this->deleteImage();
            }
        } else {
            $this->image_url = $this->image_on_update;
        }

        if ($this->image_on_update != $this->project->image_url) {
            $this->deleteImage();
        }

        $this->project->update($this->all());
        $this->project = null;
        $this->resetFields();
    }

    public function deleteImage(): void {
        if (Storage::exists($this->project->image_url)) {
            Storage::delete($this->project->image_url);
        }
    }

    public function resetFields(): void {
        $this->reset(
            'name',
            'development_year',
            'project_type',
            'production_link',
            'preview_link',
            'github_link',
            'description',
            'details',
            'tools',
            'image_url',
            'image_on_update',
        );
    }
}