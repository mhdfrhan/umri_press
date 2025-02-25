<div class="max-w-4xl mx-auto p-6">
    @include('components.alert')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/cropper.css') }}">
        <script src="{{ asset('js/cropper.min.js') }}"></script>
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    @endpush

    <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">Edit Buku</h2>
            <a href="{{ route('semuaBuku') }}" wire:navigate>
                <x-border-button class="!inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                    Kembali
                </x-border-button>
            </a>
        </div>

        <form wire:submit.prevent="save" class="space-y-6">
            <!-- Cover Image Upload -->
            <div>
                <x-input-label class="block mb-2">
                    Cover Buku (Ukuran yang disarankan: 600x900px)
                </x-input-label>
                <div
                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-neutral-300 dark:border-neutral-700 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                        <div class="preview-container mx-auto">
                            @if ($tempImage || $existingCover)
                                <img src="{{ $tempImage ? $tempImage : asset($existingCover) }}"
                                    class="w-full h-full object-cover max-w-60 mx-auto" id="previewImage">
                            @else
                                <svg class="mx-auto h-12 w-12 text-neutral-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            @endif
                        </div>
                        <div class="flex text-sm text-neutral-600 dark:text-neutral-400 justify-center">
                            <x-input-label
                                class="relative cursor-pointer rounded-md font-medium text-red-600 hover:text-red-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-red-500">
                                <span>Upload file</span>
                                <input type="file" wire:model="newCover" class="sr-only" accept="image/*"
                                    id="coverInput" onchange="openCropper(event)">
                            </x-input-label>
                        </div>
                        <p class="text-xs text-neutral-500">PNG, JPG up to 2MB</p>
                    </div>
                </div>
                @error('newCover')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Judul -->
            <div>
                <x-input-label class="block mb-2">Judul</x-input-label>
                <x-text-input type="text" wire:model.live="judul" class="w-full block" placeholder="Judul buku" />
                @error('judul')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Slug -->
            <div>
                <x-input-label class="block mb-2">Slug</x-input-label>
                <x-text-input type="text" wire:model="slug" class="w-full block bg-neutral-100 dark:bg-neutral-800"
                    readonly />
                @error('slug')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <x-input-label class="block mb-2">Deskripsi</x-input-label>
                <div wire:ignore>
                    <div id="deskripsi" class="h-72 bg-white dark:bg-neutral-800"></div>
                </div>
                @error('deskripsi')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Sinopsis -->
            <div>
                <x-input-label class="block mb-2">Sinopsis</x-input-label>
                <div wire:ignore>
                    <div id="sinopsis" class="h-72 bg-white dark:bg-neutral-800"></div>
                </div>
                @error('sinopsis')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- ISBN -->
            <div>
                <x-input-label class="block mb-2">ISBN</x-input-label>
                <x-text-input type="text" wire:model="isbn" class="w-full block" placeholder="978-0-123456-47-2" />
                @error('isbn')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Harga -->
            <div>
                <x-input-label class="block mb-2">Harga</x-input-label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-neutral-500 sm:text-sm">Rp</span>
                    </div>
                    <x-text-input type="number" wire:model="harga" class="w-full pl-12 block" placeholder="0" />
                </div>
                @error('harga')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Jumlah Halaman -->
            <div>
                <x-input-label class="block mb-2">Jumlah Halaman</x-input-label>
                <x-text-input type="number" wire:model="jumlah_halaman" class="w-full block" placeholder="100" />
                @error('jumlah_halaman')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tanggal Terbit -->
            <div>
                <x-input-label class="block mb-2">Tanggal Terbit</x-input-label>
                <x-text-input type="date" wire:model="tanggal_terbit" class="w-full block" />
                @error('tanggal_terbit')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Marketplace Links -->
            <div class="space-y-4">
                <h3 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">Link Marketplace</h3>
                <p class="text-sm text-neutral-500 dark:text-neutral-400">Minimal pilih 1 marketplace</p>

                @foreach (['shopee', 'tokopedia', 'bukalapak', 'lazada'] as $marketplace)
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" wire:model.live="marketplaces.{{ $marketplace }}.active"
                                class="rounded border-neutral-300 text-red-500 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                            <span
                                class="ml-2 text-neutral-700 dark:text-neutral-300 capitalize">{{ $marketplace }}</span>
                        </label>
                        @if ($marketplaces[$marketplace]['active'])
                            <div>
                                <x-text-input type="url" wire:model="marketplaces.{{ $marketplace }}.link"
                                    class="w-full block"
                                    placeholder="https://{{ $marketplace }}.co.id/product/..." />
                                @error("marketplaces.{$marketplace}.link")
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Status -->
            <div>
                <label class="inline-flex items-center">
                    <input type="checkbox" wire:model="status"
                        class="rounded border-neutral-300 text-red-500 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                    <span class="ml-2 text-neutral-700 dark:text-neutral-300">Aktif</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <x-primary-button type="submit">
                    Simpan Perubahan
                </x-primary-button>
            </div>
        </form>
    </div>

    <!-- Cropper Modal -->
    <x-modal name="cropperModal" :show="false" maxWidth="xl">
        <div class="p-6">
            <div class="mb-4">
                <img id="cropImage" src="" alt="Gambar untuk dipotong">
            </div>
            <div class="flex justify-end gap-3">
                <x-border-button @click="$dispatch('close')" class="!w-auto">
                    Batal
                </x-border-button>
                <x-primary-button @click="cropImage()" class="!w-auto">
                    Crop & Save
                </x-primary-button>
            </div>
        </div>
    </x-modal>
