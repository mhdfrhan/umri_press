<div class="p-6">
    @include('components.alert')

    <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100 mb-4">Tempat Sampah</h2>
    <div class="flex flex-wrap justify-between items-center mb-6">
        <a href="{{ route('semuaBuku') }}" wire:navigate>
            <x-border-button class="!inline-flex items-center gap-2 !w-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
                Kembali
            </x-border-button>
        </a>
        <div class="flex gap-3">
            @if ($trashedBooks->isNotEmpty())
                <x-border-button wire:click="confirmRestoreAll" wire:loading.attr="disabled"
                    class="!inline-flex items-center gap-2 !w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
                      </svg>
                      
                    Pulihkan Semua
                </x-border-button>

                <x-primary-button wire:click="confirmForceDeleteAll" wire:loading.attr="disabled"
                    class="!inline-flex items-center gap-2 !w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                    Hapus Semua Permanen
                </x-primary-button>
            @endif
        </div>
    </div>

    <!-- Search and Filter Section -->
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
                    <option value="newest">Terbaru Dihapus</option>
                    <option value="oldest">Terlama Dihapus</option>
                    <option value="title_asc">Judul A-Z</option>
                    <option value="title_desc">Judul Z-A</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Books Table -->
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
                            Tanggal Dihapus
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-300 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-neutral-800 divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse ($trashedBooks as $book)
                        <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-700/50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="{{ asset($book->cover_thumbnail) }}" alt="{{ $book->judul }}"
                                    class="w-16 h-24 object-cover rounded-lg shadow-sm">
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-neutral-900 dark:text-neutral-100">
                                    {{ $book->judul }}
                                </div>
                                <div class="text-sm text-neutral-500 dark:text-neutral-400">
                                    ISBN: {{ $book->isbn }}
                                </div>
                                <div class="text-sm text-neutral-500 dark:text-neutral-400">
                                    {{ $book->jumlah_halaman }} Halaman
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-neutral-500 dark:text-neutral-400">
                                    {{ $book->deleted_at->diffForHumans() }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex space-x-2">
                                    <button wire:click="confirmRestore({{ $book->id }})"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                        Pulihkan
                                    </button>
                                    <button wire:click="confirmForceDelete({{ $book->id }})"
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                        Hapus Permanen
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-neutral-500 dark:text-neutral-400">
                                Tidak ada buku yang dihapus
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-neutral-200 dark:border-neutral-700">
            {{ $trashedBooks->links() }}
        </div>
    </div>

    <!-- Restore Confirmation Modal -->
    <x-modal name="confirmRestore" :show="false" align="center" maxWidth="md">
        <div class="p-6">
            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100 mb-4">
                Konfirmasi Pemulihan
            </h2>
            <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-4">
                Apakah Anda yakin ingin memulihkan buku ini?
            </p>
            <div class="mt-6 flex justify-end space-x-3">
                <x-border-button class="!w-auto" x-on:click="$dispatch('close')">
                    Batal
                </x-border-button>
                <x-primary-button class="!w-auto" wire:click="restore" wire:loading.attr="disabled">
                    Pulihkan
                </x-primary-button>
            </div>
        </div>
    </x-modal>

    <!-- Force Delete Confirmation Modal -->
    <x-modal name="confirmForceDelete" :show="false" align="center" maxWidth="md">
        <div class="p-6">
            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100 mb-4">
                Konfirmasi Hapus Permanen
            </h2>
            <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-4">
                Apakah Anda yakin ingin menghapus buku ini secara permanen? Tindakan ini tidak dapat dibatalkan.
            </p>
            <div class="mt-6 flex justify-end space-x-3">
                <x-border-button class="!w-auto" x-on:click="$dispatch('close')">
                    Batal
                </x-border-button>
                <x-primary-button class="!w-auto" wire:click="forceDelete" wire:loading.attr="disabled">
                    Hapus Permanen
                </x-primary-button>
            </div>
        </div>
    </x-modal>

    <!-- Restore All Confirmation Modal -->
    <x-modal name="confirmRestoreAll" :show="false" align="center" maxWidth="md">
        <div class="p-6">
            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100 mb-4">
                Konfirmasi Pemulihan Semua
            </h2>
            <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-4">
                Apakah Anda yakin ingin memulihkan semua buku yang ada di tempat sampah?
            </p>
            <div class="mt-6 flex justify-end space-x-3">
                <x-border-button class="!w-auto" x-on:click="$dispatch('close')">
                    Batal
                </x-border-button>
                <x-primary-button class="!w-auto" wire:click="restoreAll" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="restoreAll">Pulihkan Semua</span>
                    <span wire:loading wire:target="restoreAll">Memulihkan...</span>
                </x-primary-button>
            </div>
        </div>
    </x-modal>

    <!-- Force Delete All Confirmation Modal -->
    <x-modal name="confirmForceDeleteAll" :show="false" align="center" maxWidth="md">
        <div class="p-6">
            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100 mb-4">
                Konfirmasi Hapus Semua Permanen
            </h2>
            <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-4">
                Apakah Anda yakin ingin menghapus semua buku secara permanen? Tindakan ini tidak dapat dibatalkan.
            </p>
            <div class="mt-6 flex justify-end space-x-3">
                <x-border-button class="!w-auto" x-on:click="$dispatch('close')">
                    Batal
                </x-border-button>
                <x-primary-button class="!w-auto" wire:click="forceDeleteAll" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="forceDeleteAll">Hapus Semua</span>
                    <span wire:loading wire:target="forceDeleteAll">Menghapus...</span>
                </x-primary-button>
            </div>
        </div>
    </x-modal>
</div>
