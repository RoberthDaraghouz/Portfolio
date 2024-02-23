<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Volt\Volt;
use Tests\TestCase;

class ProjectTest extends TestCase{
    use RefreshDatabase;

    public function test_project_pages_are_displayed(): void {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/portfolio');

        $response
            ->assertOk()
            ->assertSee('admin.portfolio.projects.index')
            ->assertSee('admin.portfolio.projects.create');
    }

    public function test_project_can_be_created_with_image(): void {
        $file = UploadedFile::fake()->image('image.png');

        $category = Category::factory()->create();

        $component = Volt::test('admin.portfolio.projects.create')
            ->set('project.name', 'Project test image')
            ->set('project.development_year', 2024)
            ->set('project.category_id', $category->id)
            ->set('project.project_type', 'test')
            ->set('project.production_link', 'https://test.com')
            ->set('project.preview_link', 'https://test.com')
            ->set('project.github_link', 'https://test.com')
            ->set('project.description', 'Description test')
            ->set('project.details', 'Details test')
            ->set('project.tools', 'Tools test')
            ->set('project.image_url', $file)
            ->call('save')
            ->assertHasNoErrors();

        $project = Project::where('name', 'Project test image')->first();

        Storage::assertExists($project->image_url);
    }

    public function test_project_can_be_created_with_only_name_and_category(): void {
        $category = Category::factory()->create();

        $component = Volt::test('admin.portfolio.projects.create')
            ->set('project.name', 'Project test to create')
            ->set('project.category_id', $category->id)
            ->call('save')
            ->assertHasNoErrors();

        $project = Project::where('name', 'Project test to create')
            ->first();
        
        $this->assertSame('Project test to create', $project->name);
    }

    public function test_project_cannot_be_created_empty(): void {
        $component = Volt::test('admin.portfolio.projects.create')
            ->set('project.name', '')
            ->call('save')
            ->assertHasErrors('project.name');
    }

    public function test_project_can_be_updated_with_image(): void {
        $file = UploadedFile::fake()->image('image.png');
        $category = Category::factory()->create();
        $project = Project::factory()->create();

        $component = Volt::test('admin.portfolio.projects.edit')
            ->call('edit', $project->id)
            ->set('project.name', 'Test project updated with image')
            ->set('project.development_year', '2024')
            ->set('project.image_url', $file)
            ->call('save');

        $project->refresh();

        $this->assertSame('Test project updated with image', $project->name);

        Storage::assertExists($project->image_url);
    }

    public function test_project_cannot_be_updated_without_name(): void {
        $category = Category::factory()->create();
        $project = Project::create([
            'name' => 'Test project cannot be updated',
            'category_id' => $category->id
        ]);

        $component = Volt::test('admin.portfolio.projects.edit')
            ->call('edit', $project->id)
            ->set('project.name', '')
            ->call('save')
            ->assertHasErrors('project.name');
        
        $project->refresh();

        $this->assertSame('Test project cannot be updated', $project->name);
    }

    public function test_project_can_be_deleted(): void {
        $category = Category::factory()->create();
        $project = Project::factory()->create();

        $component = Volt::test('admin.portfolio.projects.delete', ['project' => $project])
            ->call('destroy')
            ->assertHasNoErrors();
    }
}