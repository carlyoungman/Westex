/**
 * Handles the load more and filter functionality for samples
 */
import getSamples from '../utils/get-samples';
import updateSamples from '../utils/update-samples';
import deleteSample from '../utils/delete-sample';
import updateSampleCount from '../utils/update-sample-count';
import displayAddCard from '../utils/display-add-card';
import createSlide from '../utils/create-slider';
import updateSampleForm from '../utils/update-sample-form';
import buildConfirmation from '../utils/build-sample-confirmation';
import checkFormValidation from '../utils/check-form-validation';

/**
 * Basic Samples class
 */
class Samples {
	constructor(sector) {
		const transition = 600;
		const headerCount = document.querySelectorAll('div.header__samples');
		const closeIcon = sector.querySelector(
			'button.sample-draw__close-icon'
		);
		const closeBtn = sector.querySelector('button.sample-draw__close');
		const nextBtn = sector.querySelector('button.sample-draw__continue');
		const backBtns = sector.querySelectorAll('span.sample-draw__back');
		const submitBtn = sector.querySelector('button.sample-draw__submit');
		const progressBar = sector.querySelector('ul.sample-draw__progress');
		const form = sector.querySelector('form');
		const productGrid = document.querySelectorAll('section.products');
		const formURL = sector
			.querySelector('div.sample-draw__form-wrap')
			.getAttribute('data-url');
		if (window.localStorage.getItem('samples') === null) {
			const samples = [];
			window.localStorage.setItem('samples', JSON.stringify(samples));
		}

		/**
		 * This function is responsible for displaying the samples within the draw
		 */
		getSamples();
		/**
		 * This function updates the count in the header
		 */
		updateSampleCount();
		/**
		 * This function is responsible for removing samples
		 */
		document.addEventListener('click', function (e) {
			if (e.target && e.target.classList.value === 'sample-card__close') {
				const $card = e.target.parentNode;
				// Remove from local storage
				updateSamples(
					$card.getAttribute('data-id'),
					$card.getAttribute('data-quality') ?? ''
				);
				// Deleting animation
				deleteSample($card, transition);
				// Update count
				updateSampleCount();
				//Display add card
				displayAddCard();
			}
		});
		/**
		 * Close the samples draws
		 */
		if (closeIcon instanceof window.HTMLElement) {
			closeIcon.addEventListener('click', function () {
				sector.classList.toggle('sample-draw--open');
			});
		}
		if (closeBtn instanceof window.HTMLElement) {
			closeBtn.addEventListener('click', function () {
				sector.classList.toggle('sample-draw--open');
			});
		}

		/**
		 * Opens the samples draws on sample click
		 */

		headerCount.forEach((el) => {
			el.addEventListener('click', function () {
				sector.classList.toggle('sample-draw--open');
			});
		});

		/**
		 * Create the slider within the draw
		 */
		const config = {
			perView: 1,
			focusAt: 'center',
			gap: 60,
			swipeThreshold: false,
			dragThreshold: false,
			autoplay: false,
			controls: true,
			keyboard: false,
			animationDuration: 600,
		};
		/**
		 * This is responsible for updating the progress bar
		 */
		const glide = createSlide('.sample-draw__carousel', config);
		glide.on('run', () => {
			submitBtn.classList.remove('sample-draw__submit--show');
			switch (glide.index) {
				case 0:
					nextBtn.classList.remove('sample-draw__continue--disabled');
					break;
				case 1:
					progressBar.classList.add(
						'sample-draw__progress--step-delivery'
					);
					nextBtn.classList.add('sample-draw__continue--disabled');
					updateSampleForm();
					break;
				case 2:
					progressBar.classList.add(
						'sample-draw__progress--step-confirmation'
					);
					submitBtn.classList.add('sample-draw__submit--show');
					break;
				case 3:
					closeBtn.classList.add('sample-draw__close--show');
					break;
				default:
			}
		});
		/**
		 * Check form for validation
		 */
		const inputs = form.querySelectorAll(
			'div.input-wrapper input.wpcf7-validates-as-required'
		);
		const terms = form.querySelector('span.trigger input');
		inputs.forEach((el) => {
			el.addEventListener('mouseleave', function (e) {
				e.preventDefault();
				if (
					true === checkFormValidation(inputs) &&
					terms instanceof window.HTMLElement
				) {
					if (terms.checked) {
						nextBtn.classList.remove(
							'sample-draw__continue--disabled'
						);
					}
				} else {
					nextBtn.classList.add('sample-draw__continue--disabled');
				}
			});
		});
		if (terms instanceof window.HTMLElement) {
			terms.addEventListener('mouseleave', function () {
				if (true === checkFormValidation(inputs) && terms.checked) {
					nextBtn.classList.remove('sample-draw__continue--disabled');
				} else {
					nextBtn.classList.add('sample-draw__continue--disabled');
				}
			});
		}

		/**
		 * Next button
		 */
		if (nextBtn instanceof window.HTMLElement) {
			nextBtn.addEventListener('click', function (e) {
				e.preventDefault();
				sector.querySelector('button#next').click();
				buildConfirmation(glide.index);
			});
		}
		/**
		 * Back button
		 */
		backBtns.forEach((btn) => {
			btn.addEventListener('click', function (e) {
				e.preventDefault();
				sector.querySelector('button#prev').click();
			});
		});

		/**
		 * Submit button
		 */
		if (submitBtn instanceof window.HTMLElement) {
			submitBtn.addEventListener('click', function (e) {
				e.preventDefault();
				const json = Array.from(
					form.querySelectorAll('input, select, textarea')
				)
					.filter((element) => element.name)
					.reduce((json, element) => {
						json[element.name] =
							element.type === 'checkbox'
								? element.checked
								: element.value;
						return json;
					}, {});

				fetch(formURL, {
					method: 'POST',
					credentials: 'same-origin',
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded',
						'Cache-Control': 'no-cache',
					},
					body: new URLSearchParams(json),
				})
					.then(function (response) {
						if (response.ok) {
							sector.querySelector('button#next').click();
							//Reset samples
							window.localStorage.setItem(
								'samples',
								JSON.stringify([])
							);
							setTimeout(function () {
								getSamples();
								updateSampleCount();
							}, 1000);
						} else {
							throw new Error('Something went wrong');
						}
					})
					.catch((error) => {
						console.log(error);
					});
			});

			/**
			 * This functionality is responsible for the add another sample card
			 */
			document.addEventListener('click', function (e) {
				if (e.target && e.target.className === 'add-sample-card') {
					if (productGrid.length) {
						e.preventDefault();
						if (closeBtn instanceof window.HTMLElement) {
							closeBtn.click();
						}
					}
				}
			});
		}
	}
}

class Handler {
	constructor(sector, sectorClass) {
		// Store values
		this.sector = sector;
		this.sectorClass = sectorClass;

		new Samples(this.sector);
	}
}

// Init a handler for each block instance
const sectorClass = 'sample-draw';
const sectors = Array.from(document.querySelectorAll(`section.${sectorClass}`));
sectors.forEach((o) => new Handler(o, sectorClass));
