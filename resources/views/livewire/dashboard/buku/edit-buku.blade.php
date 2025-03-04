<div class="max-w-4xl mx-auto p-6">
    @include('components.alert')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/cropper.css') }}">
        <script src="{{ asset('js/cropper.min.js') }}"></script>
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    @endpush

    <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold mb-6">Edit Buku</h2>

        <form wire:submit.prevent="save" class="space-y-6">
            <!-- Cover Image Upload -->
            <div>
                <x-input-label class="block mb-2">
                    Cover Buku (Ukuran yang disarankan: 600x900px)
                </x-input-label>
                <div
                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-neutral-300 dark:border-neutral-700 border-dashed rounded-lg relative">
                    <div class="space-y-1 text-center">
                        @if ($cover)
                            <img src="{{ $cover->temporaryUrl() }}" alt="Preview"
                                class="mx-auto h-32 w-auto object-cover mb-4">
                        @elseif ($oldCover)
                            <img src="{{ asset($oldCover) }}" alt="Current Cover"
                                class="mx-auto h-32 w-auto object-cover mb-4">
                        @else
                            <svg class="mx-auto h-12 w-12 text-neutral-400" stroke="currentColor" fill="none"
                                viewBox="0 0 48 48">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        @endif
                        <div class="flex text-sm text-neutral-600 dark:text-neutral-400">
                            <x-input-label
                                class="relative cursor-pointer rounded-md font-medium text-cgreen-600 hover:text-cgreen-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-cgreen-500">
                                <span>Upload file</span>
                                <input type="file" wire:model="cover" class="sr-only" accept="image/*" id="gambar"
                                    onchange="openCropper(event)">
                            </x-input-label>
                        </div>
                        <p class="text-xs text-neutral-500">PNG, JPG up to 2MB</p>
                    </div>
                </div>
                @error('cover')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Judul -->
            <div>
                <x-input-label class="block mb-2">
                    Judul
                </x-input-label>
                <x-text-input type="text" wire:model.live="judul" class="w-full block" placeholder="Judul buku" />
                @error('judul')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Slug -->
            <div>
                <x-input-label class="block mb-2">
                    Slug
                </x-input-label>
                <x-text-input type="text" wire:model="slug" class="w-full block bg-neutral-100 dark:bg-neutral-800"
                    readonly placeholder="Generated automatically" />
                @error('slug')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <x-input-label class="block mb-2">
                    Deskripsi
                </x-input-label>
                <div wire:ignore>
                    <div id="deskripsi" class="h-72 bg-white dark:bg-neutral-800">{!! $deskripsi !!}</div>
                </div>
                @error('deskripsi')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Sinopsis -->
            <div>
                <x-input-label class="block mb-2">
                    Sinopsis
                </x-input-label>
                <div wire:ignore>
                    <div id="sinopsis" class="h-72 bg-white dark:bg-neutral-800">{!! $sinopsis !!}/div>
                    </div>
                    @error('sinopsis')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>


                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <!-- Kategori -->
                    <div>
                        <x-input-label class="block mb-2">
                            Kategori
                        </x-input-label>
                        <select wire:model="kategori_id"
                            class="w-full rounded-lg border-neutral-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 focus:border-cgreen-500 focus:ring-cgreen-500">
                            <option value="">Pilih kategori...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Penulis -->
                    <div>
                        <x-input-label class="block mb-2">
                            Penulis
                        </x-input-label>
                        <x-text-input type="text" wire:model="penulis" class="w-full block"
                            placeholder="Nama penulis" />
                        @error('penulis')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Institusi -->
                    <div>
                        <x-input-label class="block mb-2">
                            Institusi
                        </x-input-label>
                        <x-text-input type="text" wire:model="institusi" class="w-full block"
                            placeholder="Nama institusi (opsional)" />
                        @error('institusi')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- ISBN -->
                    <div>
                        <x-input-label class="block mb-2">
                            ISBN
                        </x-input-label>
                        <x-text-input type="text" wire:model="isbn" class="block w-full"
                            placeholder="978-0-123456-47-2" />
                        @error('isbn')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Harga -->
                    <div>
                        <x-input-label class="block mb-2">
                            Harga
                        </x-input-label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-neutral-500 sm:text-sm">Rp</span>
                            </div>
                            <x-text-input type="number" wire:model="harga" class="pl-12 w-full block"
                                placeholder="0" />
                        </div>
                        @error('harga')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Jumlah Halaman -->
                    <div>
                        <x-input-label class="block mb-2">
                            Jumlah Halaman
                        </x-input-label>
                        <x-text-input type="number" wire:model="jumlah_halaman" class="w-full block"
                            placeholder="100" />
                        @error('jumlah_halaman')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tanggal Terbit -->
                    <div>
                        <x-input-label class="block mb-2">
                            Tanggal Terbit
                        </x-input-label>
                        <x-text-input type="date" wire:model="tanggal_terbit" class="w-full block" />
                        @error('tanggal_terbit')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Ukuran -->
                    <div>
                        <x-input-label class="block mb-2">
                            Ukuran
                        </x-input-label>
                        <x-text-input type="text" wire:model="ukuran" class="w-full block"
                            placeholder="Contoh: 17.5 x 25 cm" />
                        @error('ukuran')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Ketersediaan -->
                <div class="mt-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" wire:model="ketersediaan"
                            class="rounded border-neutral-300 text-cgreen-500 shadow-sm focus:border-cgreen-300 focus:ring focus:ring-cgreen-200 focus:ring-opacity-50"
                            {{ $ketersediaan ? 'checked' : '' }}>
                        <span class="ml-2 text-neutral-700 select-none dark:text-neutral-300">Tersedia</span>
                    </label>
                </div>

                <!-- Marketplace Links -->
                <div class="space-y-4">
                    <div>
                        <h3 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">Link Marketplace</h3>
                        <p class="text-sm text-neutral-500 dark:text-neutral-400">Minimal pilih 1 marketplace</p>
                    </div>

                    <!-- Shopee -->
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" wire:model.live="marketplaces.shopee.active"
                                class="rounded border-neutral-300 text-cgreen-500 shadow-sm focus:border-cgreen-300 focus:ring focus:ring-cgreen-200 focus:ring-opacity-50">
                            <span class="ml-2 text-neutral-700 select-none dark:text-neutral-300">Shopee</span>
                        </label>
                        @if ($marketplaces['shopee']['active'])
                            <div>
                                <x-text-input type="url" wire:model="marketplaces.shopee.link"
                                    class="w-full block" placeholder="https://shopee.co.id/product/..." />
                                @error('marketplaces.shopee.link')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>

                    <!-- Tokopedia -->
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" wire:model.live="marketplaces.tokopedia.active"
                                class="rounded border-neutral-300 text-cgreen-500 shadow-sm focus:border-cgreen-300 focus:ring focus:ring-cgreen-200 focus:ring-opacity-50">
                            <span class="ml-2 text-neutral-700 select-none dark:text-neutral-300">Tokopedia</span>
                        </label>
                        @if ($marketplaces['tokopedia']['active'])
                            <div>
                                <x-text-input type="url" wire:model="marketplaces.tokopedia.link"
                                    class="w-full block" placeholder="https://www.tokopedia.com/product/..." />
                                @error('marketplaces.tokopedia.link')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>

                    <!-- Bukalapak -->
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" wire:model.live="marketplaces.bukalapak.active"
                                class="rounded border-neutral-300 text-cgreen-500 shadow-sm focus:border-cgreen-300 focus:ring focus:ring-cgreen-200 focus:ring-opacity-50">
                            <span class="ml-2 text-neutral-700 select-none dark:text-neutral-300">Bukalapak</span>
                        </label>
                        @if ($marketplaces['bukalapak']['active'])
                            <div>
                                <x-text-input type="url" wire:model="marketplaces.bukalapak.link"
                                    class="w-full block" placeholder="https://www.bukalapak.com/p/..." />
                                @error('marketplaces.bukalapak.link')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>

                    <!-- Lazada -->
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" wire:model.live="marketplaces.lazada.active"
                                class="rounded border-neutral-300 text-cgreen-500 shadow-sm focus:border-cgreen-300 focus:ring focus:ring-cgreen-200 focus:ring-opacity-50">
                            <span class="ml-2 text-neutral-700 select-none dark:text-neutral-300">Lazada</span>
                        </label>
                        @if ($marketplaces['lazada']['active'])
                            <div>
                                <x-text-input type="url" wire:model="marketplaces.lazada.link"
                                    class="w-full block" placeholder="https://www.lazada.co.id/products/..." />
                                @error('marketplaces.lazada.link')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>

                    @error('marketplaces')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- draft --}}
                <div class="mt-4">
                    <h3 class="text-lg font-medium text-neutral-900 dark:text-neutral-100 mb-2">Status</h3>
                    <label class="inline-flex items-center">
                        <input type="checkbox" wire:model="draft"
                            class="rounded border-neutral-300 text-cgreen-500 shadow-sm focus:border-cgreen-300 focus:ring focus:ring-cgreen-200 focus:ring-opacity-50">
                        <span class="ml-2 text-neutral-700 select-none dark:text-neutral-300">Simpan sebagai
                            draft</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <x-primary-button type="submit">
                        Simpan Buku
                    </x-primary-button>
                </div>
        </form>
    </div>

    <x-modal name="cropperModal" :show="false" maxWidth="xl" align="center">
        <div class="p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-neutral-900">
                    {{ __('Crop Cover Image') }}
                </h2>
                <button type="button" class="text-neutral-400 hover:text-neutral-500" onclick="closeCropModal()">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="mb-4 bg-neutral-50 rounded-lg">
                <img id="cropImage" src="" alt="Gambar untuk dipotong">
            </div>

            <div class="flex justify-end gap-3 mt-4">
                <x-border-button type="button" class="!w-auto" onclick="closeCropModal()">
                    {{ __('Cancel') }}
                </x-border-button>
                <x-primary-button type="button" class="!w-auto" onclick="cropImage()">
                    {{ __('Crop & Save') }}
                </x-primary-button>
            </div>
        </div>
    </x-modal>

    @push('scripts')
        <script>
            window.ImageCropperManager = {
                cropper: null,
                originalFile: null,

                initCropper() {
                    window.openCropper = (event) => {
                        this.originalFile = event.target.files[0];

                        if (!this.originalFile) return;

                        const reader = new FileReader();
                        reader.onload = (e) => {
                            const image = document.getElementById('cropImage');
                            image.src = e.target.result;
                            
                            if (this.cropper) {
                                this.cropper.destroy();
                            }

                            image.onload = () => {
                                this.cropper = new Cropper(image, {
                                    aspectRatio: 2 / 3,
                                    viewMode: 1,
                                    dragMode: 'move',
                                    autoCropArea: 0.8,
                                    restore: false,
                                    guides: true,
                                    center: true,
                                    highlight: true,
                                    cropBoxMovable: true,
                                    cropBoxResizable: true,
                                    toggleDragModeOnDblclick: false,
                                    minContainerWidth: 600,
                                    minContainerHeight: 600
                                });
                                @this.dispatch('open-modal', 'cropperModal');
                            };
                        };
                        reader.readAsDataURL(this.originalFile);
                        event.target.value = '';
                    };

                    window.cropImage = () => {
                        if (!this.cropper) return;

                        const generateImage = (width, height, quality = 0.9) => {
                            return new Promise((resolve) => {
                                const canvas = this.cropper.getCroppedCanvas({
                                    width: width,
                                    height: height,
                                    imageSmoothingEnabled: true,
                                    imageSmoothingQuality: 'high',
                                });

                                canvas.toBlob((blob) => {
                                    const file = new File([blob],
                                        `${this.originalFile.name.split('.')[0]}_${width}x${height}.jpg`, {
                                            type: 'image/jpeg'
                                        });
                                    resolve(file);
                                }, 'image/jpeg', quality);
                            });
                        };


                        Promise.all([
                            generateImage(300, 450, 0.7),
                            generateImage(600, 900, 0.9)
                        ]).then(([thumbnailFile, fullSizeFile]) => {
                            @this.upload('cover', fullSizeFile,
                                (uploadedFilename) => {
                                    @this.upload('thumbnail', thumbnailFile,
                                        (thumbnailFilename) => {

                                            const previewImage = document.getElementById(
                                                'previewImage');
                                            if (previewImage) {
                                                previewImage.src = URL.createObjectURL(thumbnailFile);
                                            }

                                            window.dispatchEvent(new CustomEvent('close-modal', {
                                                detail: 'cropperModal'
                                            }));

                                            this.cleanup();
                                        },
                                        (error) => {
                                            console.error('Thumbnail upload failed:', error);
                                            alert('Failed to upload thumbnail. Please try again.');
                                        }
                                    );
                                },
                                (error) => {
                                    console.error('Cover upload failed:', error);
                                    alert('Failed to upload cover image. Please try again.');
                                }
                            );
                        });
                    };

                    window.closeCropModal = () => {
                        this.cleanup();
                        window.dispatchEvent(new CustomEvent('close-modal', {
                            detail: 'cropperModal'
                        }));
                    };
                },

                cleanup() {
                    if (this.cropper) {
                        this.cropper.destroy();
                        this.cropper = null;
                    }

                    const cropImage = document.getElementById('cropImage');
                    if (cropImage) {
                        cropImage.src = '';
                    }
                }
            };


            window.ImageCropperManager.initCropper();

            document.addEventListener('livewire:navigated', () => {
                window.ImageCropperManager.initCropper();
            });

            document.addEventListener('livewire:navigating', () => {
                window.ImageCropperManager.cleanup();
            });
        </script>

        <script>
            window.EditorManager = {
                editors: {},

                init() {
                    if (typeof Quill === 'undefined') {
                        setTimeout(() => this.init(), 100);
                        return;
                    }

                    if (!document.getElementById('deskripsi') || !document.getElementById('sinopsis')) {
                        setTimeout(() => this.init(), 100);
                        return;
                    }

                    const wireEl = document.querySelector('[wire\\:id]');
                    if (!wireEl) {
                        console.warn('No Livewire component found');
                        return;
                    }

                    const component = Livewire.find(wireEl.getAttribute('wire:id'));
                    if (!component) {
                        console.warn('Could not find Livewire component instance');
                        return;
                    }

                    const quillConfig = {
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
                    };

                    if (!this.editors.deskripsi) {
                        this.initializeEditor('deskripsi', quillConfig, component);
                    }
                    if (!this.editors.sinopsis) {
                        this.initializeEditor('sinopsis', quillConfig, component);
                    }
                },

                initializeEditor(id, config, component) {
                    const element = document.getElementById(id);
                    if (!element) return;

                    const existingToolbar = element.parentNode.querySelector('.ql-toolbar');
                    if (existingToolbar) {
                        existingToolbar.remove();
                    }

                    const editor = new Quill(`#${id}`, config);

                    const initialContent = component.get(id);
                    if (initialContent) {
                        editor.root.innerHTML = initialContent;
                    }

                    editor.on('text-change', () => {
                        const content = editor.root.innerHTML.trim();
                        component.dispatch('set-' + id, {
                            content
                        });
                    });

                    this.editors[id] = editor;
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
                }
            };

            document.addEventListener('livewire:initialized', () => {
                setTimeout(() => window.EditorManager.init(), 100);
            });

            document.addEventListener('livewire:navigating', () => window.EditorManager.cleanup());
            document.addEventListener('livewire:navigated', () => {
                setTimeout(() => window.EditorManager.init(), 100);
            });
        </script>
    @endpush
</div>
