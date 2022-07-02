/**
 * Handles the load more and filter functionality for organisations
 */

import getAjaxContent from '../utils/get-ajax-content';
import deleteCardAnimation from '../utils/delete-card-animation';
import updateFilters from '../utils/update-filters';
import updateSamples from '../utils/update-samples';
import getSamples from '../utils/get-samples';
import updateSampleCount from '../utils/update-sample-count';
import clickModal from '../utils/click-modal';
import getPreviousSibling from '../utils/get-previous-sibling';
import updateSearchAppearance from '../utils/update-search-appearance';
/**
 * Basic products class
 */
class Products {
	constructor(sector) {
		const rootEl = sector;
		const page = 1;
		const taxonomies = [];
		//Filters
		const $filters = rootEl.querySelectorAll(
			'ul.product-filters-block__filter-list'
		);
		const filterActive = 'product-filters-block__list-item--active';
		const $filterHeader = rootEl.querySelectorAll(
			'h6.product-filters-block__filter-header'
		);
		const filterHeaderActive = 'product-filters-block__filter--active';

		//Standard
		const $loadMoreButton = rootEl.querySelector(
			'div.load-more-button__button-wrap'
		);
		const $inset = rootEl.querySelector('span.insert');
		const cards = rootEl.querySelectorAll('div.product-card');

		//Search
		const searchSection = getPreviousSibling(
			rootEl,
			'section.inline-searchbar'
		);
		let searchTerm;

		const noResults = rootEl.querySelector(
			'h5.products__no-products-found'
		);
		const settings = {
			nonce: ajax_params.ajaxNonce,
			query: productsMyAjax, // Search query
			maxPage: productsMaxPageMyAjax, // Total number of page results
			archive: archiveCheckMyAjax,
			page, // Which page of results to return
			insert: $inset, // Where to inset the new content into the DOM
			taxonomies, // Array of user selected category ids
			action: 'load_more_products',
			card: 'product-card', // template_parts/cards/search-result-card.php
			transition: 600, // Animation transition
			button: $loadMoreButton,
			rootEl,
			searchTerm,
			noResults,
		};

		// This functionality is responsible for the search input;
		if (searchSection instanceof window.HTMLElement) {
			const searchForm = searchSection.querySelector(
				'form.inline-searchbar__form'
			);
			const searchInput = searchForm.querySelector(
				'input.inline-searchbar__input'
			);

			if (
				searchForm instanceof window.HTMLElement &&
				searchInput instanceof window.HTMLElement
			) {
				searchForm.addEventListener('submit', (e) => {
					e.preventDefault();
					searchTerm = searchInput.value;
					if (searchTerm.length !== 0) {
						settings.searchTerm = searchTerm;
						deleteCardAnimation(
							rootEl.querySelectorAll('div.' + settings.card),
							settings.transition * 2
						);
						// Sets page to 1 so that it gets the first page of the filtered results
						settings.page = 1;
						setTimeout(function () {
							// Waits for the deleteCardAnimation function to finish before getting the new results
							getAjaxContent(settings);
						}, settings.transition * 2);

						$filters.forEach((filter) => {
							const $activeFilterElement = filter.querySelector(
								'li.' +
									filterActive +
									':not(.product-filters-block__list-item--fake)'
							);
							if (
								$activeFilterElement instanceof
								window.HTMLElement
							) {
								$activeFilterElement.classList.remove(
									filterActive
								);
							}
						});
						setTimeout(function () {
							updateSearchAppearance(searchSection, rootEl);
						}, settings.transition * 4);
					}
				});
			}
		}

		//Settings used within fetch body
		if ($loadMoreButton instanceof window.HTMLElement) {
			//Adds a click event to the load more button and then runs the get new content function
			$loadMoreButton.addEventListener('click', () => {
				settings.page++; // Updates page so that the next page of the current results can be loaded
				getAjaxContent(settings);
			});
		}
		//Close the filters for mobile
		const mediaQuery = window.matchMedia('(max-width: 768px)');
		if (mediaQuery.matches) {
			rootEl
				.querySelectorAll('div.product-filters-block__filter')
				.forEach((el) => {
					el.classList.add(filterHeaderActive);
				});
		}

		$filterHeader.forEach((el) => {
			el.addEventListener('click', function () {
				const nextNode = this.parentNode;
				if (!nextNode.classList.contains(filterHeaderActive)) {
					nextNode.classList.add(filterHeaderActive);
				} else {
					nextNode.classList.remove(filterHeaderActive);
				}
			});
		});

		// This function is responsible for getting the category id from the frontend
		$filters.forEach(($filter) => {
			$filter.childNodes.forEach((el) => {
				el.addEventListener('click', function () {
					//Updates the state of the filters
					updateFilters(el, filterActive);
					//Removes the current category id from the $settings.filter
					settings.taxonomies = [];
					//Adds taxonomies info to settings.taxonomies
					contentFiltersPreset();
					// Removes current content
					deleteCardAnimation(
						rootEl.querySelectorAll('div.' + settings.card),
						settings.transition * 2
					);
					// Sets page to 1 so that it gets the first page of the filtered results
					settings.page = 1;
					setTimeout(function () {
						// Waits for the deleteCardAnimation function to finish before getting the new results
						getAjaxContent(settings);
					}, settings.transition * 2);
				});
			});
		});

		/**
		 * This functionality is responsible for displaying the modal by passing a post id
		 */
		clickModal(cards);

		/**
		 * This functionality is responsible for updating the samples array
		 */
		document.addEventListener('click', function (e) {
			if (e.target && e.target.id === 'request-a-sample') {
				e.preventDefault();
				AddSamplesProcess(e);
			}
		});

		/**
		 * This functionality is responsible for updating the samples array using the quality select.
		 */
		document.addEventListener('change', function (e) {
			if (e.target && e.target.id === 'modal-sample__quality-select') {
				e.preventDefault();
				AddSamplesProcess(e);
			}
		});

		// Check the url for values and preselect the filters
		const segment = window.location.pathname
			.split('?')[0]
			.split('/')
			.filter(function (i) {
				return i !== '';
			})
			.slice(-1)[0];
		$filters.forEach((filter) => {
			const check = filter.querySelector([
				'.product-filters-block__list-item--' + segment,
			]);
			if (check instanceof window.HTMLElement) {
				check.classList.add('product-filters-block__list-item--active');
			}
		});

		// Update the initial search appearance
		updateSearchAppearance(searchSection, rootEl);

		const contentFiltersPreset = () => {
			let term = '';
			let activeElement;
			$filters.forEach(($filter) => {
				activeElement = $filter.querySelector(
					'li.' +
						filterActive +
						':not(.product-filters-block__list-item--fake)'
				);

				if (activeElement instanceof window.HTMLElement) {
					term = activeElement.dataset.id;
					const taxonomy = {
						term,
						taxonomy: $filter.dataset.taxonomy,
					};
					settings.taxonomies.push(JSON.stringify(taxonomy));
				}
			});
		};

		function AddSamplesProcess(e) {
			updateSamples(
				e.target.getAttribute('data-id'),
				e.target.value ?? ''
			);

			/**
			 * Remove one of the add sample cards. Not the first instance as that gets cloned
			 */
			document.querySelectorAll('a.add-sample-card')[1].remove();

			/**
			 * This function updates the count in the header
			 */
			updateSampleCount();

			/**
			 * This function is responsible for displaying the samples within the draw
			 */
			getSamples(e.target.getAttribute('data-id'));

			/**
			 * Update the button text to show the sample has been added
			 */
			e.target.parentNode.classList.toggle('modal-sample__option--added');

			//Close the module and opens the samples draw
			setTimeout(function () {
				const close = document.querySelector(
					'button.modal-base__close'
				);
				const samples = document.querySelector('div.header__samples');

				if (
					close instanceof window.HTMLElement &&
					samples instanceof window.HTMLElement
				) {
					close.click();
					samples.click();
				}
			}, 1000);
		}
	}
}

class Handler {
	constructor(sector, sectorClass) {
		// Store values
		this.sector = sector;
		this.sectorClass = sectorClass;

		new Products(this.sector);
	}
}

// Init a handler for each block instance
const sectorClass = 'products';
const sectors = Array.from(document.querySelectorAll(`section.${sectorClass}`));
sectors.forEach((o) => new Handler(o, sectorClass));
