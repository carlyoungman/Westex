/**
 * File navigation.js.
 */

//This function is responsible for displaying the mobile menu when the hamburger is clicked
export default function navigation() {
	const showMobileMenu = () => {
		const $hamburger = document.querySelector('button.hamburger');
		const $nav = document.querySelector('section.mobile-navigation');
		if (
			$hamburger instanceof window.HTMLElement &&
			$nav instanceof window.HTMLElement
		) {
			$hamburger.addEventListener('click', () => {
				$hamburger.classList.toggle('is-active');
				$nav.classList.toggle('mobile-navigation--active');
				document
					.querySelector('body')
					.classList.toggle('header--active');
			});
		}
	};
	showMobileMenu();

	// This function is responsible for displaying the child menu for the mobile menu
	const openChildMenu = () => {
		const $childMenu = document.querySelectorAll(
			'div.header-mobile-navigation__nav-item'
		);
		$childMenu.forEach((el) => {
			el.addEventListener('click', () => {
				el.classList.toggle(
					'header-mobile-navigation__nav-item--active'
				);
			});
		});
	};
	// openChildMenu();

	// This function is responsible for the back to the top functionality when a users click on the icon
	const scrollBackToTop = () => {
		const $icon = document.querySelector('nav.back-to-top');
		if ($icon instanceof window.HTMLElement) {
			$icon.addEventListener('click', function () {
				window.scrollTo({ top: 0, behavior: 'smooth' });
			});
		}
	};
	scrollBackToTop();

	// This function is responsible header animation
	const headerAnimation = () => {
		const header = document.querySelector('header#main');
		const mobile = document.querySelector('section.mobile-navigation');
		if (header instanceof window.HTMLElement) {
			window.onscroll = function () {
				const current = window.scrollY;
				if (current > header.clientHeight) {
					document.body.classList.add('header--active');
				} else if (
					!mobile.classList.contains('mobile-navigation--active')
				) {
					document.body.classList.remove('header--active');
				}
			};
		}
	};
	headerAnimation();

	// This function is responsible for scrolling to section
	const scrollToSection = () => {
		const links = document.querySelectorAll('a.hero__link');
		const headerHeight = document.querySelector('header#main').offsetHeight;
		links.forEach((el) => {
			el.addEventListener('click', function (e) {
				if (this.getAttribute('href').charAt(0) === '#') {
					e.preventDefault();
					const y =
						document
							.querySelector(this.getAttribute('href'))
							.getBoundingClientRect().top -
						headerHeight -
						30;

					window.scroll({
						top: y,
						behavior: 'smooth',
					});
				}
			});
		});
	};
	scrollToSection();
}
