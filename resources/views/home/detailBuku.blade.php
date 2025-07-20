<x-main-layout>
    <section>
        <x-container>
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="w-full lg:w-3/4">
                    <div class="bg-white dark:bg-neutral-900 rounded-2xl overflow-hidden shadow-sm">
                        <!-- Book Header Section -->
                        <div class="p-6 md:p-8">
                            <div class="flex flex-col md:flex-row gap-8">
                                <!-- Book Cover -->
                                <div class="w-full md:w-1/3">
                                    <div class="aspect-[2/3] rounded-xl overflow-hidden">
                                        <img src="{{ asset($book->cover) }}" alt="{{ $book->judul }}"
                                            class="w-full h-full object-cover" />
                                    </div>
                                </div>

                                <!-- Book Info -->
                                <div class="w-full md:w-2/3 space-y-4">
                                    <h1
                                        class="text-2xl md:text-3xl font-bold text-neutral-900 dark:text-neutral-100 capitalize">
                                        {{ $book->judul }}
                                    </h1>

                                    <!-- Author & Category -->
                                    <div class="space-y-2">
                                        <div class="flex items-center gap-2 text-sm">
                                            <span class="text-neutral-500 dark:text-neutral-400">Penulis:</span>
                                            @foreach ($book->authors as $author)
                                                <a href="{{ route('author', $author->slug) }}" wire:navigate
                                                    class="text-cgreen-600 hover:text-cgreen-700 dark:text-cgreen-500 dark:hover:text-cgreen-400">
                                                    {{ $author->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                        @if ($book->institusi)
                                            <div class="flex items-center gap-2 text-sm">
                                                <span class="text-neutral-500 dark:text-neutral-400">Institusi:</span>
                                                <span
                                                    class="text-neutral-800 dark:text-neutral-200">{{ $book->institusi }}</span>
                                            </div>
                                        @endif
                                        <div class="flex items-center gap-2 text-sm">
                                            <span class="text-neutral-500 dark:text-neutral-400">Kategori:</span>
                                            <a href="{{ route('kategori', $book->kategori->slug) }}" wire:navigate
                                                class="text-cgreen-600 hover:text-cgreen-700 dark:text-cgreen-500 dark:hover:text-cgreen-400">
                                                {{ $book->kategori->nama }}
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Book Details -->
                                    <div
                                        class="grid grid-cols-2 gap-4 text-sm border p-3 rounded-lg dark:border-neutral-700">
                                        <div>
                                            <span class="text-neutral-500 dark:text-neutral-400">ISBN:</span>
                                            <span
                                                class="ml-2 text-neutral-800 dark:text-neutral-200">{{ $book->isbn }}</span>
                                        </div>
                                        <div>
                                            <span class="text-neutral-500 dark:text-neutral-400">Ukuran:</span>
                                            <span
                                                class="ml-2 text-neutral-800 dark:text-neutral-200">{{ $book->ukuran }}</span>
                                        </div>
                                        <div>
                                            <span class="text-neutral-500 dark:text-neutral-400">Halaman:</span>
                                            <span
                                                class="ml-2 text-neutral-800 dark:text-neutral-200">{{ $book->jumlah_halaman }}</span>
                                        </div>
                                        <div>
                                            <span class="text-neutral-500 dark:text-neutral-400">Terbit:</span>
                                            <span class="ml-2 text-neutral-800 dark:text-neutral-200">
                                                {{ \Carbon\Carbon::parse($book->tanggal_terbit)->format('d F Y') }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Price & Buy Button -->
                                    <div class="pt-4 border-t border-neutral-200 dark:border-neutral-700">
                                        <div class="flex items-center justify-between">
                                            <div class="space-y-1">
                                                <span
                                                    class="text-sm text-neutral-500 dark:text-neutral-400">Harga</span>
                                                <div class="text-2xl font-bold text-cgreen-600 dark:text-cgreen-500">
                                                    Rp. {{ number_format($book->harga, 0, ',', '.') }}
                                                </div>
                                            </div>
                                            @if ($book->marketplace_links && $book->marketplace_links !== '[]')
                                                <button x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', 'marketplace-links')"
                                                    class="px-6 py-2.5 bg-cgreen-500 hover:bg-cgreen-600 text-white rounded-lg transition duration-200">
                                                    Beli Sekarang
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabs Section -->
                        <div class="border-t border-neutral-200 dark:border-neutral-700">
                            <div x-data="{ tab: 'description' }" class="px-6 md:px-8">
                                <!-- Tab Headers -->
                                <div
                                    class="flex flex-wrap border-b border-neutral-200 dark:border-neutral-700 -mx-6 md:-mx-8 px-6 md:px-8">
                                    <button @click="tab = 'description'"
                                        :class="{ 'border-cgreen-500 text-cgreen-600 dark:text-cgreen-500': tab === 'description' }"
                                        class="px-4 py-3 text-sm font-medium border-b-2 border-transparent hover:text-cgreen-600 dark:hover:text-cgreen-500">
                                        Deskripsi
                                    </button>
                                    <button @click="tab = 'synopsis'"
                                        :class="{ 'border-cgreen-500 text-cgreen-600 dark:text-cgreen-500': tab === 'synopsis' }"
                                        class="px-4 py-3 text-sm font-medium border-b-2 border-transparent hover:text-cgreen-600 dark:hover:text-cgreen-500">
                                        Sinopsis
                                    </button>
                                    <button @click="tab = 'toc'"
                                        :class="{ 'border-cgreen-500 text-cgreen-600 dark:text-cgreen-500': tab === 'toc' }"
                                        class="px-4 py-3 text-sm font-medium border-b-2 border-transparent hover:text-cgreen-600 dark:hover:text-cgreen-500">
                                        Daftar Isi
                                    </button>
                                    <button @click="tab = 'komentar'"
                                        :class="{ 'border-cgreen-500 text-cgreen-600 dark:text-cgreen-500': tab === 'komentar' }"
                                        class="px-4 py-3 text-sm font-medium border-b-2 border-transparent hover:text-cgreen-600 dark:hover:text-cgreen-500">
                                        Komentar
                                    </button>
                                </div>

                                <!-- Tab Contents -->
                                <div class="py-6">
                                    <div x-show="tab === 'description'" class="prose dark:prose-invert max-w-none">
                                        {!! $book->deskripsi !!}
                                    </div>
                                    <div x-show="tab === 'synopsis'" class="prose dark:prose-invert max-w-none">
                                        {!! $book->sinopsis !!}
                                    </div>
                                    <div x-show="tab === 'toc'" class="prose dark:prose-invert max-w-none">
                                        {!! $book->daftar_isi !!}
                                    </div>
                                    <div x-show="tab === 'komentar'" x-data="{ showCommentModal: false }"
                                        class="relative max-w-none">
                                        <div>
                                            <div class="max-w-3xl mx-auto relative">
                                                <h2
                                                    class="text-2xl font-bold mb-6 text-neutral-900 dark:text-neutral-100">
                                                    Komentar</h2>
                                                <button type="button" @click="showCommentModal = true"
                                                    class="fixed z-30 bottom-8 right-8 md:bottom-12 md:right-12 bg-cgreen-500 hover:bg-cgreen-600 text-white rounded-full shadow-lg p-4 flex items-center gap-2 transition duration-200 focus:outline-none focus:ring-2 focus:ring-cgreen-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                    <span class="hidden md:inline font-semibold">Tulis
                                                        Komentar</span>
                                                </button>
                                                {{-- Modal Form Komentar --}}
                                                <div x-cloak x-show="showCommentModal"
                                                    x-transition.opacity.duration.200ms
                                                    class="fixed inset-0 z-40 flex items-center justify-center bg-black/40">
                                                    <div @click.away="showCommentModal = false"
                                                        class="bg-white dark:bg-neutral-900 rounded-xl shadow-xl w-full max-w-md p-6 relative animate-fadeInUp">
                                                        <button @click="showCommentModal = false"
                                                            class="absolute top-3 right-3 text-neutral-400 hover:text-neutral-700 dark:hover:text-neutral-200">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                        <h3
                                                            class="text-lg font-bold mb-4 text-neutral-900 dark:text-neutral-100">
                                                            Tulis Komentar</h3>
                                                        <form method="POST"
                                                            action="{{ route('buku.comment', $book->id) }}">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <input type="text" name="name"
                                                                    class="w-full rounded-lg border-neutral-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 focus:border-cgreen-500 focus:ring-cgreen-500"
                                                                    placeholder="Nama Anda" required
                                                                    autocomplete="off">
                                                            </div>
                                                            <div class="mb-3">
                                                                <input type="email" name="email"
                                                                    class="w-full rounded-lg border-neutral-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 focus:border-cgreen-500 focus:ring-cgreen-500"
                                                                    placeholder="Email Anda" required
                                                                    autocomplete="off">
                                                            </div>
                                                            <div class="mb-3">
                                                                <textarea name="content" rows="3"
                                                                    class="w-full rounded-lg border-neutral-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 focus:border-cgreen-500 focus:ring-cgreen-500"
                                                                    placeholder="Tulis komentar..." required></textarea>
                                                            </div>
                                                            <button type="submit"
                                                                class="w-full px-6 py-2.5 bg-cgreen-500 hover:bg-cgreen-600 text-white rounded-lg transition duration-200">Kirim
                                                                Komentar</button>
                                                            <p class="text-xs text-neutral-500 mt-2">Komentar akan
                                                                tampil setelah disetujui admin.</p>
                                                        </form>
                                                    </div>
                                                </div>
                                                {{-- Daftar Komentar --}}
                                                <div
                                                    class="space-y-6 max-h-[60vh] overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-cgreen-200 dark:scrollbar-thumb-cgreen-900">
                                                    @forelse($comments as $comment)
                                                        <div class="bg-neutral-50 dark:bg-neutral-800 rounded-xl p-4">
                                                            <div class="flex items-center gap-3 mb-2">
                                                                <div
                                                                    class="w-10 h-10 rounded-full bg-cgreen-100 dark:bg-cgreen-900 flex items-center justify-center text-cgreen-700 dark:text-cgreen-200 font-bold text-lg">
                                                                    {{ strtoupper(substr($comment->name, 0, 1)) }}
                                                                </div>
                                                                <div>
                                                                    <div
                                                                        class="font-semibold text-neutral-900 dark:text-neutral-100">
                                                                        {{ $comment->name }}</div>
                                                                    <div
                                                                        class="text-xs text-neutral-500 dark:text-neutral-400">
                                                                        {{ $comment->created_at->format('d M Y H:i') }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="text-neutral-800 dark:text-neutral-200 mb-2">
                                                                {!! nl2br(e($comment->content)) !!}</div>
                                                            <button type="button"
                                                                class="text-cgreen-600 dark:text-cgreen-400 text-xs font-semibold reply-btn"
                                                                data-id="{{ $comment->id }}">Balas</button>
                                                            {{-- Form Reply (hidden by default) --}}
                                                            <form method="POST"
                                                                action="{{ route('buku.comment.reply', [$book->id, $comment->id]) }}"
                                                                class="reply-form mt-3 hidden">
                                                                @csrf
                                                                <div class="mb-2">
                                                                    <input type="text" name="name"
                                                                        class="w-full rounded-lg border-neutral-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 focus:border-cgreen-500 focus:ring-cgreen-500"
                                                                        placeholder="Nama Anda" required
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="mb-2">
                                                                    <input type="email" name="email"
                                                                        class="w-full rounded-lg border-neutral-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 focus:border-cgreen-500 focus:ring-cgreen-500"
                                                                        placeholder="Email Anda" required
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="mb-2">
                                                                    <textarea name="content" rows="2"
                                                                        class="w-full rounded-lg border-neutral-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 focus:border-cgreen-500 focus:ring-cgreen-500"
                                                                        placeholder="Tulis balasan..." required></textarea>
                                                                </div>
                                                                <button type="submit"
                                                                    class="px-4 py-1.5 bg-cgreen-500 hover:bg-cgreen-600 text-white rounded-lg text-sm">Kirim
                                                                    Balasan</button>
                                                            </form>
                                                            {{-- Replies --}}
                                                            @if ($comment->replies->count())
                                                                <div
                                                                    class="mt-4 pl-6 border-l-2 border-cgreen-300 dark:border-cgreen-900 space-y-4">
                                                                    @foreach ($comment->replies as $reply)
                                                                        @if ($reply->is_approved)
                                                                            <div
                                                                                class="bg-neutral-100 dark:bg-neutral-900 rounded-lg p-3">
                                                                                <div
                                                                                    class="flex items-center gap-2 mb-1">
                                                                                    <div
                                                                                        class="w-8 h-8 rounded-full bg-cgreen-200 dark:bg-cgreen-800 flex items-center justify-center text-cgreen-700 dark:text-cgreen-200 font-bold text-base">
                                                                                        {{ strtoupper(substr($reply->name, 0, 1)) }}
                                                                                    </div>
                                                                                    <div>
                                                                                        <div
                                                                                            class="font-semibold text-neutral-900 dark:text-neutral-100">
                                                                                            {{ $reply->name }}</div>
                                                                                        <div
                                                                                            class="text-xs text-neutral-500 dark:text-neutral-400">
                                                                                            {{ $reply->created_at->format('d M Y
                                                                                                                                                                                                                                                                                                                                                                H:i') }}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="text-neutral-800 dark:text-neutral-200">
                                                                                    {!! nl2br(e($reply->content)) !!}</div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @empty
                                                        <div
                                                            class="text-center text-neutral-500 dark:text-neutral-400 py-8">
                                                            Belum ada komentar.</div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- detail penulis --}}
                        <div class="p-6 md:p-8 border-t border-neutral-200 dark:border-neutral-700">
                            <h2 class="text-xl font-bold text-neutral-900 dark:text-neutral-100">Detail Penulis</h2>
                            <div class="mt-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @foreach ($book->authors as $author)
                                    <div class="flex items-center gap-4 justify-between border p-4 rounded-lg">
                                        <div class="flex gap-4">
                                            <img src="{{ asset($author->image) }}"
                                                alt="{{ $author->name }}"
                                                class="w-12 h-12 rounded-full object-cover shrink-0" loading="lazy">
                                            <div>
                                                <h3 class="text-xl font-bold text-neutral-900 capitalize dark:text-neutral-100">
                                                    {{ $author->name }}
                                                </h3>
                                                <p
                                                    class="text-sm text-neutral-500 dark:text-neutral-400 mt-1 text-pretty line-clamp-2">
                                                    @php
                                                        $deskripsi = strip_tags($author->description);
                                                        $deskripsi = substr($deskripsi, 0, 50);
                                                        echo $deskripsi;
                                                    @endphp
                                                </p>
                                            </div>
                                        </div>
                                        <div class="shrink-0">
                                            <a href="{{ route('author', $author->slug) }}"
                                                wire:navigate
                                                class="inline-block text-sm text-right hover:underline text-cgreen-600 dark:text-cgreen-500">
                                                Detail penulis
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-1/4 space-y-6">
                    <h2 class="text-xl font-bold text-neutral-900 dark:text-neutral-100">Buku Terkait</h2>

                    <div class="space-y-4">
                        @forelse($relatedBooks as $relatedBook)
                            <a href="{{ route('detailBuku', $relatedBook->slug) }}" wire:navigate
                                class="block group">
                                <div
                                    class="bg-white dark:bg-neutral-900 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-200">
                                    <div class="flex gap-4 p-4">
                                        <div class="w-20 aspect-[2/3] rounded-lg overflow-hidden flex-shrink-0">
                                            <img src="{{ asset($relatedBook->cover_thumbnail) }}"
                                                alt="{{ $relatedBook->judul }}"
                                                class="w-full h-full object-cover transform group-hover:scale-105 transition duration-200" />
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3
                                                class="text-sm font-medium text-neutral-900 dark:text-neutral-100 line-clamp-2 group-hover:text-cgreen-500">
                                                {{ $relatedBook->judul }}
                                            </h3>
                                            <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">
                                                {{ $relatedBook->authors->first()->name }}
                                            </p>
                                            <p class="mt-1 text-sm font-medium text-cgreen-600 dark:text-cgreen-500">
                                                Rp {{ number_format($relatedBook->harga, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-8 text-neutral-500 dark:text-neutral-400">
                                Tidak ada buku terkait
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- modal marketplace links --}}
            @if ($book->marketplace_links && $book->marketplace_links !== '[]')
                <x-modal name="marketplace-links" :show="$errors->isNotEmpty()" focusable align="center" maxWidth="md">
                    <div class="space-y-2 p-6">
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">
                            Beli di Marketplace
                        </h3>
                        <div class="space-y-4">
                            @foreach (json_decode($book->marketplace_links, true) as $marketplace => $link)
                                <a href="{{ $link }}" target="_blank" rel="noopener noreferrer"
                                    class="flex items-center justify-between p-4 rounded-lg border border-neutral-200 dark:border-neutral-700 hover:border-cgreen-500 dark:hover:border-cgreen-500 transition-colors duration-200">
                                    <div class="flex items-center gap-3">
                                        <span class="text-lg capitalize">{{ $marketplace }}</span>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-neutral-500"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endforeach

                            <div class="mt-4 text-sm text-neutral-500 dark:text-neutral-400">
                                Klik link untuk membuka di tab baru
                            </div>
                        </div>
                    </div>
                </x-modal>
            @endif
        </x-container>
    </section>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('komentarTab', () => ({
                showCommentModal: false,
            }))
        })
        document.querySelectorAll('.reply-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const form = this.parentElement.querySelector('.reply-form');
                if (form) form.classList.toggle('hidden');
            });
        });
    </script>
</x-main-layout>
