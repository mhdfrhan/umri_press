<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' | ' : '' }} {{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased bg-white dark:bg-neutral-950">

    @include('home.partials.navbar')

    <button id="backToTopBtn"
        class="fixed bottom-6 right-6 p-3 rounded-full bg-red-600 text-white shadow-lg opacity-0 invisible transition-all duration-300 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 transform hover:scale-110 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
        <span class="sr-only">Back to top</span>
    </button>


    <main class="{{ !request()->routeIs('home') ? 'lg:mt-20' : '' }}">
        @if (!request()->routeIs('home'))
            <x-breadcrumb />
        @endif

        {{ $slot }}
    </main>


    @include('home.partials.footer')

    <script></script>

    @stack('scripts')
    @livewireScripts
</body>

</html>
