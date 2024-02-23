<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->year('development_year')->nullable();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('project_type', 50)->nullable();
            $table->string('production_link', 255)->nullable();
            $table->string('preview_link', 255)->nullable();
            $table->string('github_link', 255)->nullable();
            $table->text('description', 500)->nullable();
            $table->text('details', 500)->nullable();
            $table->text('tools', 500)->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('projects');
    }
};
