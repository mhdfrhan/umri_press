<div class="max-w-4xl mx-auto p-6">
    @include('components.alert')

    <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">Edit Paket</h2>
            <a href="{{ route('semuaPaket') }}" wire:navigate>
                <x-border-button class="!inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                    Kembali
                </x-border-button>
            </a>
        </div>

        <form wire:submit.prevent="save" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <x-input-label>Nama Paket <span class="text-cgreen-500">*</span></x-input-label>
                    <x-text-input wire:model="nama" class="w-full mt-1" placeholder="Contoh: Paket 50 Eksemplar" />
                    @error('nama')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <x-input-label>Jumlah Eksemplar <span class="text-cgreen-500">*</span></x-input-label>
                    <x-text-input type="number" wire:model="jumlah_eksemplar" class="w-full mt-1" min="1" />
                    @error('jumlah_eksemplar')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <x-input-label>Harga (Rp) <span class="text-cgreen-500">*</span></x-input-label>
                    <x-text-input type="number" wire:model="harga" class="w-full mt-1" min="0" />
                    @error('harga')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div>
                <x-input-label>Fitur Paket <span class="text-cgreen-500">*</span></x-input-label>
                <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1 mb-2">
                    Tambahkan fitur-fitur yang termasuk dalam paket ini.
                </p>

                <div class="space-y-2">
                    @foreach($features as $index => $feature)
                        <div class="flex gap-2">
                            <x-text-input wire:model="features.{{ $index }}" class="w-full" 
                                placeholder="Masukkan fitur paket" />
                            <button type="button" wire:click="removeFeature({{ $index }})"
                                class="text-cgreen-500 hover:text-cgreen-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    @endforeach

                    @error('features')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button type="button" wire:click="addFeature"
                    class="mt-2 text-sm text-cgreen-600 hover:text-cgreen-700 dark:text-cgreen-400 dark:hover:text-cgreen-300">
                    + Tambah Fitur Baru
                </button>
            </div>

            <div class="flex flex-col gap-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" wire:model="recommended"
                        class="rounded border-neutral-300 text-cgreen-600 shadow-sm focus:border-cgreen-300 focus:ring focus:ring-cgreen-200 focus:ring-opacity-50">
                    <span class="ml-2">Set sebagai Paket Rekomendasi</span>
                </label>

                <label class="inline-flex items-center">
                    <input type="checkbox" wire:model="active"
                        class="rounded border-neutral-300 text-cgreen-600 shadow-sm focus:border-cgreen-300 focus:ring focus:ring-cgreen-200 focus:ring-opacity-50">
                    <span class="ml-2">Aktifkan Paket</span>
                </label>
            </div>

            <div class="flex justify-end">
                <x-primary-button type="submit">
                    Simpan Perubahan
                </x-primary-button>
            </div>
        </form>
    </div>
</div>