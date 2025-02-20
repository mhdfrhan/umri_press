<aside class="w-[20rem] h-svh bg-cneutral1 hidden xl:block fixed top-0 left-0 bottom-0 z-50 dark:bg-neutral-950">
    <!-- Logo -->
    <div class="shrink-0 flex items-center p-5 pb-0">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="flex items-center justify-between w-full border p-3 border-neutral-300 dark:border-neutral-900 rounded-lg bg-white dark:bg-neutral-900 cursor-pointer">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('assets/img/favicon.png') }}" class="h-12"
                            alt="{{ config('app.name', 'Laravel') }} Logo">
                        <div>
                            <h5 class="font-semibold line-clamp-2 capitalize leading-none text-left">Halo,
                                {{ auth()->user()->name }}
                            </h5>
                            <p class="text-sm text-neutral-500">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <div>
                        <svg class="size-5 text-neutral-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none" />
                            <polyline points="80 176 128 224 176 176" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            <polyline points="80 80 128 32 176 80" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-dropdown-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-dropdown-link>
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </button>
            </x-slot>
        </x-dropdown>
    </div>

    <div class="h-[calc(100vh-5rem)] overflow-y-auto">
        <ul class="flex flex-col p-5 pt-2 space-y-1.5">

            <li>
                <x-nav-link class="inline-flex gap-3 text-sm" :href="route('home')">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    {{ __('Kembali ke beranda') }}
                </x-nav-link>
            </li>

            <div class="text-neutral-400 pt-4 uppercase text-sm font-medium dark:text-neutral-600">
                <p>Main menu</p>
            </div>

            <li>
                <x-nav-link class="inline-flex gap-3" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                    </svg>

                    {{ __('Dashboard') }}
                </x-nav-link>
            </li>
            <li>
                <x-nav-dropdown title="Data Buku" routePattern="dashboard/buku*" :active="request()->is('dashboard/buku*')"
                    icon='<svg class="size-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M48,216a24,24,0,0,1,24-24H208V32H72A24,24,0,0,0,48,56Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="48 216 48 224 192 224" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>'>

                    <ul>
                        <li class="px-1 py-0.5 first:mt-2">
                            <a href="{{ route('semuaBuku') }}" wire:navigate
                                class="flex items-center rounded-lg gap-2 px-4 py-1.5 focus:outline-none font-medium border duration-150 {{ request()->routeIs('semuaBuku') ? 'border-neutral-300 text-neutral-800 dark:text-neutral-200 dark:border-neutral-800' : 'border-transparent hover:border-neutral-300 text-neutral-600 hover:text-neutral-800 dark:hover:border-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-200' }}">
                                Semua Buku
                            </a>
                        </li>
                        <li class="px-1 py-0.5 first:mt-2">
                            <a href="{{ route('tambahBuku') }}" wire:navigate
                                class="flex items-center rounded-lg gap-2 px-4 py-1.5 focus:outline-none font-medium border duration-150 {{ request()->routeIs('tambahBuku') ? 'border-neutral-300 text-neutral-800 dark:text-neutral-200 dark:border-neutral-800' : 'border-transparent hover:border-neutral-300 text-neutral-600 hover:text-neutral-800 dark:hover:border-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-200' }}">
                                Tambah Buku
                            </a>
                        </li>
                    </ul>

                </x-nav-dropdown>
            </li>

            <li>
                <x-nav-link class="inline-flex gap-3" :href="route('semuaArtikel')" :active="request()->routeIs('semuaArtikel')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                    </svg>

                    {{ __('Artikel') }}
                </x-nav-link>
            </li>

            <li>
                <x-nav-link class="inline-flex gap-3" :href="route('semuaArtikel')" :active="request()->routeIs('semuaArtikel')">
                    <svg class="size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <path d="M192,120a59.91,59.91,0,0,1,48,24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path d="M16,144a59.91,59.91,0,0,1,48-24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <circle cx="128" cy="144" r="40" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path d="M72,216a65,65,0,0,1,112,0" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path d="M161,80a32,32,0,1,1,31,40" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path d="M64,120A32,32,0,1,1,95,80" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    </svg>

                    {{ __('Users') }}
                </x-nav-link>
            </li>

            <div class="text-neutral-400 pt-4 uppercase text-sm font-medium dark:text-neutral-600">
                <p>Pengaturan</p>
            </div>

            <li>
                <x-nav-link class="inline-flex gap-3" :href="route('semuaArtikel')" :active="request()->routeIs('semuaArtikel')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    {{ __('Pengaturan Web') }}
                </x-nav-link>
            </li>
        </ul>
    </div>
</aside>
