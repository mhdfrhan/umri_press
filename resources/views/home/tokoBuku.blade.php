<x-main-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <section class="bg-red-500 py-24 bg-center bg-repeat"
        style="background-image: url({{ asset('assets/img/background-buku.svg') }})">
        <x-container>
            <h1 class="text-4xl font-semibold text-white">Selamat Datang di Toko Buku UMRI Press</h1>
            <p class="mt-4 text-lg text-white">Toko Buku online terlengkap dan terpercaya dengan harga yang terjangkau
            </p>
            <div class="mt-8">
                <a href="#">
                    <x-light-button class="inline-flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                            <path fill-rule="evenodd"
                                d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 0 0 4.25 22.5h15.5a1.875 1.875 0 0 0 1.865-2.071l-1.263-12a1.875 1.875 0 0 0-1.865-1.679H16.5V6a4.5 4.5 0 1 0-9 0ZM12 3a3 3 0 0 0-3 3v.75h6V6a3 3 0 0 0-3-3Zm-3 8.25a3 3 0 1 0 6 0v-.75a.75.75 0 0 1 1.5 0v.75a4.5 4.5 0 1 1-9 0v-.75a.75.75 0 0 1 1.5 0v.75Z"
                                clip-rule="evenodd" />
                        </svg>
                        Belanja Sekarang
                    </x-light-button>
                </a>
            </div>
        </x-container>
    </section>

    <section class="pb-24">
        <x-container>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-8">
					@for ($i = 0; $i < 8; $i++)	 
					<div class="shadow-sm hover:shadow-xl p-6 duration-300 transition-all rounded-xl shadow-neutral-200">
						 <img class="w-full rounded-lg"
							  src="https://deepublishstore.com/wp-content/uploads/2024/08/2406187_Algoritma-dan-Dasar_Eko-Heri-Susanto-rev-1.0-percepatan-depan-scaled.jpg" alt="" loading="lazy">
						 <div class="mt-4 text-center">
							  <a href="#" class="text-xl font-semibold text-neutral-800 line-clamp-2 hover:text-red-500 duration-200">
									Ini adalah jduul buku
							  </a>
							  <p class="mt-1 text-sm text-neutral-400">
									Oleh Muhammad Farhan
							  </p>
							  <div class="mt-4">
									<span class="text-lg font-semibold text-red-500">Rp. 150.000</span>
							  </div>
						 </div>
					</div>
					@endfor
            </div>
        </x-container>
    </section>
</x-main-layout>