</div>

@push('scripts')
    <script>
        // Definisikan namespace global untuk menghindari deklarasi ulang variabel
        window.ImageCropperManager = {
            cropper: null,
            originalFile: null,

            initCropper() {
                const image = document.getElementById('cropImage');
                if (!image) return;

                this.cropper = new Cropper(image, {
                    aspectRatio: 2 / 3,
                    viewMode: 2,
                    dragMode: 'move',
                    autoCropArea: 1,
                    restore: false,
                    guides: true,
                    center: true,
                    highlight: false,
                    cropBoxMovable: true,
                    cropBoxResizable: true,
                    toggleDragModeOnDblclick: false,
                });
            },

            cleanup() {
                if (this.cropper) {
                    this.cropper.destroy();
                    this.cropper = null;
                }
            }
        };

        // Fungsi global yang dapat diakses dari HTML
        window.openCropper = (event) => {
            window.ImageCropperManager.originalFile = event.target.files[0];
            if (!window.ImageCropperManager.originalFile) return;

            const reader = new FileReader();
            reader.onload = (e) => {
                const image = document.getElementById('cropImage');
                image.src = e.target.result;

                window.ImageCropperManager.cleanup();

                window.dispatchEvent(new CustomEvent('open-modal', {
                    detail: 'cropperModal'
                }));
                setTimeout(() => window.ImageCropperManager.initCropper(), 200);
            };
            reader.readAsDataURL(window.ImageCropperManager.originalFile);
        };

        window.cropImage = () => {
            if (!window.ImageCropperManager.cropper) return;

            // Generate thumbnail (300x450)
            const thumbnailCanvas = window.ImageCropperManager.cropper.getCroppedCanvas({
                width: 300,
                height: 450,
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high',
            });

            // Generate full size (600x900)
            const fullSizeCanvas = window.ImageCropperManager.cropper.getCroppedCanvas({
                width: 600,
                height: 900,
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high',
            });

            Promise.all([
                new Promise(resolve => {
                    thumbnailCanvas.toBlob(blob => {
                        resolve(new File([blob], 'thumbnail.jpg', {
                            type: 'image/jpeg'
                        }));
                    }, 'image/jpeg', 0.7);
                }),
                new Promise(resolve => {
                    fullSizeCanvas.toBlob(blob => {
                        resolve(new File([blob], 'cover.jpg', {
                            type: 'image/jpeg'
                        }));
                    }, 'image/jpeg', 0.9);
                })
            ]).then(([thumbnailFile, fullSizeFile]) => {
                @this.upload('thumbnail', thumbnailFile, () => {
                    @this.upload('newCover', fullSizeFile, () => {
                        window.dispatchEvent(new CustomEvent('close-modal', {
                            detail: 'cropperModal'
                        }));
                        window.ImageCropperManager.cleanup();
                    });
                });
            });
        };

        // Namespace untuk Editor
        window.EditorManager = {
            editors: {},

            init() {
                if (typeof Quill === 'undefined') {
                    setTimeout(() => this.init(), 100);
                    return;
                }

                const options = {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote', 'code-block'],
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }],
                            [{
                                'header': [1, 2, 3, 4, 5, 6, false]
                            }],
                            [{
                                'color': []
                            }, {
                                'background': []
                            }],
                            ['clean']
                        ]
                    },
                    placeholder: 'Tulis konten disini...'
                };

                // Periksa apakah elemen ada dan belum diinisialisasi
                const deskripsiEl = document.getElementById('deskripsi');
                const sinopsisEl = document.getElementById('sinopsis');

                if (deskripsiEl && !deskripsiEl.querySelector('.ql-editor')) {
                    this.editors.deskripsi = new Quill('#deskripsi', options);
                    this.editors.deskripsi.on('text-change', () => {
                        @this.set('deskripsi', this.editors.deskripsi.root.innerHTML);
                    });
                    // Set initial content
                    if (@this.deskripsi) this.editors.deskripsi.root.innerHTML = @this.deskripsi;
                }

                if (sinopsisEl && !sinopsisEl.querySelector('.ql-editor')) {
                    this.editors.sinopsis = new Quill('#sinopsis', options);
                    this.editors.sinopsis.on('text-change', () => {
                        @this.set('sinopsis', this.editors.sinopsis.root.innerHTML);
                    });
                    // Set initial content
                    if (@this.sinopsis) this.editors.sinopsis.root.innerHTML = @this.sinopsis;
                }
            },

            cleanup() {
                Object.values(this.editors).forEach(editor => {
                    if (editor && editor.container) {
                        const parent = editor.container.parentNode;
                        if (parent) {
                            const toolbar = parent.querySelector('.ql-toolbar');
                            if (toolbar) toolbar.remove();
                        }
                    }
                });
                this.editors = {};

                // Backup jika editor masih ada di DOM
                const toolbars = document.querySelectorAll('.ql-toolbar');
                const editors = document.querySelectorAll('.ql-editor');
                toolbars.forEach(toolbar => toolbar.remove());
                editors.forEach(editor => editor.remove());
            }
        };

        // Inisialisasi
        document.addEventListener('livewire:navigated', () => {
            window.EditorManager.init();
        });

        // Inisialisasi pada load pertama
        document.addEventListener('livewire:initialized', () => {
            window.EditorManager.init();
        });

        // Clean up sebelum navigasi
        document.addEventListener('livewire:navigating', () => {
            window.ImageCropperManager.cleanup();
            window.EditorManager.cleanup();
        });
    </script>
@endpush
