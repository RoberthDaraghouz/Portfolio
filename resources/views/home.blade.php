<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="shortcut icon" type="image/png" href="{{ asset('icon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <svg xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1"
            stroke="currentColor"
            class="w-96 h-96 fixed invisible lg:visible -left-12 stroke-sky-950/30"
            >
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5-3.9 19.5m-2.1-19.5-3.9 19.5" />
        </svg>
        <div class="right-10 top-6 bg-zinc-800 p-8 fixed rotate-12 rounded-xl shadow-xl transition"></div>
        <div class="right-40 top-24 bg-zinc-800 p-16 fixed rotate-45 rounded-2xl shadow-xl transition"></div>
        <div class="right-16 top-72 bg-zinc-800 p-40 fixed -rotate-12 rounded-3xl shadow-xl transition"></div>

        <livewire:pages.home.portfolio />
        <livewire:pages.home.contact />
        <footer class="relative bg-zinc-950 z-10">
            <section class="py-20"></section>
        </footer>
    </body>
</html>
