import smoothscroll from 'smoothscroll-polyfill';
// import TweenLite from 'gsap';
const Isotope = require('isotope-layout');
const Flickity = require('flickity');
require('flickity-fade');

export const initSlideshows = () => {
	// Find all carousels in doc
	const slideshows = document.querySelectorAll('.slideshow');

	// Init each carousel
	slideshows.forEach((slideshow) => {
		const options = {
			contain: false,
			freeScroll: false,
			prevNextButtons: false,
			pageDots: true,
			cellAlign: 'left',
			touchVerticalScroll: false,
			draggable: false,
			wrapAround: true,
			fade: true,
			autoPlay: 4000,
			pauseAutoPlayOnHover: false,
		};
		// Init slideshow
		const flkty = new Flickity(slideshow, options);
		// Reset play status on nav click (stops slider from pausing indefinitely during autoplay)
		const dots = slideshow.querySelectorAll('li.dot');
		dots.forEach((dot) => {
			dot.onclick = function () {
				const time = flkty.options.autoPlay;
				setTimeout(function () {
					flkty.player.play();
				}, 100);
			};
		});
	});
};

export const initCarousels = () => {
	// Find all carousels in doc
	const carousels = document.querySelectorAll('.carousel__wrap');

	// Init each carousel
	carousels.forEach((carousel) => {
		// Get carousel container
		const carouselCont = carousel.querySelector('.carousel');

		// Get custom carousel buttons
		const carouselButtons = carousel.querySelector('.carousel__buttons');

		const options = {
			contain: true,
			freeScroll: false,
			prevNextButtons: false,
			pageDots: false,
			cellAlign: 'left',
			touchVerticalScroll: false,
			draggable: true,
			wrapAround: false,
			// fade: true,
		};

		// Init slideshow
		const flkty = new Flickity(carouselCont, options);

		// Init buttons
		if (carouselButtons) {
			const next = carouselButtons.querySelector('.carousel--next');
			const prev = carouselButtons.querySelector('.carousel--prev');

			function positionButtons() {
				const itemWidth = flkty.cells[0].size.width;
				const itemHeight =
					flkty.cells[0].element.querySelector('img').clientHeight;
				const buttonWidth = next.clientWidth;
				const carouselWidth = carouselCont.clientWidth;

				if (next) {
					let buttonX;
					let buttonY;

					// Adjust for screen width
					if (window.innerWidth > carouselWidth + buttonWidth) {
						buttonX = carouselCont.clientWidth - itemWidth;
					} else {
						buttonX = itemWidth;
					}

					// Position Y
					buttonY = (itemHeight - buttonWidth) / 2;

					next.style.top = buttonY + 'px';
					next.style.left = buttonX + 'px';
				}
			}

			// If next button exists in markup...
			if (next) {
				positionButtons();

				next.addEventListener('click', function () {
					flkty.next();
				});
			}

			// If prev button exists in markup...
			if (prev) {
				prev.addEventListener('click', function () {
					flkty.previous();
				});
			}

			// Listen for resizes

			window.addEventListener('resize', positionButtons);
		}
	});
};
export const animate = () => {
	// Get all elements with an animation trigger
	const sections = document.querySelectorAll('[data-anim]');

	// General animation trigger loop
	function scrollEvents() {
		// Get current scroll distance
		const currentScroll = window.scrollY;

		sections.forEach((item) => {
			const itemDist = item.offsetTop;
			let trigger = itemDist - window.innerHeight * 0.66;
			const triggerEnd = itemDist + item.clientHeight;

			// Change trigger value for footer section
			if (item.nodeName === 'FOOTER') {
				const footerHeight = item.clientHeight;
				// Animation to trigger when user has scrolled half way through footer
				trigger =
					document.querySelector('main#wrapper').clientHeight -
					(window.innerHeight - footerHeight / 2);
				if (currentScroll >= trigger) {
					item.setAttribute('data-anim', true);
				}
			} else if (currentScroll >= trigger && currentScroll < triggerEnd) {
				item.setAttribute('data-anim', true);
			}
		});
	}

	// Trigger elements in view on load
	scrollEvents();

	// Listen for elements coming in to view
	window.addEventListener('scroll', function () {
		scrollEvents();
	});
	// Adjust on window resize
	window.addEventListener('resize', function () {
		scrollEvents();
	});
};

export const mobileMenu = () => {
	function toggleMobileMenu(event) {
		event.preventDefault();
		const active = document.body.classList.contains('mobile--active');
		if (active) {
			document.body.classList.add('mobile--closing');
			setTimeout(function () {
				document.body.classList.remove('mobile--active');
				document.body.classList.remove('mobile--closing');
			}, 500);
		} else {
			document.body.classList.add('mobile--active');
		}
	}

	const mobileToggle = document.querySelector('.mobile__toggle');
	if (mobileToggle) {
		mobileToggle.addEventListener('click', toggleMobileMenu);
	}
};

export const formValidation = () => {
	const form = document.querySelector('form.form--validation');

	if (form) {
		let errors = [];
		const inputs = form.querySelectorAll('[required]');

		form.onsubmit = function () {
			// Empty error array
			errors = [];
			inputs.forEach((input) => {
				input.classList.remove('field--error');
				if (!input.value) {
					errors.push(input);
					input.classList.add('field--error');
				}
			});

			// Halt submission if errors exist
			if (errors.length > 0) {
				event.preventDefault();
			}
		};
	}
};

export const features = () => {
	const features = document.querySelectorAll('.features');

	if (features) {
		features.forEach((feature) => {
			const titles = feature.querySelectorAll('.features__titles li');
			const content = feature.querySelectorAll('.features__content li');
			const contentWrap = feature.querySelector('.features__content');
			let heights = [];

			function setHeight() {
				heights = [];

				content.forEach((c) => {
					// Stick this content height in array
					const height = c.clientHeight;
					heights.push(height);
				});

				// Get largest height and set
				const maxHeight = Math.max(...heights);
				contentWrap.style.height = maxHeight + 'px';
			}

			// Run initial height set and listen for window changes
			setHeight();
			window.onresize = function () {
				setHeight();
			};

			function removeActive() {
				// Remove current active title
				titles.forEach((t) => {
					if (t.classList.contains('title--active')) {
						t.classList.remove('title--active');
					}
				});

				// Remove current active content
				content.forEach((c) => {
					if (c.classList.contains('content--active')) {
						c.classList.remove('content--active');
					}
				});
			}

			function setActive(index) {
				// Set active content based on index
				content.forEach((c) => {
					const contentIndex = c.getAttribute('data-index');

					if (index == contentIndex) {
						c.classList.add('content--active');
					}
				});

				// Set active title based on index
				titles.forEach((t) => {
					const titleIndex = t.getAttribute('data-index');

					if (index == titleIndex) {
						t.classList.add('title--active');
					}
				});
			}

			// Listen for clicks on title
			titles.forEach((title) => {
				title.addEventListener('click', function () {
					const isActive = title.classList.contains('title--active');
					const index = this.getAttribute('data-index');

					// make active if it isn't currently
					if (!isActive) {
						removeActive();
						setActive(index);
					}
				});
			});
		});
	}
};
