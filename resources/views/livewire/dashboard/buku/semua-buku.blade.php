<div class="p-6">
    @include('components.alert')

    <div class="flex flex-wrap justify-end mb-4 gap-3">
        <a href="{{ route('tempatSampah') }}" wire:navigate>
            <x-border-button class="!inline-flex items-center gap-2 !w-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>

                Tempat Sampah {{ $trashCount > 0 ? '(' . $trashCount . ')' : '' }}
            </x-border-button>
        </a>
        <a href="{{ route('tambahBuku') }}" wire:navigate>
            <x-primary-button class="!inline-flex items-center gap-2 !w-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                </svg>

                Tambah Buku
            </x-primary-button>
        </a>
    </div>
    <div class="mb-6 bg-white dark:bg-neutral-800 rounded-xl shadow-sm p-4">
        <div class="flex flex-col md:flex-row gap-4 items-end">
            <div class="w-full md:flex-1">
                <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">
                    Cari Buku
                </label>
                <x-text-input type="text" wire:model.live.debounce.300ms="search" class="w-full"
                    placeholder="Cari berdasarkan judul atau ISBN..." />
            </div>

            <div class="w-full md:w-48">
                <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">
                    Urutkan
                </label>
                <select wire:model.live="sortBy"
                    class="w-full rounded-lg border-neutral-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 focus:border-red-500 focus:ring-red-500">
                    <option value="newest">Terbaru</option>
                    <option value="oldest">Terlama</option>
                    <option value="title_asc">Judul A-Z</option>
                    <option value="title_desc">Judul Z-A</option>
                    <option value="price_low">Harga Terendah</option>
                    <option value="price_high">Harga Tertinggi</option>
                </select>
            </div>

            <div class="w-full md:w-48">
                <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">
                    Status
                </label>
                <select wire:model.live="status"
                    class="w-full rounded-lg border-neutral-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 focus:border-red-500 focus:ring-red-500">
                    <option value="">Semua Status</option>
                    <option value="active">Aktif</option>
                    <option value="inactive">Nonaktif</option>
                </select>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                <thead class="bg-neutral-50 dark:bg-neutral-700">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-300 uppercase tracking-wider">
                            Cover
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-300 uppercase tracking-wider">
                            Informasi Buku
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-300 uppercase tracking-wider">
                            Harga
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-300 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-300 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-neutral-800 divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse ($books as $book)
                        <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-700/50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="{{ asset($book->cover_thumbnail) }}" alt="{{ $book->title }}"
                                    class="w-16 h-24 object-cover rounded-lg shadow-sm">
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-neutral-900 dark:text-neutral-100">
                                    {{ $book->title }}
                                </div>
                                <div class="text-sm text-neutral-500 dark:text-neutral-400">
                                    ISBN: {{ $book->isbn }}
                                </div>
                                <div class="text-sm text-neutral-500 dark:text-neutral-400">
                                    {{ $book->jumlah_halaman }} Halaman
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-red-500 dark:text-red-400">
                                    Rp {{ number_format($book->harga, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button wire:click='changeStatus("{{ $book->slug }}")'
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $book->status === 1
                                        ? 'bg-green-100 text-green-800 dark:bg-green-800/20 dark:text-green-400'
                                        : 'bg-red-100 text-red-800 dark:bg-red-800/20 dark:text-red-400' }}">
                                    {{ $book->status === 1 ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex space-x-2">
                                    <a href="{{ route('editBuku', $book->slug) }}" wire:navigate>
                                        <button
                                            class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                            Edit
                                        </button>
                                    </a>
                                    <button wire:click="confirmDelete({{ $book->id }})"
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-neutral-500 dark:text-neutral-400">
                                Tidak ada data buku yang tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-neutral-200 dark:border-neutral-700">
            {{ $books->links() }}
        </div>
    </div>

    <x-modal name="confirmDelete" :show="false" maxWidth="md" align="center">
        <div class="p-6">
            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100 mb-4">
                Konfirmasi Hapus
            </h2>
            <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-4">
                Apakah Anda yakin ingin menghapus buku ini? Tindakan ini tidak dapat dibatalkan.
            </p>
            <div class="mt-6 flex justify-end space-x-3">
                <x-border-button class="!w-auto" x-on:click="$dispatch('close')">
                    Batal
                </x-border-button>
                <x-primary-button class="!w-auto" wire:click="delete" wire:loading.attr="disabled">
                    Hapus Buku
                </x-primary-button>
            </div>
        </div>
    </x-modal>
</div>
