<x-main-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <section class="bg-fixed bg-cover bg-center h-[500px] py-24 relative overflow-hidden flex items-center"
        style="background-image: url({{ asset('assets/img/library.jpg') }})">
        <div class="absolute inset-0 bg-black/80 z-0"></div>
        <x-container>
            <div class="z-10 relative w-full text-left">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 capitalize">
                    Ingin Kirim Naskah?
                </h1>
                <p class="max-w-xl text-neutral-100 text-pretty">
                    Jika Anda memiliki keahlian atau cerita yang ingin dibagikan, mengapa tidak mencoba menulis? Anda
                    sudah memiliki materi pembelajaran dan buku referensi, mengapa tidak diterbitkan? Siapa tahu Anda
                    bisa menjadi penulis besar di masa depan. Jangan ragu untuk mengirimkan naskah Anda ke UMRI Press
                    tanpa biaya!
                </p>

                <div class="mt-8 flex space-x-4 items-center">
                    <a href="">
                        <x-primary-button>Daftar Sekarang</x-primary-button>
                    </a>
						  <a href="">
								<x-secondary-button>Tampilkan Promo</x-secondary-button>
						  </a>
                </div>
            </div>
        </x-container>
    </section>

	 <!-- Why Choose Us Section -->
<section class="py-16 bg-gray-50">
	<x-container>
		 <div class="text-center mb-12">
			  <h2 class="text-3xl font-bold mb-4">Mengapa Menerbitkan di UMRI Press?</h2>
			  <p class="text-gray-600 max-w-2xl mx-auto">Kami menyediakan layanan penerbitan profesional dengan standar kualitas tinggi untuk memastikan karya Anda mencapai potensi maksimalnya.</p>
		 </div>

		 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
			  <!-- Feature 1 -->
			  <div class="bg-white p-6 rounded-lg shadow-sm">
					<div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
						 <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
						 </svg>
					</div>
					<h3 class="text-xl font-semibold mb-2">Penerbit Bereputasi</h3>
					<p class="text-gray-600">Sebagai penerbit resmi UMRI, kami memiliki kredibilitas dan pengalaman dalam menerbitkan karya-karya berkualitas.</p>
			  </div>

			  <!-- Feature 2 -->
			  <div class="bg-white p-6 rounded-lg shadow-sm">
					<div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
						 <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
						 </svg>
					</div>
					<h3 class="text-xl font-semibold mb-2">Proses Cepat</h3>
					<p class="text-gray-600">Kami menjamin proses penerbitan yang efisien dengan timeline yang jelas dan komunikasi yang responsif.</p>
			  </div>

			  <!-- Feature 3 -->
			  <div class="bg-white p-6 rounded-lg shadow-sm">
					<div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
						 <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
						 </svg>
					</div>
					<h3 class="text-xl font-semibold mb-2">Tim Profesional</h3>
					<p class="text-gray-600">Didukung oleh tim editor dan desainer profesional yang akan membantu mengoptimalkan karya Anda.</p>
			  </div>
		 </div>
	</x-container>
</section>

