<nav x-data="{
    open: false,
    aboutDropdown: false,
    layananDropdown: false,
    scrolled: false,
    init() {
        window.addEventListener('scroll', () => {
            this.scrolled = window.pageYOffset > 20
        })
    }
}" :class="{
    'fixed top-0 px-8 mt-4': scrolled,
    'fixed top-0': !scrolled
}"
    class="w-full z-50 transition-all duration-500">
    <div :class="{
        'w-6xl mx-auto rounded-2xl bg-white/90 backdrop-blur border': scrolled,
        'rounded-none mx-auto bg-white w-full': !scrolled
    }"
        class=" transition-all duration-500">
        <div class=" max-w-7xl mx-auto px-4 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" wire:navigate>
                        <img class="h-12 w-auto" src="{{ asset('assets/img/logo.png') }}" alt="Logo">
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-0.5">
                    <a href="{{ route('home') }}" wire:navigate
                        class="text-neutral-700 hover:text-red-500 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 ease-in-out hover:bg-red-100 {{ request()->routeIs('home') ? 'font-semibold text-red-500' : '' }}">
                        Home
                    </a>

                    <!-- About Dropdown -->
                    <div class="relative" x-data="{ open: false }" @mouseover="open = true" @mouseleave="open = false">
                        <button
                            class="px-4 py-2 rounded-full text-sm transition-all duration-300 ease-in-out hover:bg-red-100 inline-flex items-center cursor-pointer {{ request()->is('tentang*') ? 'font-semibold text-red-500' : 'text-neutral-700 font-medium hover:text-red-500' }}">
                            <span>About</span>
                            <svg class="ml-1.5 h-4 w-4 transition-transform duration-200"
                                :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-56 rounded-xl shadow-xl bg-white ring-opacity-5 overflow-hidden">
                            <div class="py-1">
                                <a href="{{ route('team') }}" wire:navigate
                                    class="group flex items-center px-4 py-3 text-sm text-neutral-700 hover:bg-red-100 transition-all duration-300 {{ request()->routeIs('team') ? 'bg-red-50 text-red-500' : '' }}">
                                    <span
                                        class="w-2 h-2 rounded-full bg-red-500 opacity-0 group-hover:opacity-100 transition-all duration-300 mr-3 {{ request()->routeIs('team') ? 'opacity-100' : '' }}"></span>
                                    Tim
                                </a>
                                <a href="#"
                                    class="group flex items-center px-4 py-3 text-sm text-neutral-700 hover:bg-red-100 transition-all duration-300">
                                    <span
                                        class="w-2 h-2 rounded-full bg-red-500 opacity-0 group-hover:opacity-100 transition-all duration-300 mr-3"></span>
                                    Profil
                                </a>
                                <a href="#"
                                    class="group flex items-center px-4 py-3 text-sm text-neutral-700 hover:bg-red-100 transition-all duration-300">
                                    <span
                                        class="w-2 h-2 rounded-full bg-red-500 opacity-0 group-hover:opacity-100 transition-all duration-300 mr-3"></span>
                                    Testimonial
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="relative" x-data="{ open: false }" @mouseover="open = true" @mouseleave="open = false">
                        <button
                            class="px-4 py-2 rounded-full text-sm transition-all duration-300 ease-in-out hover:bg-red-100 inline-flex items-center cursor-pointer {{ request()->is('layanan*') ? 'font-semibold text-red-500' : 'text-neutral-700 font-medium hover:text-red-500' }}">
                            <span>Layanan</span>
                            <svg class="ml-1.5 h-4 w-4 transition-transform duration-200"
                                :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-64 rounded-xl shadow-xl bg-white ring-opacity-5 overflow-hidden">
                            <div class="py-1">
                                <a href="{{ route('daftarPenulis') }}" wire:navigate
                                    class="group flex items-center px-4 py-3 text-sm hover:bg-red-100 transition-all duration-300 {{ request()->routeIs('daftarPenulis') ? 'bg-red-50 text-red-500' : 'text-neutral-700' }}">
                                    <span
                                        class="w-2 h-2 rounded-full bg-red-500 opacity-0 group-hover:opacity-100 transition-all duration-300 mr-3 {{ request()->routeIs('daftarPenulis') ? 'opacity-100' : '' }}"></span>
                                    Daftar Menerbitkan Buku
                                </a>
                                <a href="#"
                                    class="group flex items-center px-4 py-3 text-sm text-neutral-700 hover:bg-red-100 transition-all duration-300">
                                    <span
                                        class="w-2 h-2 rounded-full bg-red-500 opacity-0 group-hover:opacity-100 transition-all duration-300 mr-3"></span>
                                    Penjelasan Layanan
                                </a>
                                <a href="{{ route('kirimNaskah') }}" wire:navigate
                                    class="group flex items-center px-4 py-3 text-sm hover:bg-red-100 transition-all duration-300 {{ request()->routeIs('kirimNaskah') ? 'bg-red-50 text-red-500' : 'text-neutral-700' }}">
                                    <span
                                        class="w-2 h-2 rounded-full bg-red-500 opacity-0 group-hover:opacity-100 transition-all duration-300 mr-3 {{ request()->routeIs('kirimNaskah') ? 'opacity-100' : '' }}"></span>
                                    Kirim Naskah
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('harga') }}" wire:navigate
                        class=" hover:text-red-500 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 ease-in-out hover:bg-red-100 {{ request()->routeIs('harga') ? 'font-semibold text-red-500' : 'text-neutral-700' }}">Harga</a>
                    <a href="{{ route('tokoBuku') }}" wire:navigate
                        class=" hover:text-red-500 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 ease-in-out hover:bg-red-100 {{ request()->routeIs('tokoBuku') ? 'font-semibold text-red-500' : 'text-neutral-700' }}">Toko
                        Buku</a>
                    <a href="#"
                        class="text-neutral-700 hover:text-red-500 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 ease-in-out hover:bg-red-100">Kontak</a>
                    <a href="#"
                        class="text-neutral-700 hover:text-red-500 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 ease-in-out hover:bg-red-100">Berita</a>
                </div>

                <!-- Login Button -->
                <div class="hidden lg:flex items-center ml-4">
                    <a href="">
                        <x-primary-button>Masuk/Login</x-primary-button>
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center lg:hidden">
                    <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-full text-neutral-700 hover:text-red-500 hover:bg-red-100 focus:outline-none transition-all duration-300">
                        <svg class="h-6 w-6" x-show="!open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg class="h-6 w-6" x-show="open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-1" class="lg:hidden bg-white/95 backdrop-blur">
            <div class="px-4 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" wire:navigate
                    class="block px-4 py-3 rounded-lg text-base font-medium text-neutral-700 hover:text-red-500 hover:bg-red-100 transition-all duration-300">Home</a>

                <!-- Mobile About Dropdown -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="w-full text-left px-4 py-3 rounded-lg text-base font-medium text-neutral-700 hover:text-red-500 hover:bg-red-100 transition-all duration-300 flex justify-between items-center">
                        <span>About</span>
                        <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="pl-4">
                        <a href="{{ route('team') }}"
                            class="block px-4 py-3 rounded-lg text-base font-medium text-neutral-700 hover:text-red-500 hover:bg-red-100 transition-all duration-300">Tim</a>
                        <a href="#"
                            class="block px-4 py-3 rounded-lg text-base font-medium text-neutral-700 hover:text-red-500 hover:bg-red-100 transition-all duration-300">Profil</a>
                        <a href="#"
                            class="block px-4 py-3 rounded-lg text-base font-medium text-neutral-700 hover:text-red-500 hover:bg-red-100 transition-all duration-300">Testimonial</a>
                    </div>
                </div>

                <!-- Mobile Layanan Dropdown -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="w-full text-left px-4 py-3 rounded-lg text-base font-medium text-neutral-700 hover:text-red-500 hover:bg-red-100 transition-all duration-300 flex justify-between items-center">
                        <span>Layanan</span>
                        <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="pl-4">
                        <a href="{{ route('daftarPenulis') }}" wire:navigate
                            class="block px-4 py-3 rounded-lg text-base font-medium text-neutral-700 hover:text-red-500 hover:bg-red-100 transition-all duration-300">Daftar
                            Menerbitkan Buku</a>
                        <a href="#"
                            class="block px-4 py-3 rounded-lg text-base font-medium text-neutral-700 hover:text-red-500 hover:bg-red-100 transition-all duration-300">Penjelasan
                            Layanan</a>
                        <a href="{{ route('kirimNaskah') }}" wire:navigate
                            class="block px-4 py-3 rounded-lg text-base font-medium text-neutral-700 hover:text-red-500 hover:bg-red-100 transition-all duration-300 {{ request()->routeIs('kirimNaskah') ? 'font-semibold text-red-500' : '' }}">Kirim
                            Naskah</a>
                    </div>
                </div>
                <a href="{{ route('harga') }}" wire:navigate
                    class="block px-4 py-3 rounded-lg text-base font-medium text-neutral-700 hover:text-red-500 hover:bg-red-100 transition-all duration-300">Harga</a>
                <a href="{{ route('tokoBuku') }}" wire:navigate
                    class="block px-4 py-3 rounded-lg text-base font-medium text-neutral-700 hover:text-red-500 hover:bg-red-100 transition-all duration-300">Toko
                    Buku</a>
                <a href="#"
                    class="block px-4 py-3 rounded-lg text-base font-medium text-neutral-700 hover:text-red-500 hover:bg-red-100 transition-all duration-300">Kontak</a>
                <a href="#"
                    class="block px-4 py-3 rounded-lg text-base font-medium text-neutral-700 hover:text-red-500 hover:bg-red-100 transition-all duration-300">Berita</a>

                <!-- Mobile Login Button -->
                <div class="mt-6 px-4 pb-4">
                    <a href="">
                        <x-primary-button>Masuk/Login</x-primary-button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
