<x-main-layout>
	<x-slot name="title">{{ $title }}</x-slot>

	<!-- Hero Section -->
	<section class="pb-12">
		 <x-container>
			  <div class="text-center mb-16">
					<h2 class="text-3xl font-bold mb-4">Layanan Penerbitan</h2>
					<p class="text-neutral-600 dark:text-neutral-400 max-w-3xl mx-auto">
						 Kami menyediakan berbagai layanan penerbitan berkualitas untuk membantu mewujudkan karya Anda. Berikut adalah penjelasan detail tentang layanan-layanan yang kami sediakan.
					</p>
			  </div>
		 </x-container>
	</section>

	<!-- Main Services -->
	<section class="pb-24">
		 <x-container>
			  <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
					<!-- ISBN dan Pendaftaran HKI -->
					<div class="bg-white dark:bg-neutral-900 rounded-2xl p-8 shadow-sm">
						 <div class="w-14 h-14 bg-cgreen-100 dark:bg-cgreen-900/50 rounded-xl flex items-center justify-center mb-6">
							  <svg class="w-8 h-8 text-cgreen-600 dark:text-cgreen-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
							  </svg>
						 </div>
						 <h3 class="text-xl font-semibold mb-4 text-neutral-900 dark:text-neutral-100">ISBN dan Pendaftaran HKI</h3>
						 <ul class="space-y-3 text-neutral-600 dark:text-neutral-400">
							  <li class="flex items-start gap-3">
									<svg class="w-5 h-5 text-cgreen-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
									</svg>
									<span>Pendaftaran ISBN (International Standard Book Number)</span>
							  </li>
							  <li class="flex items-start gap-3">
									<svg class="w-5 h-5 text-cgreen-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
									</svg>
									<span>Pengurusan Hak Kekayaan Intelektual (HKI)</span>
							  </li>
							  <li class="flex items-start gap-3">
									<svg class="w-5 h-5 text-cgreen-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
									</svg>
									<span>Pendaftaran ke Perpustakaan Nasional</span>
							  </li>
						 </ul>
					</div>

					<!-- Layout dan Desain -->
					<div class="bg-white dark:bg-neutral-900 rounded-2xl p-8 shadow-sm">
						 <div class="w-14 h-14 bg-cgreen-100 dark:bg-cgreen-900/50 rounded-xl flex items-center justify-center mb-6">
							  <svg class="w-8 h-8 text-cgreen-600 dark:text-cgreen-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
							  </svg>
						 </div>
						 <h3 class="text-xl font-semibold mb-4 text-neutral-900 dark:text-neutral-100">Layout dan Desain</h3>
						 <ul class="space-y-3 text-neutral-600 dark:text-neutral-400">
							  <li class="flex items-start gap-3">
									<svg class="w-5 h-5 text-cgreen-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
									</svg>
									<span>Desain cover profesional dan menarik</span>
							  </li>
							  <li class="flex items-start gap-3">
									<svg class="w-5 h-5 text-cgreen-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
									</svg>
									<span>Layout isi buku yang rapi dan konsisten</span>
							  </li>
							  <li class="flex items-start gap-3">
									<svg class="w-5 h-5 text-cgreen-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
									</svg>
									<span>Desain ilustrasi dan infografis</span>
							  </li>
						 </ul>
					</div>

					<!-- Editing dan Proofreading -->
					<div class="bg-white dark:bg-neutral-900 rounded-2xl p-8 shadow-sm">
						 <div class="w-14 h-14 bg-cgreen-100 dark:bg-cgreen-900/50 rounded-xl flex items-center justify-center mb-6">
							  <svg class="w-8 h-8 text-cgreen-600 dark:text-cgreen-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
							  </svg>
						 </div>
						 <h3 class="text-xl font-semibold mb-4 text-neutral-900 dark:text-neutral-100">Editing dan Proofreading</h3>
						 <ul class="space-y-3 text-neutral-600 dark:text-neutral-400">
							  <li class="flex items-start gap-3">
									<svg class="w-5 h-5 text-cgreen-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
									</svg>
									<span>Pengeditan tata bahasa dan gaya penulisan</span>
							  </li>
							  <li class="flex items-start gap-3">
									<svg class="w-5 h-5 text-cgreen-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
									</svg>
									<span>Pemeriksaan ejaan dan tanda baca</span>
							  </li>
							  <li class="flex items-start gap-3">
									<svg class="w-5 h-5 text-cgreen-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
									</svg>
									<span>Penyesuaian format sesuai standar akademik</span>
							  </li>
						 </ul>
					</div>

					<!-- Distribusi -->
					<div class="bg-white dark:bg-neutral-900 rounded-2xl p-8 shadow-sm">
						 <div class="w-14 h-14 bg-cgreen-100 dark:bg-cgreen-900/50 rounded-xl flex items-center justify-center mb-6">
							  <svg class="w-8 h-8 text-cgreen-600 dark:text-cgreen-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
							  </svg>
						 </div>
						 <h3 class="text-xl font-semibold mb-4 text-neutral-900 dark:text-neutral-100">Distribusi</h3>
						 <ul class="space-y-3 text-neutral-600 dark:text-neutral-400">
							  <li class="flex items-start gap-3">
									<svg class="w-5 h-5 text-cgreen-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
									</svg>
									<span>Distribusi ke toko platform online</span>
							  </li>
							  <li class="flex items-start gap-3">
									<svg class="w-5 h-5 text-cgreen-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
									</svg>
									<span>Platform e-book dan digital</span>
							  </li>
							  <li class="flex items-start gap-3">
									<svg class="w-5 h-5 text-cgreen-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
									</svg>
									<span>Promosi dan pemasaran buku</span>
							  </li>
						 </ul>
					</div>
			  </div>
		 </x-container>
	</section>

	@include('home.partials.kirimNaskah')
</x-main-layout>