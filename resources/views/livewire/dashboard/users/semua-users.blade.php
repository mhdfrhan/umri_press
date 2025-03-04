<div class="p-6">
    @include('components.alert')

    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">Daftar Admin</h2>
        <x-primary-button wire:click="openCreateModal" class="!inline-flex items-center gap-2 !w-auto">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Tambah Admin
        </x-primary-button>
    </div>

    <!-- Search and Filter Section -->
    <div class="mb-6 bg-white dark:bg-neutral-800 rounded-xl shadow-sm p-4">
        <div class="flex flex-col md:flex-row gap-4 items-end">
            <div class="w-full md:flex-1">
                <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">
                    Cari Admin
                </label>
                <x-text-input type="text" wire:model.live.debounce.300ms="search" class="w-full"
                    placeholder="Cari berdasarkan nama atau email..." />
            </div>

            <div class="w-full md:w-48">
                <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">
                    Urutkan
                </label>
                <select wire:model.live="sortBy"
                    class="w-full rounded-lg border-neutral-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 focus:border-cgreen-500 focus:ring-cgreen-500">
                    <option value="newest">Terbaru</option>
                    <option value="oldest">Terlama</option>
                    <option value="name_asc">Nama A-Z</option>
                    <option value="name_desc">Nama Z-A</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                <thead class="bg-neutral-50 dark:bg-neutral-700">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-300 uppercase tracking-wider">
                            Nama
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-300 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-300 uppercase tracking-wider">
                            Bergabung Pada
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-300 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-neutral-800 divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse ($users as $user)
                        <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-700/50 transition-colors duration-200">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-neutral-900 dark:text-neutral-100">
                                    {{ $user->name }}
                                    @if ($user->email === 'umripres@umri.ac.id')
                                        <span
                                            class="ml-2 text-xs bg-cgreen-100 text-cgreen-800 px-2 py-0.5 rounded-full dark:bg-cgreen-800/20 dark:text-cgreen-400">
                                            Admin Utama
                                        </span>
                                    @endif
                                    @if ($user->id === Auth::id())
                                        <span
                                            class="ml-2 text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full dark:bg-green-800/20 dark:text-green-400">
                                            Anda
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-neutral-900 dark:text-neutral-100">
                                    {{ $user->email }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-neutral-500 dark:text-neutral-400">
                                    {{ $user->created_at->format('d M Y, H:i') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex space-x-3">
                                    <button wire:click="edit({{ $user->id }})"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                        Edit
                                    </button>
                                    @unless ($user->email === 'umripres@umri.ac.id' || $user->id === Auth::id())
                                        <button wire:click="confirmDelete({{ $user->id }})"
                                            class="text-cgreen-600 hover:text-cgreen-900 dark:text-cgreen-400 dark:hover:text-cgreen-300">
                                            Hapus
                                        </button>
                                    @endunless
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-neutral-500 dark:text-neutral-400">
                                Tidak ada admin yang tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-neutral-200 dark:border-neutral-700">
            {{ $users->links() }}
        </div>
    </div>

    <!-- User Form Modal -->
    <x-modal name="userModal" :show="false" maxWidth="md">
        <div class="p-6">
            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100 mb-4">
                {{ $userId ? 'Edit Admin' : 'Tambah Admin' }}
            </h2>

            <form wire:submit.prevent="save" class="space-y-4">
                <div>
                    <x-input-label>Nama</x-input-label>
                    <x-text-input type="text" wire:model="name" class="w-full mt-1" placeholder="Nama lengkap" />
                    @error('name')
                        <span class="text-cgreen-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <x-input-label>Email</x-input-label>
                    <x-text-input type="email" wire:model="email" class="w-full mt-1" placeholder="Email" autocomplete="email" />
                    @error('email')
                        <span class="text-cgreen-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <x-input-label>
                        Password
                        @if ($userId)
                            <span class="text-xs text-neutral-500">(Kosongkan jika tidak ingin mengubah password)</span>
                        @endif
                    </x-input-label>
                    <x-text-input type="password" wire:model="password" class="w-full mt-1"
                        autocomplete="new-password" />
                    @error('password')
                        <span class="text-cgreen-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <x-input-label>Konfirmasi Password</x-input-label>
                    <x-text-input type="password" wire:model="password_confirmation" class="w-full mt-1"
                        autocomplete="new-password" />
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <x-border-button type="button" x-on:click="$dispatch('close')" class="!w-auto">
                        Batal
                    </x-border-button>
                    <x-primary-button type="submit" class="!w-auto">
                        {{ $userId ? 'Simpan Perubahan' : 'Simpan' }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>

    <!-- Delete Confirmation Modal -->
    <x-modal name="confirmDelete" :show="false" maxWidth="md">
        <div class="p-6">
            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100 mb-4">
                Konfirmasi Hapus
            </h2>
            <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-4">
                Apakah Anda yakin ingin menghapus admin ini? Tindakan ini tidak dapat dibatalkan.
            </p>
            <div class="mt-6 flex justify-end gap-3">
                <x-border-button x-on:click="$dispatch('close')" class="!w-auto">
                    Batal
                </x-border-button>
                <x-primary-button wire:click="delete" class="!w-auto">
                    Hapus
                </x-primary-button>
            </div>
        </div>
    </x-modal>
</div>
