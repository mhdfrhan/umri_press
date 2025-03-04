<x-app-layout>
    <div class="p-6">
        <div class="mb-8">
            <h2 class="font-semibold text-2xl text-neutral-900 dark:text-neutral-100">Dashboard</h2>
            <p class="text-neutral-600 dark:text-neutral-400">Selamat datang di halaman dashboard {{ config('app.name') }}</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Buku -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-neutral-500 dark:text-neutral-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div class="bg-cgreen-100 dark:bg-cgreen-900/20 text-cgreen-600 dark:text-cgreen-400 text-xs font-medium px-2.5 py-0.5 rounded-full">
                        Total Buku
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <h3 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">{{ $totalBuku }}</h3>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">Buku</p>
                </div>
            </div>

            <!-- Total Artikel -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-neutral-500 dark:text-neutral-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <div class="bg-cgreen-100 dark:bg-cgreen-900/20 text-cgreen-600 dark:text-cgreen-400 text-xs font-medium px-2.5 py-0.5 rounded-full">
                        Total Artikel
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <h3 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">{{ $totalArtikel }}</h3>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">Artikel</p>
                </div>
            </div>

            <!-- Total Paket -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-neutral-500 dark:text-neutral-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div class="bg-cgreen-100 dark:bg-cgreen-900/20 text-cgreen-600 dark:text-cgreen-400 text-xs font-medium px-2.5 py-0.5 rounded-full">
                        Total Paket
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <h3 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">{{ $totalPaket }}</h3>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">Paket</p>
                </div>
            </div>

            <!-- Total Tim -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-neutral-500 dark:text-neutral-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="bg-cgreen-100 dark:bg-cgreen-900/20 text-cgreen-600 dark:text-cgreen-400 text-xs font-medium px-2.5 py-0.5 rounded-full">
                        Total Tim
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <h3 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">{{ $totalTim }}</h3>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">Anggota</p>
                </div>
            </div>
        </div>

        <!-- Recent Items Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Books -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm">
                <div class="p-6 border-b border-neutral-200 dark:border-neutral-700">
                    <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">Buku Terbaru</h3>
                </div>
                <div class="p-6">
                    @if($recentBooks->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentBooks as $book)
                                <div class="flex items-center gap-4">
                                    <img src="{{ asset($book->thumbnail) }}" alt="{{ $book->judul }}" 
                                        class="w-12 h-16 object-cover rounded-lg">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-neutral-900 dark:text-neutral-100 truncate">
                                            {{ $book->judul }}
                                        </p>
                                        <p class="text-sm text-neutral-500 dark:text-neutral-400">
                                            {{ $book->penulis }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-neutral-500 dark:text-neutral-400 text-sm">Belum ada buku yang ditambahkan</p>
                    @endif
                </div>
            </div>

            <!-- Recent Articles -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm">
                <div class="p-6 border-b border-neutral-200 dark:border-neutral-700">
                    <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">Artikel Terbaru</h3>
                </div>
                <div class="p-6">
                    @if($recentArticles->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentArticles as $article)
                                <div class="flex items-center gap-4">
                                    <img src="{{ asset($article->gambar) }}" alt="{{ $article->judul }}" 
                                        class="w-16 h-12 object-cover rounded-lg">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-neutral-900 dark:text-neutral-100 truncate">
                                            {{ $article->judul }}
                                        </p>
                                        <p class="text-sm text-neutral-500 dark:text-neutral-400">
                                            {{ $article->created_at->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-neutral-500 dark:text-neutral-400 text-sm">Belum ada artikel yang ditambahkan</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>