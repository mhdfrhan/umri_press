<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-neutral-900 font-sans text-neutral-900 antialiased">
    <div class="min-h-screen flex flex-col lg:flex-row">
        @if (request()->routeIs('login'))
            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 lg:p-16">
                <div class="w-full max-w-md">
                    <div class="text-center mb-8">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="{{ config('app.name') }}" class="h-14 mx-auto dark:hidden">
                            <img src="{{ asset('assets/img/logo-white.png') }}" alt="{{ config('app.name') }}" class="h-14 mx-auto hidden dark:block">
                        </a>
                        <h2 class="mt-6 text-3xl font-bold">Selamat Datang Kembali!</h2>
                        <p class="mt-2 text-neutral-600">Silahkan masuk untuk melanjutkan</p>
                    </div>

                    <div class="w-full bg-white dark:bg-neutral-800 p-8 rounded-lg shadow-sm">
                        {{ $slot }}
                    </div>
                </div>
            </div>

            <div class="hidden lg:block lg:w-1/2 bg-center bg-cover bg-no-repeat"
                style="background-image: url('https://images.unsplash.com/photo-1432821596592-e2c18b78144f?q=80');">
            </div>
        @else
            <div class="hidden lg:block lg:w-1/2 bg-center bg-cover bg-no-repeat"
                style="background-image: url('https://images.unsplash.com/photo-1497633762265-9d179a990aa6?q=80');">
            </div>

            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 lg:p-16">
                <div class="w-full max-w-md">
                    <div class="text-center mb-8">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="{{ config('app.name') }}" class="h-14 mx-auto dark:hidden">
                            <img src="{{ asset('assets/img/logo-white.png') }}" alt="{{ config('app.name') }}" class="h-14 mx-auto hidden dark:block">
                        </a>
                        <h2 class="mt-6 text-3xl font-bold">Selamat Datang di {{ config('app.name') }}</h2>
                        <p class="mt-2 text-neutral-600">Silahkan daftar untuk melanjutkan</p>
                    </div>

                    <div class="w-full bg-white p-8 rounded-lg shadow-sm">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</body>

</html>
