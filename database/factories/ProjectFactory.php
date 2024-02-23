<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory{
    public function definition(): array {
        return [
            'name' => fake()->title(),
            'development_year' => fake()->date('Y'),
            'category_id' => 1,
            'project_type' => fake()->title(),
            'production_link' => fake()->url(),
            'preview_link' => fake()->url(),
            'github_link' => fake()->url(),
            'description' => fake()->paragraph(),
            'details' => fake()->paragraph(),
            'tools' => fake()->paragraph(),
            'image_url' => fake()->image(),
        ];
    }
}
