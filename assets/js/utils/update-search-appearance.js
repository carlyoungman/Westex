// function can be used to get the preview sibling
export default function updateSearchAppearance(searchSection, rootEl) {
	if (searchSection instanceof window.HTMLElement) {
		let searchTerm = '';
		const card = rootEl.querySelector('div.product-card--count');
		const support = searchSection.querySelector(
			'p.inline-searchbar__support'
		);
		const signpost = searchSection.querySelector(
			'p.inline-searchbar__signpost'
		);
		searchTerm = searchSection.querySelector(
			'input.inline-searchbar__input'
		).value;
		if (searchTerm !== '') {
			searchTerm = searchTerm[0].toUpperCase() + searchTerm.slice(1);
			const settings = {
				nonce: ajax_params.ajaxNonce,
				action: 'check_if_search_term',
				searchTerm,
			};
			fetch(ajax_params.ajaxurl, {
				method: 'POST',
				credentials: 'same-origin',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
					'Cache-Control': 'no-cache',
				},
				body: new URLSearchParams(settings),
			})
				.then(function (response) {
					if (response.ok) {
						return response.text();
					}
					throw new Error('Something went wrong');
				})
				.then((data) => {
					if (data.length) {
						console.log(data);
						searchSection.querySelector(
							'h3.inline-searchbar__headline'
						).textContent = 'You searched for "' + searchTerm + '"';
						// Check if the search term is connected to a collection and displays an additional message
						const cards =
							rootEl.querySelectorAll('div.product-card');
						const collections = [];
						cards.forEach((el) => {
							if (el.dataset.collections) {
								collections.push(el.dataset.collections);
							}
						});

						// Checks which is the must returned collection
						function highest(array) {
							if (array.length == 0) return null;
							const modeMap = {};
							let maxEl = array[0],
								maxCount = 1;
							for (let i = 0; i < array.length; i++) {
								const el = array[i];
								if (modeMap[el] == null) modeMap[el] = 1;
								else modeMap[el]++;
								if (modeMap[el] > maxCount) {
									maxEl = el;
									maxCount = modeMap[el];
								}
							}
							return maxEl;
						}
						if (
							card instanceof window.HTMLElement &&
							support instanceof window.HTMLElement
						) {
							support.textContent =
								'Your search returned ' +
								card.dataset.count +
								' result(s).';
						}
						if (signpost instanceof window.HTMLElement) {
							if (
								searchTerm !== collections[0] &&
								undefined !== collections[0]
							) {
								signpost.textContent =
									searchTerm +
									' is a quality within the ' +
									highest(collections) +
									' collection';
								signpost.classList.remove(
									'inline-searchbar__signpost--hide'
								);
							} else {
								signpost.classList.add(
									'inline-searchbar__signpost--hide'
								);
							}
						}
					} else {
						console.log('No data returned');
						signpost.classList.add(
							'inline-searchbar__signpost--hide'
						);
					}
				})
				.catch((error) => {
					console.log(error);
					signpost.classList.add('inline-searchbar__signpost--hide');
				});
		} else {
			signpost.classList.add('inline-searchbar__signpost--hide');
		}
	}
}
