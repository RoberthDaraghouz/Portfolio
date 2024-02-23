@props([
    'title' => 'Not found',
    'category' => '',
    'year' => '',
    'project_type' => '',
    'production_link' => '',
    'preview_link' => '',
    'github_link' => '',
    'description' => '',
    'details' => '',
    'tools' => '',
    'image_url' => '',
])

<article class="flex flex-col rounded-xl shadow hover:shadow-lg overflow-hidden transition">
    <div>
        @if ($image_url)
            @if (Storage::exists($image_url))
                <img src="{{ asset('storage/' . $image_url) }}" alt="Cover" class="h-36 w-full object-cover object-center">
            @else
                <img src="https://ui-avatars.com/api/?name={{ str_replace(' ', '+', $title) }}&background=4338ca&color=ffffff" alt="Cover" class="h-36 w-full object-cover object-center">
            @endif
        @else
            <img src="https://ui-avatars.com/api/?name={{ str_replace(' ', '+', $title) }}&background=4338ca&color=ffffff" alt="Cover" class="h-36 w-full object-cover object-center">
        @endif
    </div>
    <div class="flex-1 flex flex-col bg-white">
        <div class="flex-1 p-4">
            <h2 class="text-gray-900 text-lg font-semibold">{{ $title }}</h2>
            <h3 class="text-indigo-700 text-sm font-semibold">
                {{ $category }}
                @if ($project_type)
                    <span class="text-gray-500 text-xs font-normal">· {{ $project_type }}</span>
                @endif
                @if ($year)
                    <span class="text-gray-500 text-xs font-semibold">· {{ $year }}</span>
                @endif
            </h3>
            <div class="text-gray-600 text-sm pt-4 space-y-2">
                @if ($description)
                    <p>{{ $description }}</p>
                @endif
                @if ($details)
                    <p class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                        </svg>
                        {{ $details }}
                    </p>
                @endif
                @if ($tools)
                    <p class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m6.75 7.5 3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0 0 21 18V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v12a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        {{ $tools }}
                    </p>
                @endif
            </div>
            {{ $slot }}
        </div>
        <div class="grid grid-flow-col justify-stretch divide-x divide-gray-300">
            @if ($production_link)
                <x-cards.footer-button href="{{ $production_link }}" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                    </svg>
                    Online
                </x-cards.footer-button>
            @endif
            @if ($preview_link)
                <x-cards.footer-button href="{{ $preview_link }}" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                    </svg>
                    Preview
                </x-cards.footer-button>
            @endif
            @if ($github_link)
                <x-cards.footer-button href="{{ $github_link }}" target="_blank" class="group">
                    <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 fill-gray-500 group-hover:fill-white">
                        <title>GitHub</title>
                        <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/>
                    </svg>
                    Github
                </x-cards.footer-button>
            @endif
        </div>
    </div>
</article>