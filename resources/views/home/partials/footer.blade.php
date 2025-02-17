<footer class="bg-neutral-900">
	<div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
	  <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
		 <!-- Company Info -->
		 <div class="space-y-4">
			<img src="{{ asset('assets/img/logo-white.png') }}" alt="Logo" class="h-14"/>
			<p class="text-neutral-400 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore.</p>
			<div class="flex space-x-4">
			  <a href="#" class="text-neutral-400 hover:text-white transition-colors">
				 <img src="https://placehold.co/24x24" alt="Facebook" class="h-6 w-6"/>
			  </a>
			  <a href="#" class="text-neutral-400 hover:text-white transition-colors">
				 <img src="https://placehold.co/24x24" alt="Twitter" class="h-6 w-6"/>
			  </a>
			  <a href="#" class="text-neutral-400 hover:text-white transition-colors">
				 <img src="https://placehold.co/24x24" alt="Instagram" class="h-6 w-6"/>
			  </a>
			</div>
		 </div>
		 <!-- Quick Links -->
		 <div>
			<h3 class="text-white font-semibold text-lg mb-4">Quick Links</h3>
			<ul class="space-y-2">
			  <li><a href="#" class="text-neutral-400 hover:text-white transition-colors">Home</a></li>
			  <li><a href="#" class="text-neutral-400 hover:text-white transition-colors">About Us</a></li>
			  <li><a href="#" class="text-neutral-400 hover:text-white transition-colors">Harga</a></li>
			  <li><a href="#" class="text-neutral-400 hover:text-white transition-colors">Kontak</a></li>
			  <li><a href="#" class="text-neutral-400 hover:text-white transition-colors">Berita</a></li>
			</ul>
		 </div>
		 <!-- Contact Info -->
		 <div>
			<h3 class="text-white font-semibold text-lg mb-4">Contact Info</h3>
			<ul class="space-y-2">
			  <li class="flex items-center text-neutral-400">
				 <img src="https://placehold.co/20x20" alt="Location" class="h-5 w-5 mr-2"/>
				 123 Street Name, City, Country
			  </li>
			  <li class="flex items-center text-neutral-400">
				 <img src="https://placehold.co/20x20" alt="Phone" class="h-5 w-5 mr-2"/>
				 +1 234 567 890
			  </li>
			  <li class="flex items-center text-neutral-400">
				 <img src="https://placehold.co/20x20" alt="Email" class="h-5 w-5 mr-2"/>
				 info@example.com
			  </li>
			</ul>
		 </div>
		 <div>
			<h3 class="text-white font-semibold text-lg mb-4">Layanan</h3>
			<ul class="space-y-2">
			  <li class="text-neutral-400">Penerbitan Buku</li>
			  <li class="text-neutral-400">Jasa Parafrase</li>
			  <li class="text-neutral-400">Jasa Pengurusan HAKI</li>
			  <li class="text-neutral-400">Konsultasi Penulisan</li>
			  <li class="text-neutral-400">Toko Buku</li>
			</ul>
		 </div>
	  </div>
	  <!-- Bottom Bar -->
	  <div class="border-t border-neutral-800 mt-12 pt-8">
		 <div class="flex flex-col md:flex-row justify-between items-center">
			<p class="text-neutral-400 text-sm">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
			<div class="flex space-x-6 mt-4 md:mt-0"><a href="#" class="text-neutral-400 hover:text-white text-sm transition-colors">Privacy Policy</a><a href="#" class="text-neutral-400 hover:text-white text-sm transition-colors">Terms of Service</a><a href="#" class="text-neutral-400 hover:text-white text-sm transition-colors">Cookie Policy</a></div>
		 </div>
	  </div>
	</div>
 </footer>