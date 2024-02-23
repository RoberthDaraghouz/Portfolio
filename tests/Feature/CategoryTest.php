<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class CategoryTest extends TestCase{
    use RefreshDatabase;

    public function test_category_pages_are_displayed(): void {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/portfolio');

        $response
            ->assertOk()
            ->assertSee('admin.portfolio.categories.index')
            ->assertSee('admin.portfolio.categories.create');
    }

    public function test_categories_can_be_showed(): void {
        $category = Category::factory()->create();

        Volt::test('admin.portfolio.categories.index')
            ->assertSee($category->name);
    }

    public function test_category_can_be_created(): void {
        $component = Volt::test('admin.portfolio.categories.create')
            ->set('name', 'Test category created')
            ->call('store')
            ->assertHasNoErrors();

        $category = Category::where('name', 'Test category created')->first();

        $this->assertSame('Test category created', $category->name);
    }

    public function test_category_cannot_be_created_empty(): void {
        $component = Volt::test('admin.portfolio.categories.create')
            ->set('name', '')
            ->call('store')
            ->assertHasErrors('name');
    }

    public function test_category_cannot_be_created_longer_than_30_characteres(): void {
        $component = Volt::test('admin.portfolio.categories.create')
            ->set('name', 'This is a text that contains 43 characteres')
            ->call('store')
            ->assertHasErrors('name');
    }

    public function test_category_can_be_updated(): void {
        $category = Category::create([
            'name' => 'Test category to update',
        ]);

        $component = Volt::test('admin.portfolio.categories.edit', ['category' => $category])
            ->call('update', 'Category updated')
            ->assertHasNoErrors();

        $category->refresh();

        $this->assertSame('Category updated', $category->name);
    }

    public function test_category_cannot_be_updated_empty(): void {
        $category = Category::create([
            'name' => 'Test category no empty',
        ]);

        $component = Volt::test('admin.portfolio.categories.edit', ['category' => $category])
            ->call('update', '');

        $category->refresh();

        $this->assertSame('Test category no empty', $category->name);
    }

    public function test_category_cannot_be_updated_longer_than_30_characteres(): void {
        $category = Category::create([
            'name' => 'Test category shorter than 30',
        ]);

        $component = Volt::test('admin.portfolio.categories.edit', ['category' => $category])
            ->call('update', 'This is a text that contains 43 characteres');

        $category->refresh();

        $this->assertSame('Test category shorter than 30', $category->name);
    }

    public function test_category_can_be_deleted(): void {
        $category = Category::create([
            'name' => 'Category to delete'
        ]);

        $component = Volt::test('admin.portfolio.categories.delete', ['category' => $category])
            ->call('destroy')
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('categories', $category->toArray());
    }
}