<!-- Publishing Process Section -->
<!-- Publishing Process Timeline Section -->
<section class="py-16 bg-gray-50">
	<x-container>
		 <div class="text-center mb-16">
			  <h2 class="text-3xl font-bold mb-4">Proses Penerbitan</h2>
			  <p class="text-gray-600 max-w-2xl mx-auto">Kami menyediakan proses penerbitan yang terstruktur dan transparan untuk memastikan kualitas terbaik</p>
		 </div>

		 <div class="relative">
			  <!-- Timeline Line -->
			  <div class="hidden lg:block absolute left-0 right-0 top-1/2 h-1 bg-red-200 -translate-y-1/2 mx-16"></div>

			  <!-- Timeline Items -->
			  <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 relative">
					<!-- Step 1 -->
					<div class="relative group">
						 <div class="bg-white p-8 rounded-xl shadow-sm relative z-10 h-full transform transition duration-300 hover:-translate-y-2">
							  <!-- Icon -->
							  <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:bg-red-600 transition-colors duration-300">
									<svg class="w-8 h-8 text-red-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
									</svg>
							  </div>
							  
							  <!-- Number Badge -->
							  <div class="absolute -top-3 -right-3 w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-lg">1</div>

							  <!-- Content -->
							  <h3 class="text-xl font-semibold text-center mb-4">Pengajuan Naskah</h3>
							  <p class="text-gray-600 text-center">Kirimkan naskah Anda melalui form pendaftaran online dengan melengkapi semua persyaratan yang diperlukan</p>
						 </div>

						 <!-- Arrow for desktop -->
						 <div class="hidden lg:block absolute -right-4 top-1/2 -translate-y-1/2 z-20">
							  <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 24 24">
									<path d="M13.92 3.845a1.5 1.5 0 0 1 2.16 0l6.75 7.5a1.5 1.5 0 0 1 0 2.075l-6.75 7.5a1.5 1.5 0 0 1-2.16-2.075L18.435 14H3a1.5 1.5 0 0 1 0-3h15.435l-4.515-4.845a1.5 1.5 0 0 1 0-2.31Z"/>
							  </svg>
						 </div>
					</div>

					<!-- Step 2 -->
					<div class="relative group">
						 <div class="bg-white p-8 rounded-xl shadow-sm relative z-10 h-full transform transition duration-300 hover:-translate-y-2">
							  <!-- Icon -->
							  <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:bg-red-600 transition-colors duration-300">
									<svg class="w-8 h-8 text-red-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
									</svg>
							  </div>

							  <!-- Number Badge -->
							  <div class="absolute -top-3 -right-3 w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-lg">2</div>

							  <!-- Content -->
							  <h3 class="text-xl font-semibold text-center mb-4">Review & Evaluasi</h3>
							  <p class="text-gray-600 text-center">Tim editor kami akan melakukan review menyeluruh terhadap naskah untuk memastikan kualitas konten</p>
						 </div>

						 <!-- Arrow for desktop -->
						 <div class="hidden lg:block absolute -right-4 top-1/2 -translate-y-1/2 z-20">
							  <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 24 24">
									<path d="M13.92 3.845a1.5 1.5 0 0 1 2.16 0l6.75 7.5a1.5 1.5 0 0 1 0 2.075l-6.75 7.5a1.5 1.5 0 0 1-2.16-2.075L18.435 14H3a1.5 1.5 0 0 1 0-3h15.435l-4.515-4.845a1.5 1.5 0 0 1 0-2.31Z"/>
							  </svg>
						 </div>
					</div>

					<!-- Step 3 -->
					<div class="relative group">
						 <div class="bg-white p-8 rounded-xl shadow-sm relative z-10 h-full transform transition duration-300 hover:-translate-y-2">
							  <!-- Icon -->
							  <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:bg-red-600 transition-colors duration-300">
									<svg class="w-8 h-8 text-red-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
									</svg>
							  </div>

							  <!-- Number Badge -->
							  <div class="absolute -top-3 -right-3 w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-lg">3</div>

							  <!-- Content -->
							  <h3 class="text-xl font-semibold text-center mb-4">Proses Editing</h3>
							  <p class="text-gray-600 text-center">Penyuntingan bahasa, tata letak, dan desain cover untuk mengoptimalkan tampilan buku</p>
						 </div>

						 <!-- Arrow for desktop -->
						 <div class="hidden lg:block absolute -right-4 top-1/2 -translate-y-1/2 z-20">
							  <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 24 24">
									<path d="M13.92 3.845a1.5 1.5 0 0 1 2.16 0l6.75 7.5a1.5 1.5 0 0 1 0 2.075l-6.75 7.5a1.5 1.5 0 0 1-2.16-2.075L18.435 14H3a1.5 1.5 0 0 1 0-3h15.435l-4.515-4.845a1.5 1.5 0 0 1 0-2.31Z"/>
							  </svg>
						 </div>
					</div>

					<!-- Step 4 -->
					<div class="relative group">
						 <div class="bg-white p-8 rounded-xl shadow-sm relative z-10 h-full transform transition duration-300 hover:-translate-y-2">
							  <!-- Icon -->
							  <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:bg-red-600 transition-colors duration-300">
									<svg class="w-8 h-8 text-red-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
									</svg>
							  </div>

							  <!-- Number Badge -->
							  <div class="absolute -top-3 -right-3 w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-lg">4</div>

							  <!-- Content -->
							  <h3 class="text-xl font-semibold text-center mb-4">Penerbitan</h3>
							  <p class="text-gray-600 text-center">Proses cetak, ISBN, dan distribusi buku ke berbagai channel pemasaran</p>
						 </div>
					</div>
			  </div>
		 </div>
	</x-container>
</section>

<!-- CTA Section -->
<section class="py-16 bg-red-600">
	<x-container>
		 <div class="text-center text-white">
			  <h2 class="text-3xl font-bold mb-4">Siap Menerbitkan Karya Anda?</h2>
			  <p class="max-w-2xl mx-auto mb-8">Jangan biarkan karya Anda hanya menjadi draft. Mari wujudkan impian Anda menjadi penulis bersama UMRI Press!</p>
			  <div class="flex justify-center space-x-4 max-w-md mx-auto">
					<x-primary-button class="!bg-white !text-red-600 hover:!shadow-white/50">
						 Daftar Sekarang
					</x-primary-button>
					<x-secondary-button class="bg-red-800/40 hover:bg-red-800/40 hover:!shadow-red-300/30">
						 Hubungi Kami
					</x-secondary-button>
			  </div>
		 </div>
	</x-container>
</section>

</x-main-layout>
