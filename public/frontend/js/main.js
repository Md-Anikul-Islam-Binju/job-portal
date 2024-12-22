(function ($) {
	'use strict';

	var windowOn = $(window);

	// sticky header js
	windowOn.on('scroll', function () {
		var scroll = windowOn.scrollTop();
		if (scroll < 100) {
			$('#garments-niyog-header').removeClass('header-sticky');
		} else {
			$('#garments-niyog-header').addClass('header-sticky');
		}
	});

	/**
	 * Language Switcher
	 */
	const switcher = document.getElementById('languageSwitcher');
	switcher.addEventListener('click', () => {
		const isChecked = switcher.getAttribute('aria-checked') === 'true';
		switcher.setAttribute('aria-checked', !isChecked);
	});

	/**
	 * Hero Image Slider
	 */
	/**
	 * Hero Image Slider
	 */
	let heroSlider = new Swiper('.heroSlider', {
		spaceBetween: 30,
		grabCursor: true,
		effect: 'fade',
		loop: true,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});

	/**
	 * Counter Up
	 */
	$('.number').counterUp({ time: 3000 });

	/**
	 * Trusted company
	 */
	let tcsSlider = new Swiper('.tcs', {
		slidesPerView: 2,
		spaceBetween: 30,
		grabCursor: true,
		loop: true,
		autoplay: {
			delay: 5000,
		},
		breakpoints: {
			768: {
				slidesPerView: 3,
			},
			992: {
				slidesPerView: 4,
			},
			1200: {
				slidesPerView: 5,
			},
		},
	});

	/**
	 * User Review
	 */
	let userReviewSlider = new Swiper('.userReview', {
		slidesPerView: 1,
		centeredSlides: true,
		spaceBetween: 30,
		grabCursor: true,
		loop: true,
		autoplay: {
			delay: 5000,
		},
	});
})(jQuery);
