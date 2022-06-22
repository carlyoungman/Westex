class Slider {
	constructor(container) {
		// Identifier of slider container (can be class or ID)
		this.container = container;

		// Fetch the container from DOM
		this.slider = document.querySelector(container);

		if (this.slider && !this.slider.classList.contains('slider--active')) {
			// add active class
			this.slider.classList.add('slider--active');

			// Select all slider items within container
			this.slides = this.slider.querySelectorAll('.slider__item');

			// Count how many slides exist in container
			this.slideCount = this.slides.length;

			// Initial active slide (will be set on init)
			this.activeSlide = null;

			// Init
			this.init();
		} else {
			return false;
		}
	}

	setSliderHeight() {
		const slides = this.slides;
		const slider = this.slider;

		function sizer() {
			const heights = [];
			slides.forEach((slide) => {
				heights.push(slide.clientHeight);
			});

			const maxHeight = Math.max(...heights);
			slider.style.minHeight = maxHeight + 'px';
		}

		// Run sizer on init, then listen for viewport resizes
		sizer();
		window.addEventListener('resize', sizer);
	}

	// Nav builder
	buildNav(count) {
		let html = '';
		let active = '';

		if (count) {
			html += '<div class="slider__nav"><ul>';

			// build nav buttons
			for (let i = 0; i < count; i++) {
				if (i == 0) {
					active = 'class="nav__item item--active"';
				} else {
					active = 'class="nav__item"';
				}

				html +=
					'<li ' +
					active +
					' data-index="' +
					i +
					'"><span></span></li>';
			}

			html += '</ul></div>';
		}

		this.slider.insertAdjacentHTML('beforeend', html);
	}

	slideIndexAssignment() {
		if (this.slides && this.slides.length > 0) {
			// Assign the slide items indexes
			this.slides.forEach(function (slide, index) {
				slide.setAttribute('data-index', index);
			});
		}
	}

	setActiveSlide() {
		let activeSlide;

		// Remove current active slides
		this.slides.forEach(function (slide) {
			slide.classList.remove('item--active');
		});

		// If no current active slide, set to first (0)
		if (this.activeSlide == null) {
			activeSlide = this.slider.querySelector(
				'.slider__item[data-index="0"]'
			);
		} else {
			activeSlide = this.slider.querySelector(
				'.slider__item[data-index="' + this.activeSlide + '"]'
			);
		}

		activeSlide.classList.add('item--active');
	}

	setActiveNav() {
		let activeNav;
		const navItems = this.slider.querySelectorAll('.nav__item');

		// Remove current active nav items
		navItems.forEach(function (slide) {
			slide.classList.remove('item--active');
		});

		activeNav = this.slider.querySelector(
			'.nav__item[data-index="' + this.activeSlide + '"]'
		);

		activeNav.classList.add('item--active');
	}

	navClick() {
		const navButtons = this.slider.querySelectorAll('.nav__item');
		const current = this;
		navButtons.forEach(function (navBtn) {
			navBtn.addEventListener('click', function () {
				// Get active slide index from button
				const activeIndex = this.getAttribute('data-index');

				// Set active slide
				current.activeSlide = activeIndex;

				// Update DOM
				current.setActiveSlide();
				current.setActiveNav();
			});
		});
	}

	init() {
		// Build nav
		this.buildNav(this.slideCount);

		// Set initial height and listen for resizes
		this.setSliderHeight();

		// Assign indexes to the slides
		this.slideIndexAssignment();

		// Set Active Slide (initially)
		this.setActiveSlide();

		// Listen for nav clicks
		this.navClick();
	}
}

// Find all slider containers
const allSliders = document.querySelectorAll('.slider');

// Create instances for each slider
const sliders = {};
for (let i = 0; i < allSliders.length; ++i) {
	sliders[i] = new Slider('.slider:not(.slider--active)');
}
