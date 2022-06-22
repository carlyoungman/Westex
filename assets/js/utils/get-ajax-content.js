// function is used to pass information to Core/Ajax.php and then process the results
import btnManagement from './button-managment';
import processResults from './process-load-more-results';
export default function getAjaxContent(settings) {
	// Updates the appearance of the load more button
	btnManagement(settings.button, 'loading');
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
			// eslint-disable-next-line no-undef;
			if (settings.page <= settings.maxPage && data.length) {
				// 67 means no results found
				if (67 === data.length) {
					settings.noResults.classList.add(
						'products__no-products-found--active'
					);
					btnManagement(settings.button, 'hide'); // Updates load more button
				} else {
					settings.noResults.classList.remove(
						'products__no-products-found--active'
					);
					processResults(data, settings);
					btnManagement(settings.button, 'show'); // Updates load more button
				}
			} else {
				btnManagement(settings.button, 'hide'); // Updates load more button
				// eslint-disable-next-line no-console
				console.log('No data returned');
			}
		})
		.catch((error) => {
			// eslint-disable-next-line no-console
			console.log(error);
		})
		.finally(() => {
			btnManagement(settings.button, 'loading'); // Updates load more button
		});
}
