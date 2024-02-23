<div class="grid {{ $categories->count() ? 'sm:grid-cols-3 md:grid-cols-1 lg:grid-cols-3' : '' }} gap-4">
    <div class="{{ $categories->count() ? 'sm:col-span-2 md:col-span-1 lg:col-span-2' : '' }}">
        <x-form.label for="name" value="{{ __('Name') }}" />
        <x-form.input wire:model="project.name" id="name" name="name" autofocus autocomplete="name" />
        @error('project.name') <x-form.error :$message /> @enderror
    </div>
    <div>
        @if ($categories->count())
            <x-form.label for="category-id" value="{{ __('Category') }}" />
            <x-form.select wire:model="project.category_id" id="category-id" name="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </x-form.select>
        @else
            <x-alerts.warning>
                Add a category to save this new project.
                @error('project.category_id') <x-form.error :$message /> @enderror
            </x-alerts.warning>
        @endif
    </div>
</div>

<div class="grid sm:grid-cols-3 md:grid-cols-1 lg:grid-cols-3 gap-4">
    <div class="sm:col-span-2 md:col-span-1 lg:col-span-2">
        <x-form.label for="project-type" value="{{ __('Project type') }}" />
        <x-form.input wire:model="project.project_type" id="project-type" name="project_type" autocomplete="project-type" />
        @error('project.project_type') <x-form.error :$message /> @enderror
    </div>
    <div>
        <x-form.label for="development-year" value="{{ __('Development year') }}" />
        <x-form.input x-mask="9999" wire:model="project.development_year" id="development-year" name="development_year" type="number" placeholder="{{ date('Y') }}" autocomplete="development-year" class="text-center" />
        @error('project.development_year') <x-form.error :$message /> @enderror
    </div>
</div>

<div>
    <x-form.label for="description" :value="__('Description')" />
    <x-form.textarea wire:model="project.description" id="description" name="description" rows="6" />
    @error('project.description') <x-form.error :$message /> @enderror
</div>

<div>
    <x-form.label for="details" :value="__('Details')" />
    <x-form.textarea wire:model="project.details" id="details" name="details" rows="4" />
    @error('project.details') <x-form.error :$message /> @enderror
</div>

<div class="grid sm:grid-cols-2 gap-4">
    <div>
        <x-form.label for="tools" :value="__('Tools')" />
        <x-form.textarea wire:model="project.tools" id="tools" name="tools" rows="6" />
        @error('project.tools') <x-form.error :$message /> @enderror
    </div>
    <div>
        <div>
            <x-form.label for="production-link" :value="__('Production Link')" />
            <x-form.input wire:model="project.production_link" id="production-link" name="production_link" type="url" autocomplete="production-link" />
            @error('project.production_link') <x-form.error :$message /> @enderror
        </div>

        <div>
            <x-form.label for="preview-link" :value="__('Preview Link')" />
            <x-form.input wire:model="project.preview_link" id="preview-link" name="preview_link" type="url" autocomplete="preview-link" />
            @error('project.preview_link') <x-form.error :$message /> @enderror
        </div>

        <div>
            <x-form.label for="github-link" :value="__('Github Link')" />
            <x-form.input wire:model="project.github_link" id="github-link" name="github_link" type="url" autocomplete="github-link" />
            @error('project.github_link') <x-form.error :$message /> @enderror
        </div>
    </div>
</div>

<div
    x-data="{ uploading: false, progress: 0 }"
    x-on:livewire-upload-start="uploading = true"
    x-on:livewire-upload-finish="uploading = false"
    x-on:livewire-upload-error="uploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress"
>
    <x-form.label for="image-url" :value="__('Image')" />

    {{-- Preview --}}
    @if ($project->image_url)
        <img src="{{ $project->image_url->temporaryUrl() }}" alt="Image preview" class="mt-1">
        <x-buttons.secondary wire:click="resetImage" class="my-2">Quit image</x-buttons.secondary>
    @elseif($project->image_on_update)
        @if (Storage::exists($project->image_on_update))
            <a href="{{ asset('storage/' . $project->image_on_update) }}" target="_blank" class="mt-1">
                <img src="{{ asset('storage/' . $project->image_on_update) }}" alt="Preview image" class="rounded-md">
            </a>
        @else
            <x-alerts.info class="mt-2">Sorry, image not found, upload a new one!</x-alerts.info>
        @endif
        <div>
            <x-buttons.secondary wire:click="resetOriginalImage" class="my-2">Quit actual image</x-buttons.secondary>
        </div>
    @endif

    <x-form.input-file wire:model="project.image_url" id="image-url" name="image_url" accept="image/*" />


    {{-- Progress Bar --}}
    <div x-show="uploading">
        <progress max="100" x-bind:value="progress"></progress>
    </div>

    @error('project.image_url') <x-form.error :$message /> @enderror
</div>