import './bootstrap';

document.addEventListener('livewire:navigated', function () {
	const darkModeToggle = document.querySelector('#darkModeToggle');
	const htmlElement = document.documentElement;

	function enableDarkMode() {
		htmlElement.classList.add('dark');
		localStorage.setItem('theme', 'dark');
	}

	function disableDarkMode() {
		htmlElement.classList.remove('dark');
		localStorage.setItem('theme', 'light');
	}

	if (localStorage.getItem('theme') === 'dark') {
		enableDarkMode();
	}

	darkModeToggle.addEventListener('click', function () {
		if (htmlElement.classList.contains('dark')) {
			disableDarkMode();
		} else {
			enableDarkMode();
		}
	});

	const backToTopBtn = document.getElementById('backToTopBtn');

	if (!backToTopBtn) {
		return;
	}
	
	function toggleBackToTopButton() {
		if (window.scrollY > 300) {
			backToTopBtn.classList.remove('opacity-0', 'invisible');
			backToTopBtn.classList.add('opacity-100');
		} else {
			backToTopBtn.classList.remove('opacity-100');
			backToTopBtn.classList.add('opacity-0', 'invisible');
		}
	}

	function scrollToTop() {
		window.scrollTo({
			top: 0,
			behavior: 'smooth'
		});
	}

	window.addEventListener('scroll', toggleBackToTopButton);

	backToTopBtn.addEventListener('click', scrollToTop);

	toggleBackToTopButton();
});

