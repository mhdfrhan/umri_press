<div class="container mx-auto px-4 py-8">
    <div class="mb-8 bg-white dark:bg-neutral-800 rounded-xl shadow-sm p-4">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" wire:model.live.debounce.300ms="search"
                    class="w-full rounded-lg border-neutral-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 focus:border-cgreen-500 focus:ring-cgreen-500"
                    placeholder="Cari judul buku...">
            </div>

            <div class="w-full md:w-48">
                <select wire:model.live="sortBy"
                    class="w-full rounded-lg border-neutral-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 focus:border-cgreen-500 focus:ring-cgreen-500">
                    <option value="newest">Terbaru</option>
                    <option value="price_low">Harga Terendah</option>
                    <option value="price_high">Harga Tertinggi</option>
                    <option value="title_asc">A-Z</option>
                    <option value="title_desc">Z-A</option>
                </select>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-6">
        @forelse($books as $book)
            <div class="group">
                <div
                    class="relative bg-white dark:bg-neutral-800 rounded-xl overflow-hidden shadow-sm hover:shadow-xl dark:shadow-neutral-900 transition-all duration-300">
                    <div class="relative aspect-[2/3] overflow-hidden">
                        <img src="{{ asset($book->cover_thumbnail) }}" alt="{{ $book->judul }}"
                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300" loading="lazy">

                        <div
                            class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <a href="{{ route('detailBuku', $book->slug) }}" wire:navigate
                                class="bg-cgreen-500 hover:bg-cgreen-600 text-white px-4 py-2 rounded-full text-sm font-medium transform -translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                                Lihat Detail
                            </a>
                        </div>
                    </div>

                    <div class="p-4">
                        <h3
                            class="font-semibold text-neutral-800 dark:text-neutral-200 line-clamp-2 group-hover:text-cgreen-500 transition-colors duration-200 capitalize">
                            {{ $book->judul }}
                        </h3>
                        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">
                            {{ $book->jumlah_halaman }} Halaman
                        </p>
                        <div class="mt-2 flex justify-between items-center">
                            <span class="text-lg font-semibold text-cgreen-500">
                                Rp. {{ number_format($book->harga, 0, ',', '.') }}
                            </span>
                            @if ($book->marketplace_links && $book->marketplace_links !== '[]')
                                <button wire:click="showMarketplaces('{{ $book->slug }}')"
                                    class="text-sm text-neutral-600 dark:text-neutral-400 hover:text-cgreen-500 dark:hover:text-cgreen-400">
                                    Beli
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <div class="text-neutral-500 dark:text-neutral-400">
                    <svg class="mx-auto h-12 w-12 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <p>Belum ada buku yang tersedia</p>
                </div>
            </div>
        @endforelse
    </div>

    @if ($books->hasPages())
        <div class="mt-8">
            {{ $books->links() }}
        </div>
    @endif


    <x-modal name="marketplacesModal" :show="false" maxWidth="md">
        <div class="p-6">
            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100 mb-4">
                Beli "{{ $selectedBook?->judul }}"
            </h2>

            @if ($marketplaceLinks)
                <div class="space-y-4">
                    @foreach ($marketplaceLinks as $marketplace => $link)
                        <a href="{{ $link }}" target="_blank" rel="noopener noreferrer"
                            class="flex items-center justify-between p-4 rounded-lg border border-neutral-200 dark:border-neutral-700 hover:border-cgreen-500 dark:hover:border-cgreen-500 transition-colors duration-200">
                            <div class="flex items-center gap-3">
                                <span class="text-lg capitalize">{{ $marketplace }}</span>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-neutral-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endforeach
                </div>
                <div class="mt-4 text-sm text-neutral-500 dark:text-neutral-400">
                    Klik link untuk membuka di tab baru
                </div>
            @else
                <div class="text-center text-neutral-500 dark:text-neutral-400">
                    Tidak ada link marketplace yang tersedia
                </div>
            @endif

            <div class="mt-6 flex justify-end">
                <x-primary-button x-on:click="$dispatch('close')" class="!w-auto">
                    Tutup
                </x-primary-button>
            </div>
        </div>
    </x-modal>
</div>
